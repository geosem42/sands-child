<?php
/**
 * Understrap Child Theme functions and definitions
 *
 * @package UnderstrapChild
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;



/**
 * Removes the parent themes stylesheet and scripts from inc/enqueue.php
 */
function understrap_remove_scripts() {
	wp_dequeue_style( 'understrap-styles' );
	wp_deregister_style( 'understrap-styles' );

	wp_dequeue_script( 'understrap-scripts' );
	wp_deregister_script( 'understrap-scripts' );
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

// include custom jQuery
function custom_jquery() {

	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', get_stylesheet_directory_uri() . '/vendor/jquery/jquery.min.js', array(), null, false);

}
add_action('wp_enqueue_scripts', 'custom_jquery');

function sands_custom_new_menu() {
	register_nav_menus(
	  array(
		'footer-menu' => __( 'Footer' ),
		'offcanvas' => __( 'Offcanvas' ),
	  )
	);
  }
  add_action( 'init', 'sands_custom_new_menu' );

function add_additional_class_on_li($classes, $item, $args) {
	if (isset($args->add_li_class)) {
		$classes[] = $args->add_li_class;
	}
	return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);



/**
 * Enqueue our stylesheet and javascript file
 */
function theme_enqueue_styles() {

	// Get the theme data.
	$the_theme = wp_get_theme();

	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	// Grab asset urls.
	$theme_styles  = "/css/app{$suffix}.css";
	$theme_scripts = "/js/child-theme.js";

	wp_enqueue_style( 'child-sands-styles', get_stylesheet_directory_uri() . $theme_styles, array(), $the_theme->get( 'Version' ) );
	wp_enqueue_style( 'gg-icons', get_stylesheet_directory_uri() . '/vendor/gg-icons/gg-icons.css', $the_theme->get( 'Version' ) );
	wp_enqueue_style( 'bootstrap-icons', get_stylesheet_directory_uri() . '/vendor/bootstrap-icons/bootstrap-icons.css', $the_theme->get( 'Version' ) );
	wp_enqueue_style( 'slick', get_stylesheet_directory_uri() . '/vendor/slick-carousel/slick.css', $the_theme->get( 'Version' ) );
	wp_enqueue_style( 'slick-theme', get_stylesheet_directory_uri() . '/vendor/slick-carousel/slick-theme.css', $the_theme->get( 'Version' ) );
	wp_enqueue_style( 'cookiebar', get_stylesheet_directory_uri() . '/vendor/cookiebar/jquery.cookieBar.min.css', $the_theme->get( 'Version' ) );

	wp_enqueue_script( 'jquery', get_stylesheet_directory_uri() . '/vendor/jquery/jquery.min.js', array(), $the_theme->get( 'Version' ) );
	wp_enqueue_script( 'jquery-miragte', get_stylesheet_directory_uri() . '/vendor/jquery/jquery-migrate-3.4.0.min.js', array(), $the_theme->get( 'Version' ) );
	wp_enqueue_script( 'child-sands-scripts', get_stylesheet_directory_uri() . $theme_scripts, array(), $the_theme->get( 'Version' ), true );
	wp_enqueue_script( 'slick', get_stylesheet_directory_uri() . '/vendor/slick-carousel/slick.min.js', array(), $the_theme->get( 'Version' ), true );
	wp_enqueue_script( 'bootstrap', get_stylesheet_directory_uri() . '/vendor/bootstrap/dist/js/bootstrap.bundle.min.js', array(), $the_theme->get( 'Version' ), true );
	wp_enqueue_script( 'cookiebar', get_stylesheet_directory_uri() . '/vendor/cookiebar/jquery.cookieBar.min.js', array(), $the_theme->get( 'Version' ), true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );



/**
 * Load the child theme's text domain
 */
function add_child_theme_textdomain() {
	load_child_theme_textdomain( 'sands-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );



/**
 * Overrides the theme_mod to default to Bootstrap 5
 *
 * This function uses the `theme_mod_{$name}` hook and
 * can be duplicated to override other theme settings.
 *
 * @param string $current_mod The current value of the theme_mod.
 * @return string
 */
function understrap_default_bootstrap_version( $current_mod ) {
	return 'bootstrap5';
}
add_filter( 'theme_mod_understrap_bootstrap_version', 'understrap_default_bootstrap_version', 20 );



/**
 * Loads javascript for showing customizer warning dialog.
 */
function understrap_child_customize_controls_js() {
	wp_enqueue_script(
		'understrap_child_customizer',
		get_stylesheet_directory_uri() . '/js/customizer-controls.js',
		array( 'customize-preview' ),
		'20130508',
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'understrap_child_customize_controls_js' );

// function change_default_jquery( ){
//     wp_dequeue_script( 'jquery');
//     wp_deregister_script( 'jquery');   
// }
// add_filter( 'wp_enqueue_scripts', 'change_default_jquery', PHP_INT_MAX );

/*
function customSetPostViews($postID) {
    $countKey = 'post_views_count';
    $count = get_post_meta($postID, $countKey, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $countKey);
        add_post_meta($postID, $countKey, '1');
    }else{
        $count++;
        update_post_meta($postID, $countKey, $count);
    }
}
*/


// Post count based on IP address
function calculatePostViews($postID) {

	$user_ip = $_SERVER['REMOTE_ADDR']; //retrieve the current IP address of the visitor
	$key = $user_ip . 'x' . $postID; //combine post ID & IP to form unique key
	$value = array($user_ip, $postID); // store post ID & IP as separate values
	$visited = get_transient($key); //get transient and store in variable

	//check if user not administrator, if so execute code block within
	if( !current_user_can('administrator') ) {
	//check to see if the Post ID/IP ($key) address is currently stored as a transient
		if ( false === ( $visited ) ) {
			//store the unique key, Post ID & IP address for 12 hours if it does not exist
			set_transient( $key, $value, 60*60*12 );

			// now run post views function
			$count_key = 'post_views_count';
			$count = get_post_meta($postID, $count_key, true);
			if($count==''){
				$count = 0;
				delete_post_meta($postID, $count_key);
				add_post_meta($postID, $count_key, '0');
			}else{
				$count++;
				update_post_meta($postID, $count_key, $count);
			}
		}
	}
}

function gt_posts_column_views( $columns ) {
    $columns['post_views'] = 'Views';
    return $columns;
}
function gt_posts_custom_column_views( $column ) {
    if ( $column === 'post_views') {
        $count = get_post_meta( get_the_ID(), 'post_views_count', true );
    	echo "$count views";
    }
}
add_filter( 'manage_posts_columns', 'gt_posts_column_views' );
add_action( 'manage_posts_custom_column', 'gt_posts_custom_column_views' );

function ev_unregister_taxonomy(){
    register_taxonomy('video-category', array());
}
add_action('init', 'ev_unregister_taxonomy');

add_action('pre_get_posts', 'sands_offset_archive_posts');
function sands_offset_archive_posts($query) {
	if (!is_admin() && !is_author()) {
		if ($query->is_main_query() && $query->is_archive()) {
			$cat_obj = $query->get_queried_object();
			$skip = new WP_Query(array('posts_per_page' => 3, 'post_type' => 'post', 'cat' => $cat_obj->term_id, 'post_status' => 'publish', 'order' => 'desc'));
			if ($skip) {
				$skip_ids = wp_list_pluck($skip->posts, 'ID');
				$query->set('post__not_in', $skip_ids);
			}
		}
	}
}

add_filter('get_the_archive_title', function ($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif (is_tax()) { //for custom post types
        $title = sprintf(__('%1$s'), single_term_title('', false));
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    }
    return $title;
});

function disallow_insert_term($term, $taxonomy) {
    $user = wp_get_current_user();
    if ( $taxonomy === 'post_tag' && in_array('author', $user->roles) ) {
        return new WP_Error(
            'disallow_insert_term', 
            __('Your role does not have permission to add terms to this taxonomy')
        );
    }
    return $term;
}
add_filter('pre_insert_term', 'disallow_insert_term', 10, 2);

remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
<?php
/* Template Name: Homepage */
// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
?>
<section class="featured-posts">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="featured-block">
                    <?php
                    $post = rwmb_meta('featured_1', ['object_type' => 'setting'], 'site-settings');
                    setup_postdata($post);

                    $post_id = $post;
                    $category_object = get_the_category($post_id);
                    $category_name = $category_object[0]->name;
                    ?>
                    <div class="left featured-post" style="background:url(<?php echo the_post_thumbnail_url('full'); ?>) rgb(0 0 0 / 30%); background-size: cover; background-position: center; background-blend-mode: overlay;">
                        <span class="badge"><?php echo $category_name; ?></span>
                        <div class="post-source">
                            <a href="<?php echo the_permalink(); ?>">
                                <h1><?php echo the_title(); ?></h1>
                            </a>
                            <div class="post-date d-flex align-items-center">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/caret.png" class="me-2" alt="">
                                <span class="text-light bs5">By <?php echo get_the_author(); ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo get_the_date(); ?></span>
                            </div>
                        </div>
                    </div>
                    <?php wp_reset_postdata(); ?>
                    <div class="right">
                        <?php
                            $post = rwmb_meta('featured_2', ['object_type' => 'setting'], 'site-settings');
                            setup_postdata($post);

                            $post_id = $post;
                            $category_object = get_the_category($post_id);
                            $category_name = $category_object[0]->name;
                        ?>
                        <div class="upper featured-post" style="background:url(<?php echo the_post_thumbnail_url('full'); ?>) rgb(0 0 0 / 30%); background-size: cover; background-position: center; background-blend-mode: overlay;">
                            <span class="badge"><?php echo $category_name; ?></span>
                            <div class="post-source">
                                <a href="<?php echo the_permalink(); ?>">
                                    <h1><?php echo the_title(); ?></h1>
                                </a>
                                <div class="post-date d-flex align-items-center">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/caret.png" class="me-2" alt="">
                                    <span class="text-light bs5">By <?php echo get_the_author(); ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo get_the_date(); ?></span>
                                </div>
                            </div>
                        </div>
                        <?php wp_reset_postdata(); ?>
                        <?php
                            $post = rwmb_meta('featured_3', ['object_type' => 'setting'], 'site-settings');
                            setup_postdata($post);

                            $post_id = $post;
                            $category_object = get_the_category($post_id);
                            $category_name = $category_object[0]->name;
                        ?>
                        <div class="lower featured-post" style="background:url(<?php echo the_post_thumbnail_url('full'); ?>) rgb(0 0 0 / 30%); background-size: cover; background-position: center; background-blend-mode: overlay;">
                            <span class="badge"><?php echo $category_name; ?></span>
                            <div class="post-source">
                                <a href="<?php echo the_permalink(); ?>">
                                    <h1><?php echo the_title(); ?></h1>
                                </a>
                                <div class="post-date d-flex align-items-center">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/caret.png" class="me-2" alt="">
                                    <span class="text-light bs5">By <?php echo get_the_author(); ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo get_the_date(); ?></span>
                                </div>
                            </div>
                        </div>
                        <?php wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="trending">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading mb-4">
                    <span>Trending</span>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/trending-icon.png" alt="Trending" width="75">
                </div>
                <div class="row">
                    <div class="trending-carousel">
                        <?php
                        // meta_key=post_views_count&posts_per_page=5&orderby=meta_value_num&order=DESC'
                        $trending_time = rwmb_meta('trending_time', ['object_type' => 'setting'], 'site-settings');

                        $args = array(
                            'post_type'              => array('post'),
                            'nopaging'               => false,
                            'meta_key'               => 'post_views_count',
                            'posts_per_page'         => '4',
                            'orderby'                => 'meta_value_num',
                            'order'                  => 'DESC',
                            'date_query'             => array(
                                'after'              => date('Y-m-d', strtotime($trending_time . ' days'))
                            )
                        );

                        // The Query
                        $trending = new WP_Query($args);

                        // The Loop
                        if ($trending->have_posts()) {
                            while ($trending->have_posts()) {
                                $trending->the_post();
                                $post_id = get_the_ID();
                                $category_object = get_the_category($post_id);
                                $category_name = $category_object[0]->name; ?>
                                <div class="col-lg-3 mb-3 d-flex align-items-stretch">
                                    <div class="card">
                                        <div class="card-bg" style="background: url(<?php echo the_post_thumbnail_url(); ?>) center center / cover; height: 180px;">
                                            <span class="badge black"><?php echo $category_name; ?></span>
                                        </div>
                                        <div class="card-body post-source d-flex flex-column">
                                            <a href="<?php echo the_permalink(); ?>" class="stretched-link me-2">
                                                <h1 class="card-text"><?php echo the_title(); ?></h1>
                                            </a>
                                            <div class="post-date d-flex align-items-center mt-auto align-self-start">
                                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/caret.png" class="me-2" alt="">
                                                <a href="#author"><span>By <?php the_author(); ?></span></a>
                                                <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                                                <span><?php echo get_the_date(); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php    }
                        } else {
                            // no posts found
                        }

                        // Restore original Post Data
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="newsletter d-flex align-items-center">
    <div class="newsletter-wrapper">
        <div class="newsletter-form">
            <div class="newsletter-text">
                <h3>Subscribe to our Newsletter</h3>
                <p>Stay up-to-date on the latest developments in science and technology from around the world.</p>
                <div class="g-0">
                    <?php echo do_shortcode('[contact-form-7 id="377" title="Newsletter Homepage"]'); ?>

                </div>
            </div>
        </div>
    </div>
</section>

<section class="latest">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading mb-4">
                    <span>Latest</span>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/latest-icon.png" alt="Latest Articles" class="latest-icon">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-9">
                <?php
                $query_args = array(
                    'post_type'              => array('post'),
                    'nopaging'               => false,
                    'order' => 'DESC',
                    'orderby' => 'date',
                    'posts_per_page' => '5'
                );

                // The Query
                $latest = new WP_Query($query_args);

                // The Loop
                if ($latest->have_posts()) {
                    while ($latest->have_posts()) {
                        $latest->the_post();
                        $post_id = get_the_ID();
                        $category_object = get_the_category($post_id);
                        $category_name = $category_object[0]->name;
                ?>

                        <div class="card mb-4">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <a href="<?php echo the_permalink(); ?>">
                                        <div class="card-bg" style="background: url(<?php echo the_post_thumbnail_url(); ?>) center center / cover no-repeat;">
                                            <span class="badge black"><?php echo $category_name; ?></span>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-8 d-flex">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <a href="<?php echo the_permalink(); ?>" class="stretched-link">
                                            <h1 class="card-title"><?php echo the_title(); ?></h1>
                                        </a>
                                        <p class="card-text"><?php echo wp_strip_all_tags($post->post_excerpt, true); ?></p>

                                        <div class="post-date d-flex align-items-center mt-auto align-self-start">
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/caret.png" class="me-2" alt="">
                                            <a href="#"><span class="category">By <?php the_author(); ?></span></a>
                                            <span class="separator">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                                            <span class="date"><?php echo get_the_date(); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php   }
                    /* Restore original Post Data */
                    wp_reset_postdata();
                } else {
                    // no posts found
                }
                ?>

            </div>
            <div class="col-md-3">
                <div class="sidebar">
                    <?php dynamic_sidebar('sidebar') ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="videos">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading videos mb-4">
                    <span>Videos</span>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/videos-icon.png" alt="Videos">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="view-all-btn">
                    <a href="/videos" class="btn btn-basic">View All</a>
                </div>
                <div class="videos-carousel">
                    <?php
                    $query_args = array(
                        'post_type' => 'video',
                        'nopaging' => false,
                        'order' => 'DESC',
                        'orderby' => 'date',
                        'posts_per_page' => '6'
                    );

                    // The Query
                    $latest = new WP_Query($query_args);

                    // The Loop
                    if ($latest->have_posts()) {
                        while ($latest->have_posts()) {
                            $latest->the_post();

                            $terms = get_the_terms(get_the_ID(), 'video-category');
                    ?>
                            <div class="col-lg-4 mb-3 d-flex align-items-center">
                                <div class="card">
                                    <div class="card-bg" style="background: url(<?php echo the_post_thumbnail_url(); ?>) center center / cover; height: 180px;">
                                        <!-- <span class="badge black">
                                    <?php
                                    // foreach ( $terms as $term ) {
                                    //     echo $term->name;
                                    // }
                                    ?>
                                </span> -->
                                        <span class="play-small"><i class="gg-play-button"></i></span>
                                    </div>
                                    <div class="card-body post-source d-flex flex-column">
                                        <a href="<?php echo the_permalink(); ?>" class="stretched-link me-2">
                                            <h1 class="card-text"><?php echo the_title(); ?></h1>
                                        </a>
                                    </div>
                                </div>
                            </div>
                    <?php   }
                        /* Restore original Post Data */
                        wp_reset_postdata();
                    } else {
                        // no posts found
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="latest">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <?php
                $query_args = array(
                    'post_type'              => array('post'),
                    'nopaging'               => false,
                    'order' => 'DESC',
                    'orderby' => 'date',
                    'posts_per_page' => '5',
                    'offset' => '5'
                );

                // The Query
                $latest = new WP_Query($query_args);

                // The Loop
                if ($latest->have_posts()) {
                    while ($latest->have_posts()) {
                        $latest->the_post();
                        $post_id = get_the_ID();
                        $category_object = get_the_category($post_id);
                        $category_name = $category_object[0]->name;
                ?>
                        <div class="card mb-4">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <a href="<?php echo the_permalink(); ?>">
                                        <div class="card-bg" style="background: url(<?php echo the_post_thumbnail_url(); ?>) center center / cover no-repeat;">
                                            <span class="badge black"><?php echo $category_name; ?></span>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-8 d-flex">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <a href="<?php echo the_permalink(); ?>" class="stretched-link">
                                            <h1 class="card-title"><?php echo the_title(); ?></h1>
                                        </a>
                                        <p class="card-text"><?php echo wp_strip_all_tags($post->post_excerpt, true); ?></p>

                                        <div class="post-date d-flex align-items-center mt-auto align-self-start">
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/caret.png" class="me-2" alt="">
                                            <a href="#"><span class="category">By <?php the_author(); ?></span></a>
                                            <span class="separator">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                                            <span class="date"><?php echo get_the_date(); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php   }
                    /* Restore original Post Data */
                    wp_reset_postdata();
                } else {
                    // no posts found
                }
                ?>
            </div>
            <div class="col-md-3">
                <div class="sidebar">
                    <?php dynamic_sidebar('sidebar') ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();

<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$bootstrap_version = get_theme_mod( 'understrap_bootstrap_version', 'bootstrap5' );
$navbar_type       = get_theme_mod( 'understrap_navbar_type', 'collapse' );
$facebook = rwmb_meta('facebook_url', ['object_type' => 'setting'], 'site-settings');
$instagram = rwmb_meta('instagram_url', ['object_type' => 'setting'], 'site-settings');
$twitter = rwmb_meta('twitter_url', ['object_type' => 'setting'], 'site-settings');
$linkedin = rwmb_meta('linkedin_url', ['object_type' => 'setting'], 'site-settings');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<link rel='icon' href='<?php echo get_stylesheet_directory_uri(); ?>/img/favicon.ico' type='image/x-icon' sizes="16x16" />
	<meta name="google-site-verification" content="-3XbB_F8H8U3wsL7SQM92oWvYgnWVPYq8r1BkzR10xo" />
	<meta property="fb:pages" content="739810642870491" />
	<meta name="facebook-domain-verification" content="7rbphwnt0y07ykyhu8fyx7tlh2ezwg" />

	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-M7QJL83XCD"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'G-M7QJL83XCD');
	</script>

	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8225079194922513" crossorigin="anonymous"></script>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php understrap_body_attributes(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<div class="site" id="page">

	<header id="wrapper-navbar">
		<div class="top-bar bg-black d-flex justify-content-end">
			<div class="container">
				<div class="top-social">
					<button type="button" class="btn btn-subscribe subscribe" data-bs-toggle="modal" data-bs-target="#newsletter-modal">Subscribe</button>
					<!-- <a href="#" class="me-2"><i class="gg-instagram"></i></a>
					<a href="#"><i class="gg-facebook"></i></a> -->
					<a href="<?php echo $facebook; ?>" target="_blank" class="me-3" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
					<a href="<?php echo $instagram; ?>" target="_blank" class="me-3" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
					<a href="<?php echo $twitter; ?>" target="_blank" class="me-3" aria-label="Twitter"><i class="bi bi-twitter"></i></a>
					<a href="<?php echo $linkedin; ?>" target="_blank" aria-label="linkedin"><i class="bi bi-linkedin"></i></a>
				</div>
			</div>
		</div>

		<?php get_template_part( 'global-templates/navbar', $navbar_type . '-' . $bootstrap_version ); ?>
	</header>

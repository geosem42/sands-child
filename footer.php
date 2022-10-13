<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$site_desc = rwmb_meta('site_desc', ['object_type' => 'setting'], 'site-settings');
$facebook = rwmb_meta('facebook_url', ['object_type' => 'setting'], 'site-settings');
$instagram = rwmb_meta('instagram_url', ['object_type' => 'setting'], 'site-settings');
$twitter = rwmb_meta('twitter_url', ['object_type' => 'setting'], 'site-settings');
$linkedin = rwmb_meta('linkedin_url', ['object_type' => 'setting'], 'site-settings');
?>

<footer class="desktop">
	<div class="left"></div>
	<div class="right">
		<nav class="footer-menu">
			<?php
			wp_nav_menu(
				array(
					'theme_location'  => 'footer-menu',
					'container_class' => '',
					'container_id'    => '',
					'menu_class'      => '',
					'fallback_cb'     => '',
					'menu_id'         => 'footer-menu',
					'depth'           => 1,
					'add_li_class'  => 'me-3',
					'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
				)
			);
			?>
		</nav>
		<div class="copyrights">
			<p>© 2022 - ScienceAndStuff. All rights reserved.</p>
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/footer-desktop-logo.png" alt="Science And Stuff">
		</div>
	</div>
</footer>

<footer class="mobile">
	<nav class="footer-mobile-top">
		<?php
		wp_nav_menu(
			array(
				'theme_location'  => 'footer-menu',
				'container_class' => 'footer-mobile-top',
				'container_id'    => '',
				'menu_class'      => '',
				'fallback_cb'     => '',
				'menu_id'         => 'footer-menu',
				'depth'           => 1,
				'add_li_class'  => 'me-2',
				'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
			)
		);
		?>
	</nav>
	<div class="footer-mobile-bottom">
		<p class="text-light">© 2022 ScienceAndStuff.com</p>
		<p class="text-light">All rights reserved.</p>
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/footer-mobile-logo.png" alt="Science And Stuff">
	</div>
</footer>

<div class="offcanvas offcanvas-top text-bg-dark" tabindex="-1" id="offcanvas-search" aria-labelledby="offcanvasSearch">
	<!-- <div class="offcanvas-header">
			<h5 class="offcanvas-title" id="offcanvasSearch">Search</h5>
			<button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
		</div> -->
	<div class="offcanvas-body d-flex justify-content-center align-items-center">
		<form class="row g-1" action="<?php echo home_url('/'); ?>" method="get">
			<div class="col-auto">

				<label for="search" class="visually-hidden">Search <?php echo home_url('/'); ?></label>
				<input type="text" class="form-control-lg" name="s" id="search" value="<?php the_search_query(); ?>" placeholder="What are you looking for?">

			</div>
			<div class="col-auto">
				<button type="submit" class="btn btn-lg btn-search mb-3">Search</button>
			</div>
		</form>
	</div>
</div>

<div class="offcanvas offcanvas-end text-bg-dark text-center" tabindex="-1" id="offcanvas-menu" aria-labelledby="offcanvasExampleLabel">
	<div class="offcanvas-header">
		<button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	</div>
	<div class="offcanvas-body">
		<div class="mb-4">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-minimal.png" alt="Science And Stuff" width="120">
		</div>
		<div class="offcanvas-description">
			<?php echo $site_desc; ?>
		</div>
		<hr>
		<?php
		wp_nav_menu(
			array(
				'theme_location'  => 'offcanvas',
				'container_class' => '',
				'container_id'    => '',
				'menu_class'      => '',
				'fallback_cb'     => '',
				'menu_id'         => 'offcanvas',
				'depth'           => 1,
				'add_li_class'    => 'mb-3',
				'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
			)
		);
		?>
		<div class="social-icons">
			<a href="<?php echo $facebook; ?>" target="_blank" class="fs-3 me-3"><i class="bi bi-facebook"></i></a>
			<a href="<?php echo $instagram; ?>" target="_blank" class="fs-3 me-3"><i class="bi bi-instagram"></i></a>
			<a href="<?php echo $twitter; ?>" target="_blank" class="fs-3 me-3"><i class="bi bi-twitter"></i></a>
			<a href="<?php echo $linkedin; ?>" target="_blank" class="fs-3"><i class="bi bi-linkedin"></i></a>
		</div>
	</div>
</div>

<div class="modal fade" id="newsletter-modal" tabindex="-1" aria-labelledby="newsletterModal" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">

			<div class="modal-body">
				<div class="">
					<!-- <input type="text" class="form-control" id="newsletter-input" placeholder="Your Email">
					<button type="submit" class="btn btn-newsletter">Subscribe</button> -->
					<?php echo do_shortcode('[contact-form-7 id="379" title="Newsletter Modal"]'); ?>
				</div>
				<p class="text-dark mt-3 mb-0 newsletter-modal-text">We will not spam you.</p>
			</div>

		</div>
	</div>
</div>

<?php wp_footer(); ?>

</body>

</html>
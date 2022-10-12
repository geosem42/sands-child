<?php

/**
 * Header Navbar (bootstrap5)
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$container = get_theme_mod('understrap_container_type');
?>

<nav id="main-menu" class="navbar navbar-expand-lg navbar-light p-3">
	<div class="container">
		<a class="navbar-brand" href="<?php echo get_site_url(); ?>">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.png" alt="Science And Stuff">
		</a>
		<a class="nav-link text-dark search-mobile-icon" data-bs-toggle="offcanvas" href="#offcanvas-search" role="button" aria-controls="offcanvas-search">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/search-icon.png" alt="Search">
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<?php
		wp_nav_menu(
			array(
				'theme_location'  => 'primary',
				'container_class' => 'collapse navbar-collapse',
				'container_id'    => 'navbarNavDropdown',
				'menu_class'      => 'navbar-nav mx-auto default-menu',
				'fallback_cb'     => '',
				'menu_id'         => 'main-menu',
				'depth'           => 2,
				'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
			)
		);
		?>

		<ul class="navbar-nav utils ms-auto d-none d-lg-inline-flex">
			<li class="nav-item mx-2 d-flex align-items-center">
				<a class="nav-link text-dark search-top-icon" data-bs-toggle="offcanvas" href="#offcanvas-search" role="button" aria-controls="offcanvas-search">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/search-icon.png" alt="Search">
				</a>
			</li>
			<li class="nav-item mx-2 d-flex align-items-center">
				<a class="nav-link text-dark" data-bs-toggle="offcanvas" href="#offcanvas-menu" role="button" aria-controls="offcanvas-menu">
					<!-- <i class="gg-menu"></i> -->
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/burger-menu.png" alt="Burger Menu">
				</a>
			</li>
		</ul>
	</div>
</nav>
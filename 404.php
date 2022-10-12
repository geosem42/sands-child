<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<section class="error-404 not-found">

				<header class="page-header">

					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'understrap' ); ?></h1>

				</header><!-- .page-header -->

				<div class="page-content">

					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'understrap' ); ?></p>

					<?php get_search_form(); ?>

				</div>

			</section>
		</div>
	</div>
</div>

<?php
get_footer();

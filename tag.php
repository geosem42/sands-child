<?php

/**
 * The template for displaying archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
?>

<section class="archive-section" id="archive-wrapper">
<div class="container">
			<div class="row">
				<div class="col-md-9 archive-posts">
					<div class="section-heading mb-4">
						<span><?php the_archive_title(); ?></span>
					</div>
					<?php
					// Start the loop.
					while ( have_posts() ) {
						the_post();
						$category = get_the_terms(get_the_ID(), 'category');
					?>
					<div class="card mb-3">
						<div class="row g-0">
							<div class="col-md-4">
								<a href="#">
									<div class="card-bg" style="background: url(<?php the_post_thumbnail_url('medium') ?>) center center / cover no-repeat;">
										<span class="badge black"><?php echo $category[0]->name; ?></span>
									</div>
								</a>
							</div>
							<div class="col-md-8 d-flex">
								<div class="card-body d-flex flex-column justify-content-between">
									<a href="<?php the_permalink(); ?>" class="stretched-link">
										<h1 class="card-title"><?php the_title(); ?></h1>
									</a>
									<p class="card-text"><?php echo wp_strip_all_tags($post->post_excerpt, true ); ?></p>

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
					<?php
					}
					?>
				</div>
				<div class="col-md-3">
					<div class="sidebar">
						<?php dynamic_sidebar('sidebar') ?>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-9">
					<div class="archive-pagination" aria-label="Category Pagination">
						<?php echo understrap_pagination(); ?>
					</div>
				</div>
			</div>
		</div>
</section>

<?php
get_footer();

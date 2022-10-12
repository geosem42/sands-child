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
$cat_img = rwmb_meta('cat_img', ['object_type' => 'term'], get_queried_object()->term_id);
?>

<section class="archive-section" id="archive-wrapper">
	<section class="featured-posts">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ul class="featured-posts-wrapper">
					<?php 
						$categories = get_the_category();

						$category_id = $categories[0]->cat_ID;
						$cat_query = new WP_Query( array( 'cat' => $category_id,'posts_per_page' => '3' ) ); 

						if(is_tag()) :
							$tag_id = get_queried_object()->term_id;
							$tag = get_tag($tag_id);
							$tag_query = new WP_Query( array( 'tag' => $tag->name,'posts_per_page' => '3' ) );
						endif;

						$count = 0;
						
						if(is_category()) :
							while($cat_query->have_posts()) : 
								$cat_query->the_post();
								$count++;
					?>
						<li class="featured-post <?php if($count == 1): ?>featured-post-a<?php elseif($count == 2): ?>featured-post-b<?php elseif($count == 3): ?>featured-post-c<?php endif; ?>" 
						style="background:url(<?php the_post_thumbnail_url('large'); ?>) rgb(0 0 0 / 30%); background-size: cover; background-blend-mode: overlay;">
							<span class="badge">Physics</span>
							<div class="post-source">
								<a href="<?php the_permalink(); ?>">
									<h1><?php the_title(); ?></h1>
								</a>
								<div class="post-date d-flex align-items-center">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/caret.png" class="me-2" alt="">
									<span class="text-light bs5">By <?php the_author(); ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo get_the_date(); ?></span>
								</div>
							</div>
						</li>
						<?php endwhile; ?>
						<?php wp_reset_postdata();
						elseif(is_tag()) :
							while($tag_query->have_posts()) : 
								$tag_query->the_post();
								$count++; ?>
						<li class="featured-post <?php if($count == 1): ?>featured-post-a<?php elseif($count == 2): ?>featured-post-b<?php elseif($count == 3): ?>featured-post-c<?php endif; ?>" 
						style="background:url(<?php the_post_thumbnail_url('large'); ?>) rgb(0 0 0 / 30%); background-size: cover; background-blend-mode: overlay;">
							<span class="badge">Physics</span>
							<div class="post-source">
								<a href="#1">
									<h1><?php the_title(); ?></h1>
								</a>
								<div class="post-date d-flex align-items-center">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/caret.png" class="me-2" alt="">
									<span class="text-light bs5">By <?php the_author(); ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo get_the_date(); ?></span>
								</div>
							</div>
						</li>
					<?php endwhile;
						wp_reset_postdata();
						endif;
						?>
					</ul>
				</div>
			</div>

		</div>
	</section>

	<section class="">
		<div class="container">
			<div class="row">
				<div class="col-md-9 archive-posts">
					<div class="section-heading mb-4">
						<span><?php the_archive_title(); ?></span>
						<?php 
						foreach ($cat_img as $img) : ?>
							<img src="<?php echo $img['url'] ?>" alt="<?php echo get_queried_object()->name ?>" width="62">
						<?php endforeach; ?>
						
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
</section>

<?php
get_footer();

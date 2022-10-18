<?php

/**
 * The template for displaying all single posts
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
calculatePostViews(get_the_ID());
$img_source = rwmb_meta('img_source');
$img_url = rwmb_meta('img_url');
?>

<section class="article">
	<div class="container">
		<div class="row">
			<?php
			$category_object = get_the_category(get_the_ID());
			$category_name = $category_object[0]->name;
			$category_url = get_category_link($category_object[0]->term_id);
			while (have_posts()) {
				the_post();
				//get_template_part( 'loop-templates/content', 'single' );
				//understrap_post_nav(); 
			?>

				<div class="col-md-9 featured-img">
					<div class="card text-bg-dark">
						<div class="img-source">
							<?php if ($img_url) : ?>
								<a href="<?php echo $img_url; ?>" target="_blank"><?php if($img_source) : echo $img_source; endif; ?></a>
							<?php else : ?>
								<?php if($img_source) : echo $img_source; endif; ?>
							<?php endif; ?>
						</div>
						<div class="card-bg" style="background: url(<?php the_post_thumbnail_url('large'); ?>) center center / cover no-repeat; height: 500px;">
						</div>
						<div class="card-img-overlay">
							<a href="<?php echo $category_url; ?>"><span class="badge black"><?php echo $category_name; ?></span></a>
							<h1><?php the_title(); ?></h1>
							<div class="post-source">
								<div class="post-date d-flex align-items-center">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/caret.png" class="me-2" alt="">
									<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><span class="category">By <?php the_author(); ?></span></a>
									<span class="separator">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
									<span class="date"><?php the_date(); ?></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row mt-5">
						<div class="col-md-12">
							<div class="content">
								<?php the_content(); ?>
							</div>
						</div>
					</div>

					<?php
					$author_box = rwmb_meta( 'show_author_box', ['object_type' => 'setting'], 'site-settings' );
                    if($author_box === 1):
					?>
						<div class="row mt-3 more">
							<div class="col-md-12">
								<div class="author-box d-flex">
									<div class="author-pic">
										<?php
										//echo get_avatar(get_the_author_meta('ID'), 96) ;
										$value = rwmb_meta('profile_pic', ['object_type' => 'user'], get_the_author_meta('ID'));
										foreach ($value as $v) : ?>
											<img src="<?php echo $v['url']; ?>" alt="<?php echo get_the_author_meta('display_name') ?>">
										<?php endforeach; ?>
									</div>

									<div class="author-details">
										<div class="author-name">
											<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
												<?php echo get_the_author_meta('display_name') ?>
											</a>
										</div>
										<div class="author-bio"><?php echo get_the_author_meta('description') ?></div>
									</div>
								</div>
							</div>
						</div>
					<?php endif; ?>

					<div class="row mt-5 more related">
						<div class="col-md-12">
							<div class="section-heading mb-4">
								<span>You Might Also Like</span>
							</div>
						</div>
						<?php
						$post_id = get_the_ID();
						$cat_ids = [];
						$categories = get_the_category($post_id);

						if (!empty($categories)) :
							foreach ($categories as $category) :
								array_push($cat_ids, $category->term_id);
							endforeach;
						endif;

						$current_post_type = get_post_type($post_id);
						$query_args = array(

							'category__in'   => $cat_ids,
							'post_type'      => $current_post_type,
							'post__not_in'    => array($post_id),
							'posts_per_page'  => '6',
							'orderby' => 'rand'
						);

						$category_object = get_the_category(get_the_ID());
						$category_name = $category_object[0]->name;

						$related_cats_post = new WP_Query($query_args);
						if ($related_cats_post->have_posts()) :
							while ($related_cats_post->have_posts()) : $related_cats_post->the_post(); ?>
								<div class="col-lg-4 mb-3 d-flex align-items-stretch">
									<div class="card">
										<div class="card-bg" style="background: url(<?php the_post_thumbnail_url('medium') ?>) center center / cover; height: 180px;">
											<span class="badge black"><?php echo $category_name; ?></span>
										</div>
										<div class="card-body post-source d-flex flex-column">
											<a href="<?php the_permalink(); ?>" class="stretched-link me-2">
												<h1 class="card-text"><?php the_title(); ?></h1>
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
						<?php endwhile;

							// Restore original Post Data
							wp_reset_postdata();
						endif;
						?>
					</div>
				</div>

			<?php } ?>

			<div class="col-md-3">
				<div class="sidebar">
					<?php dynamic_sidebar( 'sidebar' ); ?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();

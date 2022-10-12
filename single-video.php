<?php

defined('ABSPATH') || exit;

get_header();

$video_url = rwmb_meta('video_url');
?>

<section class="article">
	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<div class="container">
			<div class="row">
				<div class="col-md-9 featured-img">
					<div class="ratio ratio-16x9">
						<iframe src="<?php echo $video_url; ?>" title="<?php the_title(); ?>" allowfullscreen></iframe>
					</div>
					<div class="row mt-4">
						<div class="col-md-12">
							<h1><?php the_title(); ?></h1>

							<?php the_content(); ?>
						</div>
					</div>
					<div class="row mt-5 more related">
						<div class="col-md-12">
							<div class="section-heading mb-4">
								<span>Videos You Might Also Like</span>
							</div>
						</div>
						<?php
						$args = array(
							'post_type' => 'video',
							'posts_per_page' => 6,
							'post__not_in' => array(get_the_ID()),
							'orderby' => 'rand'
						);

						// finally run the query
						$loop = new WP_Query($args);

						if ($loop->have_posts()) {
							while ($loop->have_posts()) : $loop->the_post(); ?>
								<div class="col-lg-4 mb-3 d-flex align-items-stretch">
									<div class="card">
										<div class="card-bg" style="background: url(<?php the_post_thumbnail_url('medium'); ?>) center center / cover; height: 180px;">
											<span class="play-small"><i class="gg-play-button"></i></span>
										</div>
										<div class="card-body post-source d-flex flex-column">
											<a href="<?php the_permalink(); ?>" class="stretched-link me-2">
												<h1 class="card-text"><?php the_title(); ?></h1>
											</a>
											<div class="post-date d-flex align-items-center mt-auto align-self-start">
												<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/caret.png" class="me-2" alt="">
												<span><?php echo get_the_date(); ?></span>
											</div>
										</div>
									</div>
								</div>
						<?php
							endwhile;
						}
						wp_reset_postdata(); ?>
					</div>
				</div>
				<div class="col-md-3">
					<div class="sidebar">
						<!-- <img src="<?php //echo get_stylesheet_directory_uri(); 
										?>/img/ad.jpg" alt="Advertisement" class="ad"> -->
						<?php dynamic_sidebar('sidebar'); ?>
					</div>
				</div>
			</div>
		</div>
	</article>
</section>

<?php
get_footer();

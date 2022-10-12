<?php

/**
 * The template for displaying the author pages
 *
 * Learn more: https://codex.wordpress.org/Author_Templates
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

if (get_query_var('author_name')) {
	$curauth = get_user_by('slug', get_query_var('author_name'));
} else {
	$curauth = get_userdata(intval($author));
}

$value = rwmb_meta('profile_pic', ['object_type' => 'user'], get_the_author_meta('ID'));							
?>

<section class="archive-section">
	<div class="archive-header">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="archive-icon mb-3">
						<!-- <img src="assets/img/authors/jolene.jpg" class="rounded-circle" alt="Jolene Creighton" width="120"> -->
						<?php
						if (!empty($curauth->ID)) {
							foreach ($value as $v) : ?>
								<img src="<?php echo $v['url']; ?>" class="rounded" alt="<?php echo get_the_author_meta('display_name') ?>">
							<?php endforeach; ?>
					<?php } ?>
					</div>
					<div class="archive-name">
						<h1><?php the_archive_title(); ?></h1>
					</div>
					<div class="archive-bio">
						<?php
							if (!empty($curauth->user_url) || !empty($curauth->user_description)) {
						?>
						<dl>
							<?php if (!empty($curauth->user_description)) : ?>
								<dd class="author-text"><?php echo esc_html($curauth->user_description); ?></dd>
							<?php endif; ?>
						</dl>
					<?php
							}
					?>
					</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<section class="">
		<div class="container">
			<div class="row">
				<div class="col-md-9 archive-posts">
					<?php
					if (have_posts()) :
						while (have_posts()) :
							the_post(); ?>
							<div class="card mb-3">
								<div class="row g-0">
									<div class="col-md-4">
										<a href="#">
											<div class="card-bg" style="background: url(<?php the_post_thumbnail_url('medium') ?>) center center / cover no-repeat;">
												<span class="badge black">Nature</span>
											</div>
										</a>
									</div>
									<div class="col-md-8 d-flex">
										<div class="card-body d-flex flex-column">
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
					<?php endwhile;
					else :
						get_template_part('loop-templates/content', 'none');
					endif;
					?>

				</div>
				<div class="col-md-3">
					<div class="sidebar">
						<?php dynamic_sidebar('sidebar'); ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-9">
					<div class="archive-pagination" aria-label="Category Pagination">
						<?php understrap_pagination(); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</section>

<?php
get_footer();

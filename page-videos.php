<?php
/* Template Name: Videos */
get_header();
$video_1 = rwmb_meta('featured_video_1', ['object_type' => 'setting'], 'site-settings');
$author_v1 = get_post_field( 'post_author', $video_1 );
$author_name_v1 = get_the_author_meta( 'display_name', $author_v1 );

$video_2 = rwmb_meta('featured_video_2', ['object_type' => 'setting'], 'site-settings');
$author_v2 = get_post_field( 'post_author', $video_2 );
$author_name_v2 = get_the_author_meta( 'display_name', $author_v2 );

$video_3 = rwmb_meta('featured_video_3', ['object_type' => 'setting'], 'site-settings');
$author_v3 = get_post_field( 'post_author', $video_3 );
$author_name_v3 = get_the_author_meta( 'display_name', $author_v3 );

$skipped_ids = [$video_1, $video_2, $video_3];

?>

<section class="archive-section">
    <section class="featured-posts">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="featured-posts-wrapper">
                        <li class="featured-post featured-post-a" style="background:url(<?php echo get_the_post_thumbnail_url($video_1); ?>) rgb(0 0 0 / 30%); background-size: cover; background-blend-mode: overlay;">
                            <div class="post-source">
                                <a href="<?php echo get_the_permalink($video_1); ?>">
                                    <h1><?php echo get_the_title($video_1); ?></h1>
                                </a>
                                <div class="post-date d-flex align-items-center">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/caret.png" class="me-2" alt="">
                                    <span class="text-light bs5">By <?php echo $author_name_v1; ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo get_the_date('F j, Y', $video_1); ?></span>
                                </div>
                            </div>
                        </li>
                        <li class="featured-post featured-post-b" style="background:url(<?php echo get_the_post_thumbnail_url($video_2); ?>) rgb(0 0 0 / 30%); background-size: cover; background-blend-mode: overlay;">
                            <div class="post-source">
                                <a href="<?php echo get_the_permalink($video_2); ?>">
                                    <h1><?php echo get_the_title($video_2); ?></h1>
                                </a>
                                <div class="post-date d-flex align-items-center">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/caret.png" class="me-2" alt="">
                                    <span class="text-light bs5">By <?php echo $author_name_v2; ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo get_the_date('F j, Y', $video_2); ?></span>
                                </div>
                            </div>
                        </li>
                        <li class="featured-post featured-post-c" style="background:url(<?php echo get_the_post_thumbnail_url($video_3); ?>) rgb(0 0 0 / 30%); background-size: cover; background-blend-mode: overlay;">
                            <div class="post-source">
                                <a href="<?php echo get_the_permalink($video_3); ?>">
                                    <h1><?php echo get_the_title($video_3); ?></h1>
                                </a>
                                <div class="post-date d-flex align-items-center">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/caret.png" class="me-2" alt="">
                                    <span class="text-light bs5">By <?php echo $author_name_v3; ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo get_the_date('F j, Y', $video_3); ?></span>
                                </div>
                            </div>
                        </li>
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
                        <span>Videos</span>
                    </div>
                    <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $query_args = array(
                        'paged' => $paged,
                        'post_type' => 'video',
                        'post_status' => 'publish',
                        'order' => 'DESC',
                        'orderby' => 'date',
                        'post__not_in' => $skipped_ids
                    );

                    // The Query
                    $the_query = new WP_Query($query_args);

                    // The Loop
                    if ($the_query->have_posts()) {
                        $i = 1;
                        while ($the_query->have_posts()) {
                            $the_query->the_post(); ?>
                            <div class="card mb-3">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <a href="<?php echo the_permalink(); ?>">
                                            <div class="card-bg" style="background: url(<?php echo the_post_thumbnail_url('medium'); ?>) center center / cover no-repeat; height: 100%;">

                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-8 d-flex">
                                        <div class="card-body d-flex flex-column justify-content-between">
                                            <a href="<?php echo the_permalink(); ?>" class="stretched-link">
                                                <h1 class="card-title"><?php the_title(); ?></h1>
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
                    <?php }
                        //pagination($paged, $the_query->max_num_pages);
                        understrap_pagination( [
                            'total' => $the_query->max_num_pages,
                        ] );
                        /* Restore original Post Data */
                        wp_reset_postdata();
                    } else {
                        // no posts found
                    }


                    ?>

                </div>
                <div class="col-md-3">
                    <div class="sidebar">
                        <?php dynamic_sidebar('sidebar'); ?>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
</section>

<?php
get_footer();

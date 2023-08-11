<?php
$recent_posts = aragon_get_field('recent_posts');
$likes = aragon_get_field('post_likes');
$views = aragon_get_field('post_views');
$post_navigation = aragon_get_field('post_nav');
?>

<?php if (has_post_format('gallery')) : ?>
    <?php if (function_exists('get_field')) : ?>
        <div class="single-post-header">
            <div class="swiper-container swiper-post">
                <div class="swiper-wrapper">
                    <?php if (have_rows('post_gallery')): ?>
                        <?php while (have_rows('post_gallery')) : the_row(); ?>
                            <div class="swiper-slide">
                                <img src="<?php aragon_the_sub_field('post_gallery_image'); ?>"
                                     class="img-fluid">
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
                <div class="swiper-button-next-post">
                    <i class="fa fa-angle-right"></i>
                </div>
                <div class="swiper-button-prev-post">
                    <i class="fa fa-angle-left"></i>
                </div>
                <div class="swiper-scrollbar-post"></div>
            </div>
        </div>
    <?php endif; ?>
<?php elseif (has_post_format('video')): ?>
    <?php $url = aragon_get_field('post_video_link'); ?>
    <?php if (!empty($url)): ?>
        <div class="single-post-header">
            <div class="video-wrapper">
                <div class="video-post">
                    <div class="video-post-format--toggle">
                        <div class="play icon-wrapper">
                            <i class="fa fa-play"></i>
                        </div>
                        <div class="pause icon-wrapper">
                            <i class="fa fa-pause"></i>
                        </div>
                    </div>
                    <div class="video-post-inner">
                        <div class="video-post-format--video"
                             data-property="{
                        videoURL:'<?php echo esc_url($url); ?>',
                     }">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php elseif (has_post_format('audio')): ?>
    <div class="single-post-header">
        <?php $file = aragon_get_field('post_audio_file'); ?>
        <?php if (!empty($file)): ?>
            <audio controls>
                <source src="<?php echo esc_url($file); ?>" type="audio/ogg">
                <source src="<?php echo esc_url($file); ?>" type="audio/mp3">
            </audio>
        <?php endif; ?>
    </div>
<?php endif; ?>
<div class="clearfix">
    <?php the_content(); ?>
</div>
<div class="single-post-footer <?php if ($likes || $views || $recent_posts || $post_navigation):
    echo 'single-post-footer-content'; endif; ?>">
    <?php if ($likes || $views): ?>
        <div class="post-info-additional">
            <?php if ($likes): ?>
                <?php if (function_exists('aragon_the_likes_button')): ?>
                    <div class="like-wrapper">
                        <div class="item likes-item">
                            <?php aragon_the_likes_button(get_the_ID()); ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <?php if ($views): ?>
                <?php if (function_exists('lester_the_postviews')): ?>
                    <div class="views-wrapper">
                        <p class="views-item">
                            <i class="fas fa-eye"></i>
                            <span><?php lester_the_postviews(); ?></span>
                        </p>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <?php if ($recent_posts): ?>
        <div class="recent-posts">
            <div class="row">
                <div class="col">
                    <h6 class="recent-posts-title">
                        <?php esc_html_e('Recent Posts:', 'aragon'); ?>
                    </h6>
                </div>
            </div>
            <div class="row">
                <?php
                $sticky = get_option('sticky_posts');
                $args = array(
                    'posts_per_page' => 2,
                    'ignore_sticky_posts' => 1,
                    'post__not_in' => $sticky,
                    'tax_query' => array(
                        'relation' => 'AND',
                        array(
                            'taxonomy' => 'post_format',
                            'field' => 'slug',
                            'terms' => array('post-format-quote'),
                            'operator' => 'NOT IN',
                        ),
                        array(
                            'taxonomy' => 'post_format',
                            'field' => 'slug',
                            'terms' => array('post-format-aside'),
                            'operator' => 'NOT IN',
                        ),
                        array(
                            'taxonomy' => 'post_format',
                            'field' => 'slug',
                            'terms' => array('post-format-link'),
                            'operator' => 'NOT IN',
                        ),
                        array(
                            'taxonomy' => 'post_format',
                            'field' => 'slug',
                            'terms' => array('post-format-audio'),
                            'operator' => 'NOT IN',
                        ),
                        array(
                            'taxonomy' => 'post_format',
                            'field' => 'slug',
                            'terms' => array('post-format-video'),
                            'operator' => 'NOT IN',
                        )
                    )
                ) ?>
                <?php $query = new WP_Query($args); ?>
                <?php while ($query->have_posts()) : ?>
                    <?php $query->the_post(); ?>
                    <div class="col-md-6">
                        <div class="recent-post">
                            <?php if (has_post_thumbnail() || has_post_format('gallery') || has_post_format('image')): ?>
                                <div class="post-header">
                                    <?php if (!has_post_format()) : ?>
                                        <div class="img-wrapper">
                                            <a href="<?php the_permalink(); ?>">
                                                <img src="<?php the_post_thumbnail_url(); ?>"
                                                     alt="<?php the_title_attribute(); ?>"
                                                     class="img-fluid">
                                            </a>
                                        </div>
                                    <?php elseif (has_post_format('gallery')) : ?>
                                        <div class="swiper-container swiper-post">
                                            <div class="swiper-wrapper">
                                                <?php if (have_rows('post_gallery')): ?>
                                                    <?php while (have_rows('post_gallery')) : the_row(); ?>
                                                        <div class="swiper-slide">
                                                            <img src="<?php aragon_the_sub_field('post_gallery_image'); ?>"
                                                                 class="img-fluid">
                                                        </div>
                                                    <?php endwhile; ?>
                                                <?php endif; ?>
                                            </div>
                                            <div class="swiper-button-next-post">
                                                <i class="fa fa-angle-right"></i>
                                            </div>
                                            <div class="swiper-button-prev-post">
                                                <i class="fa fa-angle-left"></i>
                                            </div>
                                            <div class="swiper-scrollbar-post"></div>
                                        </div>
                                    <?php elseif (has_post_format('image')) : ?>
                                        <div class="img-wrapper">
                                            <a href="<?php the_permalink(); ?>">
                                                <img src="<?php the_post_thumbnail_url(); ?>"
                                                     alt="<?php the_title_attribute(); ?>"
                                                     class="img-fluid">
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <div class="post-body">
                                <h5 class="title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php $title = the_title(); ?>
                                        <?php echo wp_trim_words($title, 10, '...'); ?>
                                    </a>
                                </h5>
                                <div class="post-info d-flex align-items-center">
                                    <p>
                                        <i class="far fa-clock"></i>
                                        <?php echo esc_html(get_the_date()); ?>
                                        <?php esc_html_e('by ', 'aragon'); ?>
                                        <?php the_author_posts_link(); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>
    <?php endif; ?>
    <?php if ($post_navigation): ?>
        <div class="post-navigation">
            <div class="nav-wrapper link-left">
                <?php previous_post_link('<div class="link-wrapper">%link</div>'); ?>
            </div>
            <div class="nav-wrapper link-right">
                <?php next_post_link('<div class="link-wrapper link-right">%link</div>'); ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="post_pages">
        <?php wp_link_pages(array(
            'link_before' => '<div class="link">',
            'link_after' => '</div>',
        )); ?>
    </div>
    <?php if (comments_open() || get_comments_number()) : ?>
        <div class="ajax-comments">
            <?php $comments_count = get_comments_number(); ?>
            <?php if (get_comments_number()) : ?>
                <h4 class="comments-title">
                    <?php echo esc_html(_n("Comment:", "Comments:", $comments_count, 'aragon')); ?>
                </h4>
            <?php endif; ?>
            <?php comments_template(); ?>
        </div>
    <?php endif; ?>
</div>
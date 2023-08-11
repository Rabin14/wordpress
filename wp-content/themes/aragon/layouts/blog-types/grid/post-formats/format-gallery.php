<div class="col-lg-6 grid-item grid-item-50">
    <article <?php post_class('post post-grid default-post-wrapper'); ?>
            id="post-<?php the_ID() ?>">
        <?php
        $title = get_the_title();
        $excerpt = get_the_excerpt();
        ?>
        <div class="post-inner">
            <?php if (function_exists('get_field')) : ?>
                <div class="post-header">
                    <div class="swiper-container swiper-post">
                        <div class="swiper-wrapper">
                            <?php if (have_rows('post_gallery')): ?>
                                <?php while (have_rows('post_gallery')) : the_row(); ?>
                                    <div class="swiper-slide">
                                        <div>
                                            <img src="<?php aragon_the_sub_field('post_gallery_image'); ?>"
                                                 class="img-fluid" alt="<?php the_title_attribute(); ?>">
                                        </div>
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
            <?php else: ?>
                <?php if (has_post_thumbnail()): ?>
                    <div class="post-header">
                        <a href="<?php the_permalink(); ?>">
                            <img src="<?php the_post_thumbnail_url(); ?>"
                                 alt="<?php the_title_attribute(); ?>">
                        </a>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <div class="post-content">
                <h4 class="post-title">
                    <?php if (is_sticky()) : ?>
                        <div class="sticky-icon">
                            <i class="fa fa-thumbtack"></i>
                        </div>
                    <?php endif; ?>
                    <a href="<?php the_permalink(); ?>">
                        <?php echo wp_trim_words($title, 10, '...'); ?>
                    </a>
                </h4>
                <div class="info-wrapper">
                    <div class="info-part">
                        <i class="fa fa-clock info-icon"></i>
                        <div class="date">
                            <?php echo get_the_date(); ?>
                        </div>
                    </div>
                    <div class="delimiter"></div>
                    <div class="info-part">
                        <i class="fa fa-folder-open info-icon"></i>
                        <?php the_category('<span class="delimiter-cat">,</span>', 'single'); ?>
                    </div>
                    <div class="delimiter"></div>
                    <div class="info-part">
                        <i class="fa fa-user info-icon"></i>
                        <?php the_author_posts_link(); ?>
                    </div>
                </div>
                <?php if (!aragon_empty_content($excerpt)): ?>
                    <div class="content-wrapper">
                        <?php echo wp_trim_words($excerpt, 35, '...'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </article>
</div>





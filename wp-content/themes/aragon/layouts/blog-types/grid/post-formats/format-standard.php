<div class="grid-item-50 grid-item">
    <article <?php post_class('post post-grid default-post-wrapper'); ?>
            id="post-<?php the_ID() ?>">
        <?php
        $title = get_the_title();
        $excerpt = get_the_excerpt();
        ?>
        <div class="post-inner">
            <?php if (has_post_thumbnail()): ?>
                <div class="post-header">
                    <a href="<?php the_permalink(); ?>">
                        <img src="<?php the_post_thumbnail_url(); ?>"
                             alt="<?php the_title_attribute(); ?>">
                    </a>
                </div>
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
                    <div class="info-part">
                        <i class="fa fa-folder-open info-icon"></i>
                        <?php the_category('<span class="delimiter-cat">,</span>', 'single'); ?>
                    </div>

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






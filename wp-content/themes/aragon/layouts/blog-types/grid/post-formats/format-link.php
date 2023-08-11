<div class="col-lg-6 grid-item grid-item-50">
    <article <?php post_class('post post-grid default-post-wrapper'); ?>
            id="post-<?php the_ID() ?>">
        <?php
        $title = get_the_title();
        $icon = aragon_get_field('post_link_icon');
        $excerpt = get_the_excerpt();
        ?>
        <div class="post-inner">
            <div class="post-content">
                <?php if (is_sticky()) : ?>
                    <div class="sticky-icon-link">
                        <i class="fa fa-thumbtack"></i>
                    </div>
                <?php endif; ?>
                <h4 class="post-title">
                    <?php if (!empty($icon)): ?>
                        <i class="link-icon <?php echo esc_attr($icon); ?>"></i>
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
                        <?php echo wp_trim_words($excerpt, 40, '...'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </article>
</div>





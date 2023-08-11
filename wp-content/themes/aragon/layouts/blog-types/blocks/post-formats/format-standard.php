<article <?php post_class('post post-block grid-item default-post-wrapper grid-item-50'); ?>
        id="post-<?php the_ID() ?>">
    <?php $title = get_the_title(); ?>
    <div class="post-inner" <?php if (has_post_thumbnail()): ?>
        style="background-image: url(<?php the_post_thumbnail_url(); ?>)" <?php endif; ?>>
        <div class="post-tag">
            <?php
            $posttags = get_the_tags();
            $count = 0;
            if ($posttags) {
                foreach ($posttags as $tag) {
                    $count++;
                    if (1 == $count) {
                        ?>
                        <a href="<?php echo get_tag_link($tag); ?>" class="tag">
                            <i class="fa fa-tag icon-tag"></i><?php echo esc_attr($tag->name) . ' '; ?>
                        </a>
                        <?php
                    }
                }
            }
            ?>
        </div>
        <div class="content-wrapper">
            <div class="content-wrapper-inner">
                <div class="category-list">
                    <?php the_category('<span class="delimiter">|</span>', 'single'); ?>
                </div>
                <h4 class="post-title">
                    <a href="<?php the_permalink(); ?>">
                        <?php echo wp_trim_words($title, 10, '...'); ?>
                    </a>
                </h4>
                <div class="info">
                    <p class="date">
                        <?php echo esc_html(get_the_date()); ?>
                        <span class="delimiter">,</span>
                    </p>
                    <div class="author">
                        <?php the_author_posts_link(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>






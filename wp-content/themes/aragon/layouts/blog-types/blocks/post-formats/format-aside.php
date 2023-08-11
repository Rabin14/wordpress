<article <?php post_class('post post-block grid-item grid-item-25'); ?>
        id="post-<?php the_ID() ?>">
    <?php
    $title = get_the_title();
    $excerpt = get_the_excerpt();
    ?>
    <div class="post-inner">
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
                <div class="excerpt-wrapper">
                    <?php echo wp_trim_words($excerpt, 20, '...'); ?>
                </div>
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






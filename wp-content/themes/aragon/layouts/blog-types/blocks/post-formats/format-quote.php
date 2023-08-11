<article <?php post_class('post post-block grid-item grid-item-25'); ?>
        id="post-<?php the_ID() ?>">
    <?php
    $title = get_the_title();
    $icon = aragon_get_field('post_quote_icon');
    ?>
    <div class="post-inner">
        <div class="quote-icon">
            <i class="<?php echo esc_attr($icon); ?>"></i>
        </div>
        <div class="content-wrapper">
            <div class="content-wrapper-inner">
                <h4 class="post-title">
                    <?php echo esc_html($title); ?>
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






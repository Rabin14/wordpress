<div class="col-lg-6 grid-item grid-item-50">
<article <?php post_class('post post-grid'); ?>
        id="post-<?php the_ID() ?>">
    <?php
    $title = get_the_title();
    $icon = aragon_get_field('post_quote_icon');
    ?>
    <div class="post-inner">
        <div class="icon-wrapper">
            <i class="fa <?php echo esc_attr($icon); ?>"></i>
        </div>
        <div class="post-content">
            <h4 class="post-title">
                    <?php echo esc_html($title); ?>
            </h4>
            <div class="author-wrapper">
                <div class="delimiter-quote">
                    -
                </div>
                <?php the_author_posts_link(); ?>
            </div>
        </div>
    </div>
</article>
</div>





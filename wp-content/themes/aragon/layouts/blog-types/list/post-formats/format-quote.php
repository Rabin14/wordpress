<article <?php post_class('post post-default grid-item'); ?>
        id="post-<?php the_ID() ?>">
    <?php
    $title = get_the_title();
    $icon = aragon_get_field('post_quote_icon');
    ?>
    <div class="row">
        <div class="col-lg-12 d-flex align-items-center">
            <div class="post-inner">
                <div class="icon-wrapper">
                    <i class="fa <?php echo esc_attr($icon); ?>"></i>
                </div>
                <div class="post-content-wrapper">
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
        </div>
    </div>
</article>






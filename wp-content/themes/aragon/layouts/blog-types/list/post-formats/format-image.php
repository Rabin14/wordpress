<article <?php post_class('post post-default grid-item default-post-wrapper'); ?>
        id="post-<?php the_ID() ?>">
    <?php
    $title = get_the_title();
    $excerpt = get_the_excerpt();
    ?>
    <div class="row">
        <div class="col-lg-12 default-post-content d-flex align-items-center">
            <div class="post-inner" style="background-image: url(<?php the_post_thumbnail_url(); ?>)">
                <div class="post-content-wrapper">
                    <h4 class="post-title">
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
                        <div class="delimiter">|</div>
                        <div class="info-part">
                            <i class="fa fa-folder-open info-icon"></i>
                            <?php the_category('<span class="delimiter-cat">,</span>', 'single'); ?>
                        </div>
                        <div class="delimiter">|</div>
                        <div class="info-part">
                            <i class="fa fa-user info-icon"></i>
                            <?php the_author_posts_link(); ?>
                        </div>
                    </div>
                    <div class="content-wrapper">
                        <?php echo wp_trim_words($excerpt, 40, '...'); ?>
                    </div>
                    <div class="button-wrapper d-flex">
                        <a href="<?php the_permalink(); ?>" class="button-post">
                            <?php echo esc_html__('Read More', 'aragon'); ?>
                            <i class="sl-arrow-right-circle"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>






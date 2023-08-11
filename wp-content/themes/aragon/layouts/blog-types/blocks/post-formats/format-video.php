<article <?php post_class('post post-block grid-item default-post-wrapper grid-item-50'); ?>
        id="post-<?php the_ID() ?>">
    <?php
    $title = get_the_title();
    $url = aragon_get_field('post_video_link');
    ?>
    <div class="post-inner">
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






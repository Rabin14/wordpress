<article <?php post_class('post post-default grid-item'); ?>
        id="post-<?php the_ID() ?>">
    <?php
    $title = get_the_title();
    $file = aragon_get_field('post_audio_file');
    ?>
    <div class="row">
        <div class="col-lg-12 default-post-content d-flex align-items-center">
            <div class="post-inner">
                <div class="icon-wrapper">
                    <i class="fa fa-music"></i>
                </div>
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
                        <?php if (!empty($file)): ?>
                            <audio controls>
                                <source src="<?php echo esc_url($file); ?>" type="audio/ogg">
                                <source src="<?php echo esc_url($file); ?>" type="audio/mp3">
                            </audio>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>






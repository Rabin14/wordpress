<div class="col-lg-6 grid-item grid-item-50">
    <article <?php post_class('post post-grid default-post-wrapper'); ?>
            id="post-<?php the_ID() ?>">
        <?php
        $title = get_the_title();
        $file = aragon_get_field('post_audio_file');
        ?>
        <div class="post-inner">
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
                <?php if (!empty($file)): ?>
                    <audio controls>
                        <source src="<?php echo esc_url($file); ?>" type="audio/ogg">
                        <source src="<?php echo esc_url($file); ?>" type="audio/mp3">
                    </audio>
                <?php endif; ?>
            </div>
        </div>
    </article>
</div>




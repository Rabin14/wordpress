<article <?php post_class('post post-block grid-item grid-item-25'); ?>
        id="post-<?php the_ID() ?>">
    <?php
    $title = get_the_title();
    $file = aragon_get_field('post_audio_file');
    ?>
    <div class="post-inner">
        <div class="content-wrapper">
            <div class="content-wrapper-inner">
                <div class="category-list">
                    <?php the_category('<span class="delimiter">|</span>', 'single'); ?>
                </div>
                <h4 class="post-title">
                    <a href="<?php the_permalink(); ?>">
                        <?php echo esc_html($title); ?>
                    </a>
                </h4>
                <?php if (!empty($file)): ?>
                    <audio controls>
                        <source src="<?php echo esc_url($file); ?>" type="audio/ogg">
                        <source src="<?php echo esc_url($file); ?>" type="audio/mp3">
                    </audio>
                <?php endif; ?>
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






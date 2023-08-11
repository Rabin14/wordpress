<?php global $wp_query; ?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
    <?php if ( function_exists( 'aragon_navigation' ) ) : ?>
        <?php aragon_navigation(); ?>
    <?php else: ?>
        <?php the_posts_navigation(); ?>
    <?php endif; ?>
<?php endif; ?>
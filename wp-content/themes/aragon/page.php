<?php get_header(); ?>

<?php if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>
        <div class="main-content clearfix <?php if ( ! function_exists( 'get_field' ) && ! isset( $GLOBALS['kc'] ) ) :
            echo 'default-content default-content-styles container';
        endif; ?>">
            <?php the_content(); ?>
            <?php if (comments_open() || get_comments_number()) : ?>
                <div class="ajax-comments">
                    <?php $comments_count = get_comments_number(); ?>
                    <?php if (get_comments_number()) : ?>
                        <h4 class="comments-title">
                            <?php echo esc_html(_n("Comment:", "Comments:", $comments_count, 'aragon')); ?>
                        </h4>
                    <?php endif; ?>
                    <?php comments_template(); ?>
                </div>
            <?php endif; ?>
        </div>
	<?php endwhile; ?>
<?php else: ?>
    <?php get_template_part( 'layouts/notfound' ) ?>
<?php endif; ?>

<?php get_footer(); ?>

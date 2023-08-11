<?php get_header();

$image = aragon_get_option( 'opt_404_page_background_image' );
?>
    <header class="header-404 color_overlay d-flex align-items-center"
            style="background-image: url(<?php echo esc_url( $image ); ?>)">
        <div class="container">
            <div class="wrapper-404-alert">
                <div class="content">
                    <h2 class="display-2 title"><?php echo esc_html__( '404!', 'aragon' ); ?></h2>
                    <h2><?php echo esc_html__( 'Page not found', 'aragon' ); ?></h2>
                    <p><?php echo esc_html__( 'The page you were looking for could not be found', 'aragon' ); ?></p>
                    <?php get_search_form(); ?>
                    <div class="d-flex justify-content-center">
                        <a href="<?php echo esc_url( get_home_url() ); ?>" class="button-back"><i
                                class="fa fa-angle-left"></i><?php echo esc_html__( 'Back to homepage', 'aragon' ); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </header>

<?php get_footer(); ?>
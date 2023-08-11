<?php
/**
 * Footer For Jobile Theme.
 */
$jobile_options = get_option('jobile_theme_options'); ?>
<footer class="footer-main">
<?php if ( is_active_sidebar( 'footer-area-1' ) || is_active_sidebar( 'footer-area-2' ) || is_active_sidebar( 'footer-area-3' ) || is_active_sidebar( 'footer-area-4' ) ){ ?>
    <div class="container jobile-container">
        <div class="row">
            <div class="col-md-3 footer-column1 clearfix col-xs-12 col-sm-6 ">
        <?php if (is_active_sidebar('footer-area-1')) : dynamic_sidebar('footer-area-1');
        endif; ?>
            </div>
            <div class="col-md-3 footer-column2 clearfix col-xs-12 col-sm-6 ">
<?php if (is_active_sidebar('footer-area-2')) : dynamic_sidebar('footer-area-2');
endif; ?>
            </div>
            <div class="col-md-3 footer-column3 clearfix col-xs-12 col-sm-6 ">
        <?php if (is_active_sidebar('footer-area-3')) : dynamic_sidebar('footer-area-3');
        endif; ?>
            </div>
            <div class="col-md-3 footer-column4 clearfix col-xs-12 col-sm-6 ">
<?php if (is_active_sidebar('footer-area-4')) : dynamic_sidebar('footer-area-4');
endif; ?>
        </div>
        </div>
    </div>
<?php } ?>
    <div class="col-md-12 no-padding-lr footer-bottom">
        <div class="container jobile-container">
       <p class="text-right">
        <?php 
        if(get_theme_mod('footerCopyright',isset($jobile_options['footertext'])?$jobile_options['footertext']:'') != '') {
         echo wp_kses_post(get_theme_mod('footerCopyright',isset($jobile_options['footertext'])?$jobile_options['footertext']:'')).' '; 
        }  ?>
        </p>
        <p class="text-left">
         <?php esc_html_e('Powered By ','Karmodishari'); ?>
         <a href="<?php echo esc_url('https://karmodishari.co.in/'); ?>"><?php esc_html_e(' Karmodishari','Karmodishari'); ?></a>
        </p>
        </div>    
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
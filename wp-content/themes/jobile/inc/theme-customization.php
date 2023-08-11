<?php
/**
* Customization options
**/
$jobile_options = get_option( 'jobile_theme_options' );
function jobile_customize_register( $wp_customize ) {
  $jobile_options = get_option( 'jobile_theme_options' );
  /* --------------------------- Start Footer Settings Panel ------------- */
  $wp_customize->add_section( 'footer_setting', array(
    'capability'          => 'edit_theme_options',
    'title'               => esc_html__('Footer Settings', 'jobile'),
  ) );
  $wp_customize->add_setting( 'footerCopyright', array(
    'default'             => isset($jobile_options['footertext'])?$jobile_options['footertext']:'',
    'type'                => 'theme_mod',
    'capability'          => 'edit_theme_options',
    'sanitize_callback'   => 'wp_kses_post',
  ) );
  $wp_customize->add_control( 'footerCopyright', array(
    'type'                => 'textarea',
    'section'             => 'footer_setting',
    'label'               => esc_html__('Copyright Text','jobile'),
    'description'         => esc_html__('Some text regarding copyright of your site, you would like to display in the footer.', 'jobile'),
  ) );
  /* --------------------------- End Footer Settings Panel ------------------ */
}
add_action( 'customize_register', 'jobile_customize_register' );
function jobile_custom_css(){ ?>
<style type="text/css">
</style>
<?php }
add_action('wp_head','jobile_custom_css',900);
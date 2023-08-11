<?php
add_action( 'widgets_init', 'aragon_init_sidebars' );
function aragon_init_sidebars() {
    if ( function_exists( 'register_sidebar' ) ) {
        register_sidebar( array(
            'name'          => __( 'Blog Sidebar', 'aragon' ),
            'id'            => 'blog-sidebar',
            'description'   => esc_html__( 'Sidebar on posts page', 'aragon' ),
            'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s" >',
            'after_widget'  => '</div>',
            'before_title'  => '<h6 class="widget-title">',
            'after_title'   => '</h6>',
        ) );
        register_sidebar( array(
            'name'          => __( 'Footer Sidebar', 'aragon' ),
            'id'            => 'footer-sidebar',
            'description'   => esc_html__( 'Sidebar on footer', 'aragon' ),
            'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s" >',
            'after_widget'  => '</div>',
            'before_title'  => '<h6 class="widget-title">',
            'after_title'   => '</h6>',
        ) );
    }
}
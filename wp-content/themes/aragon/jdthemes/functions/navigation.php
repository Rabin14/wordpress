<?php
add_action( 'after_setup_theme', 'aragon_init_navigation' );

if ( ! function_exists( 'aragon_init_navigation' ) ) :
	function aragon_init_navigation() {
		register_nav_menus( array(
			'primary_menu' => esc_html__( 'Primary Menu', 'aragon' ),
		) );
	}
endif;



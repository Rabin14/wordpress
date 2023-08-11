<?php

add_action( 'after_setup_theme', 'aragon_add_options_pages' );
add_filter( 'acf/settings/save_json', 'aragon_acf_json_save_point' );
add_filter( 'acf/settings/load_json', 'aragon_acf_json_load_point' );

if ( ! function_exists( 'aragon_add_options_pages' ) ) :
	function aragon_add_options_pages() {
		/* Add options pages */
		if ( function_exists( 'acf_add_options_page' ) ) {
			// Theme Options page
			acf_add_options_page( array(
				'page_title' => esc_html__( 'Theme Options', 'aragon' ),
				'menu_title' => esc_html__( 'Theme Options', 'aragon' ),
				'menu_slug'  => 'aragon_theme_opt',
				'capability' => 'edit_posts',
				'redirect'   => false,
				'position'   => 60
			) );
		}
	}
endif;

function aragon_acf_json_save_point( $path ) {
	$path = ARAGON_PATH . '/acf/acf-json';
	return $path;
}

function aragon_acf_json_load_point( $paths ) {
	unset( $paths[0] );
	$paths[] = ARAGON_PATH . '/acf/acf-json';
	return $paths;
}

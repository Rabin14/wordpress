<?php
add_action( 'wp_head', 'aragon_head' );
add_action( 'after_setup_theme', 'aragon_theme_setup' );
add_filter( 'pre_get_posts', 'aragon_exclude_pages' );
add_filter( 'vpf_enqueue_plugin_font_awesome', '__return_false' );

if ( ! function_exists( 'aragon_theme_setup' ) ) :
	function aragon_theme_setup() {
		if ( ! isset( $content_width ) ) {
			$content_width = 1170;
		}
		add_editor_style();
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'post-formats', array( 'video', 'gallery', 'quote', 'aside', 'image', 'link', 'audio' ) );
		add_theme_support( "title-tag" );
		global $wp_version;
		if ( version_compare( $wp_version, '3.4', '<=' ) ) :
			add_theme_support( "custom-background" );
			add_theme_support( "custom-header" );
		endif;
	}
endif;

if ( ! function_exists( 'aragon_exclude_pages' ) ) :
	function aragon_exclude_pages( $query ) {
		if ( $query->is_search ) {
			$query->set( 'post_type', array( 'post' ) );
		}
		return $query;
	}
endif;

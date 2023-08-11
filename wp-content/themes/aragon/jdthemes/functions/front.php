<?php

add_action( 'admin_head', 'aragon_admin_styles' );
add_action( 'wp_enqueue_scripts', 'aragon_styles' );
add_action( 'wp_enqueue_scripts', 'aragon_scripts' );
add_action( 'wp_enqueue_scripts', 'aragon_load_fonts' );

if ( ! function_exists( 'aragon_styles' ) ) :
	function aragon_styles() {
		wp_enqueue_style( 'aragon-main-css', get_template_directory_uri() . '/assets/css/main.css' );
		wp_enqueue_style( 'font-awesome-css', get_template_directory_uri() . '/assets/css/font-awesome.min.css' );
		wp_enqueue_style( 'swiper-css', get_template_directory_uri() . '/assets/css/swiper.min.css' );
		wp_enqueue_style( 'magnific-css', get_template_directory_uri() . '/assets/css/magnific-popup.css' );
		wp_enqueue_style( 'video-youtube-css', get_template_directory_uri() . '/assets/css/jquery.mb.YTPlayer.min.css' );
	}
endif;


if ( ! function_exists( 'aragon_admin_styles' ) ) :
	function aragon_admin_styles() {
		wp_enqueue_style( "aragon-admin", get_template_directory_uri() . '/assets/css/admin/admin.css' );
		wp_enqueue_style( "aragon-admin-icons", get_template_directory_uri() . '/assets/css/font-awesome.min.css' );
	}
endif;


if ( ! function_exists( 'aragon_scripts' ) ) :
	function aragon_scripts() {
		wp_enqueue_script( 'aragon-main', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), ARAGON_THEME_VERSION, true );
		wp_enqueue_script( 'three', get_template_directory_uri() . '/assets/js/three.min.js', array( 'jquery' ), ARAGON_THEME_VERSION, true );
		wp_enqueue_script( 'anime', get_template_directory_uri() . '/assets/js/anime.min.js', array( 'jquery' ), ARAGON_THEME_VERSION, true );
		wp_enqueue_script( 'nicescroll', get_template_directory_uri() . '/assets/js/jquery.nicescroll.min.js', array( 'jquery' ), ARAGON_THEME_VERSION, true );
		wp_enqueue_script( 'canvas-renderer', get_template_directory_uri() . '/assets/js/canvas-renderer.js', array( 'jquery' ), ARAGON_THEME_VERSION, true );
		wp_enqueue_script( 'ease-pack', get_template_directory_uri() . '/assets/js/EasePack.min.js', array( 'jquery' ), ARAGON_THEME_VERSION, true );
		wp_enqueue_script( 'sticky-sidebar', get_template_directory_uri() . '/assets/js/sticky-sidebar.js', array( 'jquery' ), ARAGON_THEME_VERSION, true );
		wp_enqueue_script( 'ie-support', get_template_directory_uri() . '/assets/js/ie-support.js', array( 'jquery' ), ARAGON_THEME_VERSION, true );
		wp_enqueue_script( 'imageloaded', get_template_directory_uri() . '/assets/js/imagesloaded.pkgd.min.js', array( 'jquery' ), ARAGON_THEME_VERSION, true );
		wp_enqueue_script( 'hover3d', get_template_directory_uri() . '/assets/js/jquery.hover3d.min.js', array( 'jquery' ), ARAGON_THEME_VERSION, true );
		wp_enqueue_script( 'isotope', get_template_directory_uri() . '/assets/js/isotope.pkgd.min.js', array( 'jquery' ), ARAGON_THEME_VERSION, true );
		wp_enqueue_script( 'magnific', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array( 'jquery' ), ARAGON_THEME_VERSION, true );
		wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/assets/js/jquery.waypoints.min.js', array( 'jquery' ), ARAGON_THEME_VERSION, true );
		wp_enqueue_script( 'parallax', get_template_directory_uri() . '/assets/js/parallax.js', array( 'jquery' ), ARAGON_THEME_VERSION, true );
		wp_enqueue_script( 'parallax-master', get_template_directory_uri() . '/assets/js/parallax.min.js', array( 'jquery' ), ARAGON_THEME_VERSION, true );
		wp_enqueue_script( 'particles' ,get_template_directory_uri() . '/assets/js/particles.min.js', array( 'jquery' ), ARAGON_THEME_VERSION, true );
		wp_enqueue_script( 'progressbar', get_template_directory_uri() . '/assets/js/progressbar.min.js', array( 'jquery' ), ARAGON_THEME_VERSION, true );
		wp_enqueue_script( 'projector', get_template_directory_uri() . '/assets/js/projector.js', array( 'jquery' ), ARAGON_THEME_VERSION, true );
		wp_enqueue_script( 'swiper', get_template_directory_uri() . '/assets/js/swiper.min.js', array( 'jquery' ), ARAGON_THEME_VERSION, true );
		wp_enqueue_script( 'tween-lite', get_template_directory_uri() . '/assets/js/TweenLite.min.js', array( 'jquery' ), ARAGON_THEME_VERSION, true );
		wp_enqueue_script( 'youtube-video', get_template_directory_uri() . '/assets/js/jquery.mb.YTPlayer.min.js', array( 'jquery' ), ARAGON_THEME_VERSION, true );
		if ( is_singular() &&  comments_open() || get_comments_number() ) {
			wp_enqueue_script( 'comment-reply', 'wp-includes/js/comment-reply', array(), '', true );
		}
	}
endif;
<?php
/**
 * Cobain Theme functions and definitions
 */

if ( ! function_exists( 'cobain_setup' ) ) :
	function cobain_setup() {
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'cobain' ),
		) );
	}
endif;
add_action( 'after_setup_theme', 'cobain_setup' );

/**
 * Enqueue scripts and styles.
 */
function cobain_scripts() {
	// CSS
	wp_enqueue_style( 'cobain-preload', get_template_directory_uri() . '/css/preload.min.css', array(), '1.0.0' );
	wp_enqueue_style( 'cobain-icomoon', get_template_directory_uri() . '/css/icomoon.css', array(), '1.0.0' );
	wp_enqueue_style( 'cobain-libs', get_template_directory_uri() . '/css/libs.min.css', array(), '1.0.0' );
	wp_enqueue_style( 'cobain-index', get_template_directory_uri() . '/css/index.min.css', array(), '1.0.0' );
	
	// Theme stylesheet
	wp_enqueue_style( 'cobain-style', get_stylesheet_uri(), array(), '1.0.0' );

	// JS
	wp_enqueue_script( 'cobain-common', get_template_directory_uri() . '/js/common.min.js', array(), '1.0.0', true );
	wp_enqueue_script( 'cobain-index-js', get_template_directory_uri() . '/js/index.min.js', array(), '1.0.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'cobain_scripts' );

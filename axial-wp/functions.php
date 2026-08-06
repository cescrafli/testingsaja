<?php
/**
 * Axial Construct functions and definitions
 */

if ( ! function_exists( 'axial_setup' ) ) :
	function axial_setup() {
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Register Navigation Menus
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'axial' ),
			)
		);

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'axial_setup' );

/**
 * Enqueue scripts and styles.
 */
function axial_scripts() {
	// Styles
	wp_enqueue_style( 'axial-preload', get_template_directory_uri() . '/css/preload.min.css', array(), '1.0' );
	wp_enqueue_style( 'axial-icomoon', get_template_directory_uri() . '/css/icomoon.css', array(), '1.0' );
	wp_enqueue_style( 'axial-libs', get_template_directory_uri() . '/css/libs.min.css', array(), '1.0' );
	wp_enqueue_style( 'axial-index', get_template_directory_uri() . '/css/index.min.css', array(), '1.0' );
	
	// Main Style
	wp_enqueue_style( 'axial-style', get_stylesheet_uri(), array(), '1.0' );

	// Scripts
	wp_enqueue_script( 'axial-youtube-api', 'https://www.youtube.com/player_api', array(), null, true );
	wp_enqueue_script( 'axial-common', get_template_directory_uri() . '/js/common.min.js', array(), '1.0', true );
	wp_enqueue_script( 'axial-index-js', get_template_directory_uri() . '/js/index.min.js', array('axial-common'), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'axial_scripts' );

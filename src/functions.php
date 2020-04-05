<?php
/**
 * Musical Theatre Factory
 */
function mtf_setup() {
  require('admin/index.php');
}
add_action( 'after_setup_theme', 'mtf_setup' );

var_dump(getenv());

function mtf_scripts() {
	wp_enqueue_script( 'mtf-vendors', get_theme_file_uri( '/assets/js/vendors.js' ), array('jquery'), /* wp_get_theme()->get( 'Version' ) */ null, true );
	wp_enqueue_style( 'mtf-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

	wp_style_add_data( 'mtf-style', 'rtl', 'replace' );

	if ( has_nav_menu( 'menu-1' ) ) {
		// wp_enqueue_script( 'mtf-priority-menu', get_theme_file_uri( '/js/priority-menu.js' ), array(), '1.1', true );
		// wp_enqueue_script( 'mtf-touch-navigation', get_theme_file_uri( '/js/touch-keyboard-navigation.js' ), array(), '1.1', true );
	}

	// wp_enqueue_style( 'mtf-print-style', get_template_directory_uri() . '/print.css', array(), wp_get_theme()->get( 'Version' ), 'print' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mtf_scripts' );

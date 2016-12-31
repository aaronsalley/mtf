<?php
/**
 * Musical Theatre Factory functions and definitions
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 */

if ( ! function_exists( 'mtf_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features.
 */
function mtf_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 */
	load_theme_textdomain( 'mtf' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

    // disable comments feed
    add_filter( 'feed_links_show_comments_feed', 'return_false' ); 

	/*
	 * Let WordPress manage the document title.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	
	// This theme uses wp_nav_menu().
	register_nav_menus( array(
		'main' => __( 'Primary Navigation Menu', 'mtf' ),
		'action' => __( 'Action Menu', 'mtf' ),
	) );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );

	// Allow theme customizations
	add_theme_support( 'custom-background', array( 'wp-head-callback' => 'return_false' ) );
	add_theme_support( 'custom-logo' );
	function change_logo_class( $html ) {
	
	    $html = str_replace( 'custom-logo', 'mtf-logo', $html );
	    $html = str_replace( 'custom-logo-link', 'mtf-home-link', $html );
	
	    return $html;
	}
	add_filter( 'get_custom_logo', 'change_logo_class' );	

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css' ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	// Ready for WooCommerce
    add_theme_support( 'woocommerce' );
}
endif; // mtf_setup
add_action( 'after_setup_theme', 'mtf_setup' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 */
function mtf_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'mtf_javascript_detection', 0 );

function hex2rgb($hex, $a = 1) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgba = array($r, $g, $b, $a);
   return implode(",", $rgba); // returns the rgb values separated by commas
   //return $rgb; // returns an array with the rgb values
}

/**
 * Enqueues scripts and styles.
 */
function mtf_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'mtf-fonts', get_theme_file_uri( '/fonts/fonts.css' ), array( 'mtf-style' ) );

	// Theme stylesheet.
	wp_enqueue_style( 'mtf-style', get_stylesheet_uri() );

	// Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
	if ( is_customize_preview() ) {
		wp_enqueue_style( 'mtf-ie9', get_theme_file_uri( '/css/ie9.css' ), array( 'mtf-style' ), '1.0' );
		wp_style_add_data( 'mtf-ie9', 'conditional', 'IE 9' );
	}

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'mtf-ie8', get_theme_file_uri( '/css/ie8.css' ), array( 'mtf-style' ), '1.0' );
	wp_style_add_data( 'mtf-ie8', 'conditional', 'lt IE 9' );

	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_theme_file_uri( '/js/html5.js' ), array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	//Remove donation styles
	wp_dequeue_style( 'hm-wcdon-frontend-styles' );

	wp_enqueue_script( 'foundation', get_theme_file_uri( '/bower_components/foundation-sites/dist/js/foundation.min.js' ), array( 'jquery' ), null, true );

	wp_enqueue_script( 'HorizontalAccordion', get_theme_file_uri( '/js/hAccord.js' ), array( 'jquery' ), null, true );

	wp_enqueue_script( 'mtf-script', get_theme_file_uri( '/js/functions.js' ), array( 'jquery' ), null, true );

	wp_localize_script( 'mtf-script', 'screenReaderText', array(
		'expand'   => __( 'expand child menu', 'mtf' ),
		'collapse' => __( 'collapse child menu', 'mtf' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'mtf_scripts' );

function return_false() {
	return false;
}

function mtf_clean_up() {
	//remove generator meta tag
	remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
	remove_action( 'wp_head', 'wp_resource_hints', 2 );
	
	// All actions related to emojis
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	
	// Filter to remove TinyMCE emojis
	add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
	
	// Remove generator tags
	remove_action('wp_head', 'wp_generator');

	//first check that woo exists to prevent fatal errors
	if ( function_exists( 'is_woocommerce' ) ) {
		//dequeue scripts and styles
		if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
			wp_dequeue_style( 'woocommerce-general' );
			wp_dequeue_style( 'woocommerce-smallscreen' );
			wp_dequeue_style( 'woocommerce-layout' );
			wp_dequeue_style( 'woocommerce_frontend_styles' );
			wp_dequeue_style( 'woocommerce_fancybox_styles' );
			wp_dequeue_style( 'woocommerce_chosen_styles' );
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
			wp_dequeue_script( 'wc_price_slider' );
			wp_dequeue_script( 'wc-single-product' );
			wp_dequeue_script( 'wc-add-to-cart' );
			wp_dequeue_script( 'wc-cart-fragments' );
			wp_dequeue_script( 'wc-checkout' );
			wp_dequeue_script( 'wc-add-to-cart-variation' );
			wp_dequeue_script( 'wc-single-product' );
			wp_dequeue_script( 'wc-cart' );
			wp_dequeue_script( 'wc-chosen' );
			wp_dequeue_script( 'woocommerce' );
			wp_dequeue_script( 'prettyPhoto' );
			wp_dequeue_script( 'prettyPhoto-init' );
			wp_dequeue_script( 'jquery-blockui' );
			wp_dequeue_script( 'jquery-placeholder' );
			wp_dequeue_script( 'fancybox' );
			wp_dequeue_script( 'jqueryui' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'mtf_clean_up', 99 );
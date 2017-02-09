<?php
/**
 * Musical Theatre Factory functions and definitions
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 */

if ( ! function_exists( 'mtf_setup' ) ) :
require_once( 'etc/custom-post-types.php' );
require_once( 'etc/app.php' );

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
		'social' => __( 'Social Media', 'mtf' )
	) );
	
	// And sidebar widgets in the footer.
	register_sidebar( array(
		'name' => __( 'Footer widgets', 'mtf' ),
		'id' => 'footer-widgets',
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title' => '<h5 class="title">',
		'after_title' => '</h5>'
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
		'caption'
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
		'audio'
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

	// Create Podcasts post type
	new custom_post_type( 'podcast', null, null, array(
		'menu_icon'	=> 'dashicons-star-filled',
        'public' => false,
        'publicly_queryable' => true,
        'show_ui' => true,
        'supports' => array( 'title', 'editor', 'custom-fields' )
	) );
	
	new custom_taxonomy( 'podcast_channel', 'podcast', 'channels', 'channel', array(
		'labels'=> array(
			'name' => 'Podcast Channels',
			'menu_name' => 'Channels'
		),
		'hierarchical' => true,
        'show_admin_column'  => true
	) );
	new custom_taxonomy( 'podcast_tag', 'podcast', 'tags', 'tag', array(
		'labels'=> array(
			'name' => 'Podcast Tags',
			'menu_name' => 'Tags'
		),
        'show_admin_column'  => true
	) );

	// Create Projects post type
	new custom_post_type( 'project', null, null, array(
		'menu_icon'	=> 'dashicons-image-filter',
        'hierarchical' => true,
        'has_archive' => false,
        'supports' => array( 'title', 'editor', 'thumbnail', 'revisions', 'page-attributes', 'custom-fields', 'excerpt' )
	) );
	
	new custom_taxonomy( 'project_cat', 'project', 'categories', 'category', array(
		'labels'=> array(
			'name' => 'Project Categories',
			'menu_name' => 'Categories'
		),
		'hierarchical' => true,
        'show_admin_column'  => true
	) );
	new custom_taxonomy( 'project_tag', 'project', 'tags', 'tag', array(
		'labels'=> array(
			'name' => 'Project Tags',
			'menu_name' => 'Tags'
		),
        'show_admin_column'  => true
	) );
}
endif; // mtf_setup
add_action( 'after_setup_theme', 'mtf_setup' );

function mtf_archive_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    }
  
    return $title;
}
add_filter( 'get_the_archive_title', 'mtf_archive_title' );

function mtf_events_category() {
    $tribe_events_cat = get_taxonomy( 'tribe_events_cat' );
	$singular = 'program';
	$plural = 'programs';
    $tribe_events_cat->rewrite['slug'] = $plural;
    
    register_taxonomy( 'tribe_events_cat', 'tribe_events', (array) $tribe_events_cat );
}
add_action( 'init', 'mtf_events_category', 11 );

function mtf_podcast_feed_rss2( $for_comments ) {
    $rss_template = get_template_directory() . '/etc/feed-podcast-rss2.php';
    if( get_query_var( 'post_type' ) == 'podcast' and file_exists( $rss_template ) )
        load_template( $rss_template );
    else
        do_feed_rss2( $for_comments ); // Call default function
}
remove_all_actions( 'do_feed_rss2' );
add_action( 'do_feed_rss2', 'mtf_podcast_feed_rss2', 10, 1 );

function mtf_feeds() {
	$post_types = array('podcast');
	foreach( $post_types as $post_type ) {
	    $feed = get_post_type_archive_feed_link( $post_type );
	    if ( $feed === '' || !is_string( $feed ) ) {
	        $feed =  get_bloginfo( 'rss2_url' ) . "?post_type=$post_type";
	    }
	    printf(__('<link rel="%1$s" type="%2$s" title="%3$s" href="%4$s" />'), "alternate", "application/rss+xml", get_bloginfo()." &#8211; Podcasts", $feed);
	}
}
add_action( 'wp_head', 'mtf_feeds', 1 );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 */
function mtf_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'mtf_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 */
function mtf_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'mtf-fonts', get_theme_file_uri( '/dist/fonts/fonts.css' ), array( 'mtf-style' ) );

	// Theme stylesheet.
	wp_enqueue_style( 'mtf-style', get_stylesheet_uri() );

	// Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
	if ( is_customize_preview() ) {
		wp_enqueue_style( 'mtf-ie9', get_theme_file_uri( '/dist/css/ie9.css' ), array( 'mtf-style' ), '1.0' );
		wp_style_add_data( 'mtf-ie9', 'conditional', 'IE 9' );
	}

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'mtf-ie8', get_theme_file_uri( '/dist/css/ie8.css' ), array( 'mtf-style' ), '1.0' );
	wp_style_add_data( 'mtf-ie8', 'conditional', 'lt IE 9' );

	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_theme_file_uri( '/dist/js/html5.js' ), array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	//Remove donation styles
	wp_dequeue_style( 'hm-wcdon-frontend-styles' );

	wp_enqueue_script( 'background-check', get_theme_file_uri( '/bower_components/background-check/background-check.min.js' ), array( 'jquery' ), null, true );
	wp_enqueue_script( 'mtf-script', get_theme_file_uri( '/dist/js/scripts.min.js' ), array( 'jquery' ), null, true );

	wp_localize_script( 'mtf-script', 'screenReaderText', array(
		'expand'   => __( 'expand child menu', 'mtf' ),
		'collapse' => __( 'collapse child menu', 'mtf' )
	) );
}
add_action( 'wp_enqueue_scripts', 'mtf_scripts' );

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
		if ( ! is_woocommerce() ) {
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

function mtf_google() {
	echo "<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MJC2VLF');</script>";
	echo "<script type='text/javascript'>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
	
	  ga('create', 'UA-91342172-1', 'auto');
	  ga('send', 'pageview');
	
	</script>";
}
add_action( 'wp_head', 'mtf_google' );
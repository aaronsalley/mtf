<?php
  /**
   * Musical Theatre Factory functions and definitions
   *
   * Functions that are not pluggable (not wrapped in function_exists()) are
   * instead attached to a filter or action hook.
   */

  include('admin/helpers.php');
  include('admin/permissions.php');
  include('admin/projects.php');

  add_action( 'after_setup_theme', 'mtf_setup' );
  if ( ! function_exists( 'mtf_setup' ) ) :
    function mtf_setup() {
    	load_theme_textdomain( 'mtf' );

      add_post_type_support( 'page', 'excerpt' );

      // Ready for WooCommerce
      add_theme_support( 'woocommerce' );
      // add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

    	add_theme_support( 'automatic-feed-links' );
      add_theme_support( 'title-tag' );
    	add_theme_support( 'post-thumbnails' );
      add_theme_support( 'html5', array(
    		'search-form',
    		'comment-form',
    		'comment-list',
    		'gallery',
    		'caption',
    	) );
      add_theme_support( 'post-formats', array(
    		'aside',
    		'image',
    		'video',
    		'quote',
    		'link',
    		'gallery',
    		'audio',
    	) );
      add_theme_support( 'custom-background', array(
        'wp-head-callback' => 'return_false',
      ) );
    	add_theme_support( 'custom-logo' );
      add_theme_support( 'customize-selective-refresh-widgets' );

    	register_nav_menus( array(
    		'primary' => __( 'Primary Navigation Menu', 'mtf' ),
    		'action' => __( 'Action Menu', 'mtf' ),
    		'social' => __( 'Social Media', 'mtf' )
    	) );
    	register_sidebar( array(
    		'name' => __( 'Footer widgets', 'mtf' ),
    		'id' => 'footer-widgets',
    		'before_widget' => '<div class="widget">',
    		'after_widget'  => '</div>',
    		'before_title' => '<h5 class="title">',
    		'after_title' => '</h5>'
    	) );

      add_filter( 'feed_links_show_comments_feed', 'return_false' );
      add_filter( 'get_custom_logo', 'change_logo_class' );
      function change_logo_class( $html ) {
    	    $html = str_replace( 'custom-logo', 'mtf-logo', $html );
    	    $html = str_replace( 'custom-logo-link', 'mtf-home-link', $html );

    	    return $html;
    	}

    	// Indicate widget sidebars can use selective refresh in the Customizer.
    	add_editor_style( array( 'assets/css/editor-style.css' ) );
    }
  endif; // mtf_setup

  add_action( 'wp_enqueue_scripts', 'mtf_scripts' );
  function mtf_scripts() {
  	// wp_enqueue_style( 'mtf-fonts', get_theme_file_uri( 'assets/fonts/fonts.css' ), array( 'mtf-style' ) );

  	wp_enqueue_style( 'mtf-style', get_stylesheet_uri() );

  	if ( is_customize_preview() ) {
  		wp_enqueue_style( 'mtf-ie9', get_theme_file_uri( 'assets/css/ie9.css' ), array( 'mtf-style' ));
  		wp_style_add_data( 'mtf-ie9', 'conditional', 'IE 9' );
  	}

  	wp_enqueue_style( 'mtf-ie8', get_theme_file_uri( 'assets/css/ie8.css' ), array( 'mtf-style' ));
  	wp_style_add_data( 'mtf-ie8', 'conditional', 'lt IE 9' );

  	wp_enqueue_script( 'html5', get_theme_file_uri( 'assets/js/html5.js' ));
  	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

  	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
  		wp_enqueue_script( 'comment-reply' );
  	}

  	wp_dequeue_style( 'hm-wcdon-frontend-styles' );

  	wp_enqueue_script( 'mtf-script', get_theme_file_uri( 'assets/js/vendors.js' ), null, null, true );

  	wp_localize_script( 'mtf-script', 'screenReaderText', array(
  		'expand'   => __( 'expand child menu', 'mtf' ),
  		'collapse' => __( 'collapse child menu', 'mtf' )
  	) );
  }

  add_action( 'admin_enqueue_scripts', 'mtf_admin_scripts' );
  function mtf_admin_scripts() {
  	wp_enqueue_style( 'mtf-admin', get_theme_file_uri( 'assets/css/admin.css' ) );
  }

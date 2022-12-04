<?php

if (!function_exists('mtfmusicals_setup')) :
  function mtfmusicals_setup()
  {
    // Add support for block styles.
    add_theme_support('wp-block-styles');

    // Enqueue editor styles.
    add_editor_style('style.css');
  }
endif;
add_action('after_setup_theme', 'mtfmusicals_setup');

if (!function_exists('mtfmusicals_styles')) :

  function mtfmusicals_styles()
  {
    // Register theme stylesheet.
    $theme_version = wp_get_theme()->get('Version');

    $version_string = is_string($theme_version) ? $theme_version : false;
    wp_register_style(
      'mtfmusicals-style',
      get_template_directory_uri() . '/styles/index.css',
      array(),
      $version_string
    );

    // Enqueue theme stylesheet.
    wp_enqueue_style('mtfmusicals-style');
  }

endif;
add_action('wp_enqueue_scripts', 'mtfmusicals_styles');

if (!function_exists('mtfmusicals_scripts')) :

  function mtfmusicals_scripts()
  {
    // Register theme stylesheet.
    $theme_version = wp_get_theme()->get('Version');

    $version_string = is_string($theme_version) ? $theme_version : false;
    wp_register_script(
      'font-awesome',
      "https://kit.fontawesome.com/07e616e69d.js",
    );

    // Enqueue theme stylesheet.
    wp_enqueue_script('font-awesome');
  }

endif;
add_action('wp_enqueue_scripts', 'mtfmusicals_scripts');

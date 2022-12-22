<?php

if (!function_exists('mtfmusicals_setup')) :
  function mtfmusicals_setup()
  {
    // Add support for block styles.
    add_theme_support('wp-block-styles');

    add_theme_support('title-tag');

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
      get_template_directory_uri() . '/static/index.css',
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
  }

endif;
add_action('wp_enqueue_scripts', 'mtfmusicals_scripts');

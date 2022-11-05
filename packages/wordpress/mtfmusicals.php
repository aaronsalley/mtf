<?php
/**
 * MTF Musicals
 *
 * @copyright         2022 Aaron Salley LLC
 *
 * Plugin Name:       MTF Musicals
 * Plugin URI:        https://mtf.nyc/
 * Description:       Enables expanded support.
 * Version:           7.0.0
 * Requires at least: 5.0
 * Requires PHP:      7.0
 * Author:            Aaron Salley
 * Author URI:        https://aaronsalley.com/
 * License:           GNU General Public License v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       mtfmusicals
 */

if ( ! class_exists( 'MTF_Musicals' ) ){
  class MTF_Musicals {
    protected static $ROOT_DIR;

    protected $loader;

    function __construct()
    {
      self::$ROOT_DIR = __DIR__;

      $this->init();
    }
    
    function theme_mods() {
      add_action( 'after_setup_theme', function () {
        add_theme_support( 'menus' );
        add_theme_support( 'custom-logo' );
        
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'post-formats',  array ( 'aside', 'gallery', 'quote', 'image', 'video' ) );
        
        add_post_type_support( 'page', 'excerpt' );
        
        register_nav_menus( array ( 'mega' => 'Site Menu', 'nav' => 'Main Navigation' ) );
      });
    }

    function manual_excerpts() {
      add_filter( 'wp_trim_excerpt', function ( $excerpt, $raw_excerpt ){
        if ( $raw_excerpt )
          return $excerpt;

        return null;
      }, 99, 2);
    }
    
    function enable_elementor() {
      add_action( 'elementor/theme/register_locations', function ( $elementor_theme_manager ) {
        $elementor_theme_manager->register_all_core_location();
      });
    }
    
    function logger( $message ) {
      // Dump message, or any other variable for that matter
      ob_start();
      var_dump($message);
      $contents = ob_get_contents();
      ob_end_clean();
      
      error_log($contents);
    }

    function get_loader() {
      return $this->loader;
    }
    
    function load_files() {
      // include_once self::$ROOT_DIR . '/admin/cors.php';
      include_once self::$ROOT_DIR . '/admin/events/events.php';
      include_once self::$ROOT_DIR . '/admin/media/media.php';
      include_once self::$ROOT_DIR . '/includes/required-plugins.php';
    }
    
    function init() {
      $this->load_files();
      $this->theme_mods();
      $this->enable_elementor();
      $this->manual_excerpts();
    }
  }

  new MTF_Musicals;
}
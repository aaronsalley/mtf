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

if (!class_exists('MTF_Musicals')) {
  class MTF_Musicals
  {
    protected static $DOMAIN = 'mtfmusicals';
    protected static $ROOT_DIR;
    protected static $WP_PLUGIN_DIR;

    protected static $EVENTS;
    protected static $MEDIA;
    protected static $PLUGINS;

    protected $loader;

    function __construct()
    {
      self::$ROOT_DIR = dirname(__FILE__);
      self::$WP_PLUGIN_DIR = dirname(__FILE__, 2);

      $this->init();
    }

    public static function logger($message)
    {
      // Dump message, or any other variable for that matter
      ob_start();
      var_dump($message);
      $contents = ob_get_contents();
      ob_end_clean();

      error_log($contents);
    }

    public static function load_template_part($template_name, $part_name = null)
    {
      ob_start();
      get_template_part($template_name, $part_name);
      $var = ob_get_contents();
      ob_end_clean();
      return $var;
    }

    protected function get_loader()
    {
      return $this->loader;
    }

    private function theme_mods()
    {
      add_action('after_setup_theme', function () {
        add_theme_support('menus');
        add_theme_support('custom-logo');

        add_theme_support('post-thumbnails');
        add_theme_support('post-formats',  array('aside', 'gallery', 'quote', 'image', 'video'));

        add_post_type_support('page', 'excerpt');

        register_nav_menus(array('mega' => 'Site Menu', 'nav' => 'Main Navigation'));
      });
    }

    private function manual_excerpts()
    {
      add_filter('wp_trim_excerpt', function ($excerpt, $raw_excerpt) {
        if ($raw_excerpt)
          return $excerpt;

        return null;
      }, 99, 2);
    }

    private function enable_elementor()
    {
      add_action('elementor/theme/register_locations', function ($elementor_theme_manager) {
        $elementor_theme_manager->register_all_core_location();
      });
    }

    private function enable_elementor_landing_pages()
    {
      add_action('pre_get_posts', function (\WP_Query $query) {
        if (
          // If the post type includes the Elementor landing page CPT.
          class_exists('\Elementor\Modules\LandingPages\Module')
          && is_array($query->get('post_type'))
          && in_array(\Elementor\Modules\LandingPages\Module::CPT, $query->get('post_type'), true)
          // If custom permalinks are enabled.
          && '' !== get_option('permalink_structure')
          // If the query is for a front-end page.
          && (!is_admin() || wp_doing_ajax())
          && $query->is_main_query()
          // If the query is for a page.
          && isset($query->query['page'])
          // If the query is not for a static home/blog page.
          && !is_home()
          // If the page name has been set and is not for a path.
          && !empty($query->query['pagename'])
          && false === strpos($query->query['pagename'], '/')
          // If the name has not already been set.
          && empty($query->query['name'])
        ) {
          $query->set('name', $query->query['pagename']);
        }
      }, 100);
    }

    private function load_files()
    {
      // include_once self::$ROOT_DIR . '/admin/cors.php';
      include_once self::$ROOT_DIR . '/admin/events.php';
      include_once self::$ROOT_DIR . '/admin/media.php';
      include_once self::$ROOT_DIR . '/admin/plugins.php';
    }

    private function init()
    {
      $this->load_files();
      $this->theme_mods();
      $this->enable_elementor();
      $this->enable_elementor_landing_pages();
      $this->manual_excerpts();

      self::$EVENTS = new MTF_Musicals\Events;
      self::$MEDIA = new MTF_Musicals\Media;
      self::$PLUGINS = new MTF_Musicals\Plugins;
    }
  }

  new MTF_Musicals;
}

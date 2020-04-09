<?php
/**
 * Plugin Name: Mission Command
 */
class Mission_Command_Admin {
  static $EVENTS;
  static $PEOPLE;
  static $PROJECTS;
  static $REPORTS;
  static $group_location = 27;

  function __construct(){
    include 'events/index.php';
    self::$EVENTS = new Events();
    include 'people/index.php';
    self::$PEOPLE = new People();
    include 'projects/index.php';
    self::$PROJECTS = new Projects();
    include 'reports/index.php';
    self::$REPORTS = new Reports();

    $this->remove_dashboard_widgets();
    $this->add_menu_separator();
  }

  function remove_dashboard_widgets(){
    add_action( 'wp_dashboard_setup', function() {
      remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
      remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );
      remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
      remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
      remove_meta_box( 'dashboard_site_health', 'dashboard', 'normal' );
    });
  }

  function register_new_post_type( $singular, $plural, $slug, $icon ){
    add_action( 'init', function () use ( $singular, $plural, $slug, $icon ) {
      register_post_type(
          'mission_cmd_' . $slug,
          [
              'labels' => [
                'name' => __( $plural, 'mission_command' ),
                'singular_name' => __( $singular, 'mission_command' ),
                'add_new' => _x( 'Add New ' . $singular, 'mission_command', 'mission_command' ),
                'edit_item' => __( 'Edit ' . $singular, 'mission_command' ),
                'new_item' => __( 'New ' . $singular, 'mission_command' ),
                'view_item' => __( 'View ' . $singular, 'mission_command' ),
                'search_items' => __( 'Search ' . $plural, 'mission_command' ),
                'not_found' => __( 'No ' . $plural . ' found', 'mission_command' ),
                'not_found_in_trash' => __( 'No ' . $plural . ' found in Trash', 'mission_command' )
              ],
              'public' => true,
              'has_archive' => false,
              'supports' => [ 'title', 'thumbnail', 'page-attributes' ],
              'menu_icon' => $icon,
              'menu_position' => self::$group_location,
              'show_in_rest' => true,
              'rewrite' => [ 'slug' => $slug, 'with_front' => false ]
          ]
      );
      register_taxonomy( "mission_cmd_{$slug}_tag", "mission_cmd_{$slug}", array(
        'labels' => [
          'name' => __( 'Tags', 'mission_command' ),
          'singular_name' => __( 'Tag', 'mission_command' ),
          'add_new' => _x( 'Add New Tag', 'mission_command', 'mission_command' ),
          'edit_item' => __( 'Edit Tag', 'mission_command' ),
          'new_item' => __( 'New Tag', 'mission_command' ),
          'view_item' => __( 'View Tag', 'mission_command' ),
          'search_items' => __( 'Search Tags', 'mission_command' ),
          'not_found' => __( 'No Tags found', 'mission_command' ),
          'not_found_in_trash' => __( 'No Tags found in Trash', 'mission_command' )
        ]
      ));
      register_taxonomy( "mission_cmd_{$slug}_categories", "mission_cmd_{$slug}", array(
        'labels' => [
          'name' => __( 'Categories', 'mission_command' ),
          'singular_name' => __( 'Category', 'mission_command' ),
          'add_new' => _x( 'Add New Category', 'mission_command', 'mission_command' ),
          'edit_item' => __( 'Edit Category', 'mission_command' ),
          'new_item' => __( 'New Category', 'mission_command' ),
          'view_item' => __( 'View Category', 'mission_command' ),
          'search_items' => __( 'Search Categories', 'mission_command' ),
          'not_found' => __( 'No Categories found', 'mission_command' ),
          'not_found_in_trash' => __( 'No Categories found in Trash', 'mission_command' )
        ]
      ));
    });
  }

  function add_menu_separator(){
    function add_admin_menu_separator( $position ) {
      global $menu;
      $index = 0;
      foreach( $menu as $offset => $section ) {
          if ( substr( $section[2], 0, 9 ) == 'separator' )
          $index++;
          if ( $offset >= $position ) {
              $menu[ $position ] = array( '', ' read', "separator{$index}", '', 'wp-menu-separator' );
              break;
          }
      }
      ksort( $menu );
    }
    function admin_menu_separator() {
      add_admin_menu_separator( 26 );
    }
    add_action( 'admin_init','admin_menu_separator' );
  }
}

new Mission_Command_Admin();
<?php
include 'events/index.php';
include 'people/index.php';
include 'projects/index.php';

class MTF_Admin {
  static $EVENTS;
  static $PEOPLE;
  static $PROJECTS;
  static $group_location = 27;

  function __construct(){
    $this->$EVENTS = new Events();
    $this->$PEOPLE = new People();
    $this->$PROJECTS = new Projects();

    $this->remove_dashboard_widgets();
    $this->add_menu_separator();
  }

  function remove_dashboard_widgets(){
    function widgets() {
      remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
      remove_meta_box('dashboard_activity', 'dashboard', 'normal');
      remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
      remove_meta_box('dashboard_primary', 'dashboard', 'side');
      remove_meta_box('dashboard_site_health', 'dashboard', 'normal');
    };
    add_action('wp_dashboard_setup', 'widgets');
  }

  function add_menu_separator(){
    function add_admin_menu_separator($position) {
      global $menu;
      $index = 0;
      foreach($menu as $offset => $section) {
          if (substr($section[2],0,9)=='separator')
          $index++;
          if ($offset>=$position) {
              $menu[$position] = array('','read',"separator{$index}",'','wp-menu-separator');
              break;
          }
      }
      ksort( $menu );
    }
    function admin_menu_separator() {add_admin_menu_separator(26);}
    add_action('admin_init','admin_menu_separator');
  }
}

new MTF_Admin();
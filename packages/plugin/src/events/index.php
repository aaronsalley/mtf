<?php 
class Events extends Mission_Command_Admin {
  private static $singular;
  private static $plural;
  private static $slug;
  private static $icon;

  function __construct(){
    self::$singular = 'Event';
    self::$plural = 'Events';
    self::$slug = 'events';
    self::$icon = 'dashicons-tickets-alt';

    // $this->register_new_post_type(self::$singular, self::$plural, self::$slug, self::$icon);
    $this->add_menu_page();
  }

  private function add_menu_page(){
    add_action( 'admin_menu', function() {
      add_menu_page(
        $page_title = self::$plural,
        $menu_title = self::$plural,
        $capability = 'edit_posts',
        $menu_slug = 'mission_control_' . self::$slug,
        $function = function (){
          echo '<div id="mission-control">Mission Control React App</div>';
        },
        $icon_url = self::$icon,
        $position = parent::$group_location,
      );
    });
  }
}
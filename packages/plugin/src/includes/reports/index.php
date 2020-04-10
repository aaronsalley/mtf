<?php 
class Reports extends Mission_Command_Admin {
  const singular = 'Report';
  const plural = 'Reports';
  const slug = 'report';
  const icon = 'dashicons-analytics';

  function __construct(){
    // $this->register_new_post_type(self::$singular, self::$plural, self::$slug, self::$icon);
    $this->add_menu_page();
  }

  private function add_menu_page(){
    add_action( 'admin_menu', function() {
      add_menu_page(
        $page_title = self::plural,
        $menu_title = self::plural,
        $capability = 'edit_posts',
        $menu_slug = 'mission_control_' . self::slug,
        $function = function (){
          echo '<div id="mission-control">Mission Control React App</div>';
        },
        $icon_url = self::icon,
        $position = parent::group_location,
      );
    });
  }
}
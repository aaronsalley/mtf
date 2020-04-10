<?php 
class Projects extends Mission_Command_Admin {
  private static $singular;
  private static $plural;
  private static $slug;
  private static $icon;

  public function __construct(){
    // parent::__construct();

    add_action('admin_menu', 'register_admin_menu');
  }

  private function register_admin_menu(){

  }

  // private function add_menu_page(){
    // add_action( 'admin_menu', function() {
    //   add_menu_page(
    //     $page_title = self::$plural,
    //     $menu_title = self::$plural,
    //     $capability = 'edit_posts',
    //     $menu_slug = 'mission_control_' . self::$slug,
    //     $function = function (){
    //       echo '<div id="mission-control">Mission Control React App</div>';
    //     },
    //     $icon_url = self::$icon,
    //     $position = parent::$group_location,
    //   );
    // });
  // }
}
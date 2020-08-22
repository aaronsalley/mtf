<?php
namespace Mission_Command;

require_once plugin_dir_path( dirname( __FILE__ ) ) . '/index.php';

class Email extends Admin {
  protected static $component = array ( 
    'plural' => 'Email',
    'singular' => 'Email',
    'icon' => 'dashicons-analytics',
  );

  public function __construct( /* $mission_command, $version */ ) {
    add_action('admin_menu', array($this, 'add_admin_menu_page'));
  }
  
	public function add_admin_menu_page() {
    add_menu_page(
      $page_title = self::$component['plural'],
      $menu_title = self::$component['plural'],
      $capability = 'edit_posts',
      $menu_slug = 'mission_cmd_' . strtolower(self::$component['plural']),
      $function = function (){
        echo '<div id="mission-command">Mission Control React App</div>';
      },
      $icon_url = self::$component['icon'],
      $position = parent::$position,
    );
	}

}

$events = new Email();

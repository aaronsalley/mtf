<?php
namespace Mission_Command;

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Mission_Command
 * @subpackage Mission_Command/admin
 * @author     Disruptv <q@disruptv.io>
 */
class Admin {

	protected $mission_command;
	protected $version;
	protected $components;

	public function __construct( $mission_command, $version ) {

		$this->mission_command = $mission_command;
		$this->version = $version;
	}

	private function add_admin_menu_separator( $position ) {
		global $menu;
		static $uid = 0;

		if ( !is_int($position) ) {
			$menuPosition = 0;
			foreach($menu as $menuPosition => $item) {
					if ( $item[2] === $position ) {
							break;
					}
			}
			$position = $menuPosition - 1;
		}

		$menuFile = 'mission-command-separator';
		$menu[$position] = array(
				'',
				'read',
				$menuFile,
				'',
				'wp-menu-separator mission-command',
		);
		ksort($menu);
	}

	public function add_admin_menu_pages() {
		static $position = 26;

		static $components = [
			array ( 
				'plural' => 'Events',
				'sigular' => 'Event',
				'icon' => 'dashicons-tickets-alt',
			),
			array ( 
				'plural' => 'People',
				'sigular' => 'Person',
				'icon' => 'dashicons-groups',
			),
			array ( 
				'plural' => 'Projects',
				'sigular' => 'Project',
				'icon' => 'dashicons-awards',
			),
			array ( 
				'plural' => 'Reports',
				'sigular' => 'Report',
				'icon' => 'dashicons-analytics',
			),
		];
		
		$this->add_admin_menu_separator($position);

		foreach( $components as $index => $component) {
      add_menu_page(
        $page_title = $component['plural'],
        $menu_title = $component['plural'],
        $capability = 'edit_posts',
        $menu_slug = 'mission_control_' . strtolower($component['plural']),
        $function = function (){
          echo '<div id="mission-control">Mission Control React App</div>';
        },
        $icon_url = $component['icon'],
        $position = $position . '.' . $index,
      );
		}
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mission_Command_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mission_Command_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->mission_command, plugin_dir_url( __FILE__ ) . 'css/admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mission_Command_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mission_Command_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->mission_command, plugin_dir_url( __FILE__ ) . 'js/admin.js', array( 'jquery' ), $this->version, false );

	}

}

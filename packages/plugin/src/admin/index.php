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
	protected static $position = 26;

	public function __construct( $mission_command, $version ) {

		$this->mission_command = $mission_command;
		$this->version = $version;

		$this->load_dependencies();
		$this->add_admin_menu_separator(self::$position);
	}

	function load_dependencies(){
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/components/events.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/components/people.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/components/projects.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/components/reports.php';
		// require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/components/email.php';
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
	public function enqueue_scripts($hook_suffix) {
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

		 wp_enqueue_script( $this->mission_command, plugin_dir_url( __FILE__ ) . 'js/admin.js', array(), $this->version, true );

	}

}

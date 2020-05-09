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
	protected static $components = [
		array ( 
			'plural' => 'Events',
			'singular' => 'Event',
			'icon' => 'dashicons-tickets-alt',
		),
		array ( 
			'plural' => 'People',
			'singular' => 'Person',
			'icon' => 'dashicons-groups',
		),
		array ( 
			'plural' => 'Projects',
			'singular' => 'Project',
			'icon' => 'dashicons-awards',
		),
		array ( 
			'plural' => 'Reports',
			'singular' => 'Report',
			'icon' => 'dashicons-analytics',
		),
	];
	public $comp;

	public function __construct( $mission_command, $version ) {

		$this->mission_command = $mission_command;
		$this->version = $version;

		// $this->load_dependencies();
		
	}

	function load_dependencies(){
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/components/events.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/components/people.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/components/projects.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/components/reports.php';

	}

	public function test(){
		print_r('Testing testing testing');
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
		
		$this->add_admin_menu_separator( self::$position );

		foreach( self::$components as $index => $component) {
      add_submenu_page(
				$parent_slug = 'edit.php?post_type=mission_cmd_' . strtolower($component['singular']),
        $page_title = $component['plural'],
        $menu_title = $component['plural'],
        $capability = 'edit_posts',
        $menu_slug = 'mission_cmd_' . strtolower($component['plural']),
        $function = function (){
          echo '<div id="mission-command">Mission Control React App</div>';
        },
        // $icon_url = $component['icon'],
        // $position = self::$position . '.' . $index,
			);
		}
	}

	public function register_post_types() {
		foreach( self::$components as $index => $component) {
			register_post_type(
				$post_type = 'mission_cmd_' . strtolower($component['singular']),
        $args = array(
					'labels' => [
							'name' => __($component['plural'], 'mission_command'),
							'singular_name' => __($component['singular'], 'mission_command'),
							'add_new' => _x('Add New ' . $component['singular'], 'mission_command', 'mission_command'),
							'edit_item' => __('Edit ' . $component['singular'], 'mission_command'),
							'new_item' => __('New ' . $component['singular'], 'mission_command'),
							'view_item' => __('View ' . $component['singular'], 'mission_command'),
							'search_items' => __('Search ' . $component['plural'], 'mission_command'),
							'not_found' => __('No ' . $component['plural'] . ' found', 'mission_command'),
							'not_found_in_trash' => __('No ' . $component['plural'] . ' found in Trash', 'mission_command')
					],
					'public' => true,
				// 	$hierarchical = false,
					'has_archive' => false,
					'supports' => ['title', 'thumbnail', 'page-attributes', 'editor'],
					'menu_icon' => $component['icon'],
					'menu_position' => self::$position . '.' . $index,
					'show_in_rest' => true,
					// 'taxonomies' => array('post_tag', 'product-categories'),
					'rewrite' => [
						'slug' => strtolower($component['singular']), 
						'with_front' => false,
					]
				)
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

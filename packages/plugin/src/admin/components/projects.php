<?php
namespace Mission_Command;

require_once plugin_dir_path( dirname( __FILE__ ) ) . '/index.php';
class Projects extends Admin {
  protected static $component = array ( 
    'plural' => 'Projects',
    'singular' => 'Project',
    'icon' => 'dashicons-awards',
  );

  public function __construct( /* $mission_command, $version */ ) {
    add_action('init', array($this, 'register_mission_cmd_post_type'));
  }

  function register_mission_cmd_post_type() {
		register_post_type(
			$post_type = 'mission_cmd_' . strtolower(self::$component['singular']),
			$args = array(
				'labels' => [
						'name' => __(self::$component['plural'], 'mission_command'),
						'singular_name' => __(self::$component['singular'], 'mission_command'),
						'add_new' => _x('Add New ' . self::$component['singular'], 'mission_command', 'mission_command'),
						'edit_item' => __('Edit ' . self::$component['singular'], 'mission_command'),
						'new_item' => __('New ' . self::$component['singular'], 'mission_command'),
						'view_item' => __('View ' . self::$component['singular'], 'mission_command'),
						'search_items' => __('Search ' . self::$component['plural'], 'mission_command'),
						'not_found' => __('No ' . self::$component['plural'] . ' found', 'mission_command'),
						'not_found_in_trash' => __('No ' . self::$component['plural'] . ' found in Trash', 'mission_command')
				],
				'public' => true,
        // 	$hierarchical = false,
				'has_archive' => false,
				'supports' => ['title', 'thumbnail', 'page-attributes', 'editor'],
				'menu_icon' => self::$component['icon'],
				// 'menu_position' => parent::$position . '.' . $index,
				'show_in_rest' => true,
				// 'taxonomies' => array('post_tag', 'product-categories'),
				'rewrite' => [
					'slug' => strtolower(self::$component['singular']), 
					'with_front' => false,
				]
			)
		);
	}

}

$events = new Projects();
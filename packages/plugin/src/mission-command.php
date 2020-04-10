<?php
/**
 * Plugin Name: Mission Command
 * Description: Mission command has everything you need to effectively run your non-profit on a shoestring buget.
 * Plugin URI: 
 * Author: Disruptv
 * Version: 1.0.0
 * Author URI: https://disruptv.io
 *
 * Text Domain: mission_command
 *
 * @package Mission Command
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'MISSION_COMMAND_VERSION', '1.0.0' );

function activate_mission_command() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/activator.php';
	Plugin_Name_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_mission_command() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/deactivator.php';
	Plugin_Name_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mission_command' );
register_deactivation_hook( __FILE__, 'deactivate_mission_command' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/plugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mission_command() {

	$plugin = new Mission_Command();
	$plugin->run();

}
// run_mission_command();

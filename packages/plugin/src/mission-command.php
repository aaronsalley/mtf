<?php
namespace Mission_Command;

/**
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           Mission_Command
 *
 * @wordpress-plugin
 * Plugin Name:       Mission Command
 * Plugin URI:        https://disruptv.io/missioncommand
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Disruptv
 * Author URI:        https://disruptv.io/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mission-command
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
define( 'MISSION_COMMAND_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 */
function activate_mission_command() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/activator.php';
	Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_mission_command() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/deactivator.php';
	Deactivator::deactivate();
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
 * @since    1.0.0
 */
function run_mission_command() {

	$plugin = new Mission_Command();
	$plugin->run();

}
run_mission_command();

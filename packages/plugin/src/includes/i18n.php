<?php
namespace Mission_Command;

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Mission_Command
 * @subpackage Mission_Command/includes
 * @author     Disruptv <q@disruptv.io>
 */
class i18n {

	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'mission-command',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}
}

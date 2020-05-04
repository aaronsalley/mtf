<?php
namespace Mission_Command;

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Mission_Command
 * @subpackage Mission_Command/public
 * @author     Disruptv <q@disruptv.io>
 */
class API {

	private $mission_command;
	private $version;

	public function __construct( $mission_command, $version ) {

		$this->mission_command = $mission_command;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->mission_command, plugin_dir_url( __FILE__ ) . 'css/public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->mission_command, plugin_dir_url( __FILE__ ) . 'js/public.js', array( 'jquery' ), $this->version, false );

	}

}

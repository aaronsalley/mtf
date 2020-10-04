<?php
/**
 * Setup required plugins
 */
require_once get_template_directory() . '/classes/class-tgm-plugin-activation.php';
function mtf_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin bundled with a theme.
		// array(
		// 	'name'               => 'Mission Command', // The plugin name.
		// 	'slug'               => 'mission-command', // The plugin slug (typically the folder name).
		// 	'source'             => dirname( __FILE__ ) . '/lib/plugins/mission-command.zip', // The plugin source.
		// 	'required'           => true, // If false, the plugin is only 'recommended' instead of required.
		// 	'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
		// 	'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
		// 	'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		// 	'external_url'       => 'https://github.com/jrfnl/WP-adminbar-comments-to-pending/archive/master.zip', // If set, overrides default API URL and points to an external URL.
		// 	'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		// ),

		array(
			'name'      => 'Elementor',
			'slug'      => 'elementor',
			'required'  => true,
			'force_activation'   => true,
		),

		array(
			'name'      => 'Essential Addons for Elementor',
			'slug'      => 'essential-addons-for-elementor-lite',
			'required'  => true,
			'force_activation'   => true,
		),
	);

	$config = array(
		'id'           => 'mtf',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'mtf-install-plugins', // Menu slug.
		'parent_slug'  => 'plugins.php',            // Parent menu slug.
		'capability'   => 'manage_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'mtf_register_required_plugins' );

/**
 * Register Elementor locations
 */
function mtf_register_elementor_locations( $elementor_theme_manager ) {

	$elementor_theme_manager->register_all_core_location();

}
add_action( 'elementor/theme/register_locations', 'mtf_register_elementor_locations' );

/**
 * Register WooCommerce support
 */
function mtf_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'mtf_add_woocommerce_support' );

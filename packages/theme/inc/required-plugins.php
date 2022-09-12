<?php 
require get_theme_file_path('lib/autoload.php');

add_action( 'tgmpa_register', 'mtfmusicals_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 * 
 * See http://tgmpluginactivation.com/configuration/ for more options.
 */
function mtfmusicals_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		// WP GraphQL
		array(
			'name'							=> 'WP GraphQL',
			'slug'							=> 'wp-graphql',
			'required'					=> true,
			'force_activation'	=> true,
		),
		// WP Stateless
		array(
			'name'							=> 'WP-Stateless',
			'slug'							=> 'wp-stateless',
			'required'					=> true,
			'force_activation'	=> false,
		),

		// The Events Calendar
		array(
			'name'							=> 'The Events Calendar',
			'slug'							=> 'the-events-calendar',
			'required'					=> true,
			'force_activation'	=> true,
		),
		// The Events Calendar Pro
		array(
			'name'							=> 'The Events Calendar Pro',
			'slug'							=> 'events-calendar-pro',
			'required'					=> true,
			'force_activation'	=> true,
			'source'             => get_stylesheet_directory() . '/lib/events-calendar-pro.6.0.0.zip', // The plugin source.
			'external_url'       => 'https://theeventscalendar.com/', // If set, overrides default API URL and points to an external URL.
		),
		// The Events Calendar: Eventbrite Tickets
		array(
			'name'							=> 'The Events Calendar: Eventbrite Tickets',
			'slug'							=> 'the-events-calendar-eventbrite-tickets',
			'required'					=> true,
			'force_activation'	=> true,
			'source'             => get_stylesheet_directory() . '/lib/the-events-calendar-eventbrite-tickets.4.6.11.zip', // The plugin source.
			'external_url'       => 'https://theeventscalendar.com/', // If set, overrides default API URL and points to an external URL.
		),

		// Elementor
		array(
			'name'							=> 'Elementor',
			'slug'							=> 'elementor',
			'required'					=> false,
			'force_activation'	=> false,
		),
		// Elementor Pro
		array(
			'name'               => 'Elementor Pro', // The plugin name.
			'slug'               => 'elementor-pro', // The plugin slug (typically the folder name).
			'source'             => get_stylesheet_directory() . '/lib/elementor-pro.zip', // The plugin source.
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '3.3.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => 'https://elementor.com/', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'tgmpa',                  // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                       // Default absolute path to bundled plugins.
		'menu'         => 'mtf-plugins',						// Menu slug.
		'parent_slug'  => 'plugins.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',     // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                     // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                       // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                     // Automatically activate plugins after installation or not.
		'message'      => '',                       // Message to output right before the plugins table.
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'mtfmusicals' ),
			'menu_title'                      => __( 'Required Plugins', 'mtfmusicals' ),
			'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		)
	);

	tgmpa( $plugins, $config );

}

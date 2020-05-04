<?php
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function mtf_theme_support() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Custom background color.
	add_theme_support(
		'custom-background',
		array(
			'default-color' => 'f5efe0',
		)
	);

	// Set content-width.
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 580;
	}

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// Set post thumbnail size.
	set_post_thumbnail_size( 1200, 9999 );

	// Add custom image size used in Cover Template.
	add_image_size( 'mtf-fullscreen', 1980, 9999 );

	// Custom logo.
	$logo_width  = 120;
	$logo_height = 90;

	// If the retina setting is active, double the recommended width and height.
	if ( get_theme_mod( 'retina_logo', false ) ) {
		$logo_width  = floor( $logo_width * 2 );
		$logo_height = floor( $logo_height * 2 );
	}

	add_theme_support(
		'custom-logo',
		array(
			'height'      => $logo_height,
			'width'       => $logo_width,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		)
	);

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on MTF, use a find and replace
	 * to change 'mtf' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'mtf' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * Adds `async` and `defer` support for scripts registered or enqueued
	 * by the theme.
	 */
	$loader = new MTF_Script_Loader();
	add_filter( 'script_loader_tag', array( $loader, 'filter_script_loader_tag' ), 10, 2 );

}

add_action( 'after_setup_theme', 'mtf_theme_support' );

/**
 * REQUIRED FILES
 * Include required files.
 */
require get_template_directory() . '/inc/template-tags.php';

// Handle SVG icons.
require get_template_directory() . '/classes/class-theme-svg-icons.php';
require get_template_directory() . '/inc/svg-icons.php';

// Handle Customizer settings.
require get_template_directory() . '/classes/class-theme-customize.php';

// Require Separator Control class.
require get_template_directory() . '/classes/class-theme-separator-control.php';

// Custom comment walker.
require get_template_directory() . '/classes/class-theme-walker-comment.php';

// Custom page walker.
require get_template_directory() . '/classes/class-theme-walker-page.php';

// Custom script loader class.
require get_template_directory() . '/classes/class-theme-script-loader.php';

// Non-latin language handling.
require get_template_directory() . '/classes/class-theme-non-latin-languages.php';

// Custom CSS.
require get_template_directory() . '/inc/custom-css.php';

// Custom Admin.
require get_template_directory() . '/admin/index.php';

/**
 * Register and Enqueue Styles.
 */
function mtf_register_styles() {

	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'mtf-style', get_template_directory_uri() . '/static/css/style.css', array(), $theme_version );
	wp_style_add_data( 'mtf-style', 'rtl', 'replace' );

	// Add output of Customizer settings as inline style.
	wp_add_inline_style( 'mtf-style', mtf_get_customizer_css( 'front-end' ) );

	// Add print CSS.
	wp_enqueue_style( 'mtf-print-style', get_template_directory_uri() . '/static/css/print.css', null, $theme_version, 'print' );

}
add_action( 'wp_enqueue_scripts', 'mtf_register_styles' );

/**
 * Register and Enqueue Scripts.
 */
function mtf_register_scripts() {

	$theme_version = wp_get_theme()->get( 'Version' );

	if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'mtf-js', get_template_directory_uri() . '/static/js/vendors.js', array(), $theme_version, false );
}
add_action( 'wp_enqueue_scripts', 'mtf_register_scripts' );

function mtf_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'mtf_skip_link_focus_fix' );

function mtf_non_latin_languages() {
	$custom_css = MTF_Non_Latin_Languages::get_non_latin_css( 'front-end' );

	if ( $custom_css ) {
		wp_add_inline_style( 'mtf-style', $custom_css );
	}
}
add_action( 'wp_enqueue_scripts', 'mtf_non_latin_languages' );

function remove_dashboard_widgets(){
	remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_site_health', 'dashboard', 'normal' );
}
add_action( 'wp_dashboard_setup', 'remove_dashboard_widgets');

function mtf_menus() {

	$locations = array(
		'primary'  => __( 'Desktop Horizontal Menu', 'mtf' ),
		'expanded' => __( 'Desktop Expanded Menu', 'mtf' ),
		'mobile'   => __( 'Mobile Menu', 'mtf' ),
		'footer'   => __( 'Footer Menu', 'mtf' ),
		'social'   => __( 'Social Menu', 'mtf' ),
	);

	register_nav_menus( $locations );
}
add_action( 'init', 'mtf_menus' );

function mtf_get_custom_logo( $html ) {

	$logo_id = get_theme_mod( 'custom_logo' );

	if ( ! $logo_id ) {
		return $html;
	}

	$logo = wp_get_attachment_image_src( $logo_id, 'full' );

	if ( $logo ) {
		// For clarity.
		$logo_width  = esc_attr( $logo[1] );
		$logo_height = esc_attr( $logo[2] );

		// If the retina logo setting is active, reduce the width/height by half.
		if ( get_theme_mod( 'retina_logo', false ) ) {
			$logo_width  = floor( $logo_width / 2 );
			$logo_height = floor( $logo_height / 2 );

			$search = array(
				'/width=\"\d+\"/iU',
				'/height=\"\d+\"/iU',
			);

			$replace = array(
				"width=\"{$logo_width}\"",
				"height=\"{$logo_height}\"",
			);

			// Add a style attribute with the height, or append the height to the style attribute if the style attribute already exists.
			if ( strpos( $html, ' style=' ) === false ) {
				$search[]  = '/(src=)/';
				$replace[] = "style=\"height: {$logo_height}px;\" src=";
			} else {
				$search[]  = '/(style="[^"]*)/';
				$replace[] = "$1 height: {$logo_height}px;";
			}

			$html = preg_replace( $search, $replace, $html );

		}
	}

	return $html;

}
add_filter( 'get_custom_logo', 'mtf_get_custom_logo' );

if ( ! function_exists( 'wp_body_open' ) ) {

	/**
	 * Shim for wp_body_open, ensuring backward compatibility with versions of WordPress older than 5.2.
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

function mtf_skip_link() {
	echo '<a class="skip-link screen-reader-text" href="#site-content">' . __( 'Skip to the content', 'mtf' ) . '</a>';
}
add_action( 'wp_body_open', 'mtf_skip_link', 5 );

function mtf_sidebar_registration() {

	// Arguments used in all register_sidebar() calls.
	$shared_args = array(
		'before_title'  => '<h2 class="widget-title subheading heading-size-3">',
		'after_title'   => '</h2>',
		'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></div>',
	);

	// Footer #1.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer #1', 'mtf' ),
				'id'          => 'sidebar-1',
				'description' => __( 'Widgets in this area will be displayed in the first column in the footer.', 'mtf' ),
			)
		)
	);

	// Footer #2.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer #2', 'mtf' ),
				'id'          => 'sidebar-2',
				'description' => __( 'Widgets in this area will be displayed in the second column in the footer.', 'mtf' ),
			)
		)
	);

}
add_action( 'widgets_init', 'mtf_sidebar_registration' );

function mtf_block_editor_styles() {

	$css_dependencies = array();

	// Enqueue the editor styles.
	wp_enqueue_style( 'mtf-block-editor-styles', get_theme_file_uri( '/static/css/editor-style-block.css' ), $css_dependencies, wp_get_theme()->get( 'Version' ), 'all' );
	wp_style_add_data( 'mtf-block-editor-styles', 'rtl', 'replace' );

	// Add inline style from the Customizer.
	wp_add_inline_style( 'mtf-block-editor-styles', mtf_get_customizer_css( 'block-editor' ) );

	// Add inline style for non-latin fonts.
	wp_add_inline_style( 'mtf-block-editor-styles', MTF_Non_Latin_Languages::get_non_latin_css( 'block-editor' ) );

	// Enqueue the editor script.
	wp_enqueue_script( 'mtf-block-editor-script', get_theme_file_uri( '/static/js/wordpress.js' ), array( 'wp-blocks', 'wp-dom' ), wp_get_theme()->get( 'Version' ), true );
}
add_action( 'enqueue_block_editor_assets', 'mtf_block_editor_styles', 1, 1 );

function mtf_classic_editor_styles() {

	$classic_editor_styles = array(
		'/static/css/editor-style-classic.css',
	);

	add_editor_style( $classic_editor_styles );

}
add_action( 'init', 'mtf_classic_editor_styles' );

function mtf_add_classic_editor_customizer_styles( $mce_init ) {

	$styles = mtf_get_customizer_css( 'classic-editor' );

	if ( ! isset( $mce_init['content_style'] ) ) {
		$mce_init['content_style'] = $styles . ' ';
	} else {
		$mce_init['content_style'] .= ' ' . $styles . ' ';
	}

	return $mce_init;

}
add_filter( 'tiny_mce_before_init', 'mtf_add_classic_editor_customizer_styles' );

function mtf_add_classic_editor_non_latin_styles( $mce_init ) {

	$styles = MTF_Non_Latin_Languages::get_non_latin_css( 'classic-editor' );

	// Return if there are no styles to add.
	if ( ! $styles ) {
		return $mce_init;
	}

	if ( ! isset( $mce_init['content_style'] ) ) {
		$mce_init['content_style'] = $styles . ' ';
	} else {
		$mce_init['content_style'] .= ' ' . $styles . ' ';
	}

	return $mce_init;

}
add_filter( 'tiny_mce_before_init', 'mtf_add_classic_editor_non_latin_styles' );

function mtf_block_editor_settings() {

	// Block Editor Palette.
	$editor_color_palette = array(
		array(
			'name'  => __( 'Accent Color', 'mtf' ),
			'slug'  => 'accent',
			'color' => mtf_get_color_for_area( 'content', 'accent' ),
		),
		array(
			'name'  => __( 'Primary', 'mtf' ),
			'slug'  => 'primary',
			'color' => mtf_get_color_for_area( 'content', 'text' ),
		),
		array(
			'name'  => __( 'Secondary', 'mtf' ),
			'slug'  => 'secondary',
			'color' => mtf_get_color_for_area( 'content', 'secondary' ),
		),
		array(
			'name'  => __( 'Subtle Background', 'mtf' ),
			'slug'  => 'subtle-background',
			'color' => mtf_get_color_for_area( 'content', 'borders' ),
		),
	);

	// Add the background option.
	$background_color = get_theme_mod( 'background_color' );
	if ( ! $background_color ) {
		$background_color_arr = get_theme_support( 'custom-background' );
		$background_color     = $background_color_arr[0]['default-color'];
	}
	$editor_color_palette[] = array(
		'name'  => __( 'Background Color', 'mtf' ),
		'slug'  => 'background',
		'color' => '#' . $background_color,
	);

	// If we have accent colors, add them to the block editor palette.
	if ( $editor_color_palette ) {
		add_theme_support( 'editor-color-palette', $editor_color_palette );
	}

	// Block Editor Font Sizes.
	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name'      => _x( 'Small', 'Name of the small font size in the block editor', 'mtf' ),
				'shortName' => _x( 'S', 'Short name of the small font size in the block editor.', 'mtf' ),
				'size'      => 18,
				'slug'      => 'small',
			),
			array(
				'name'      => _x( 'Regular', 'Name of the regular font size in the block editor', 'mtf' ),
				'shortName' => _x( 'M', 'Short name of the regular font size in the block editor.', 'mtf' ),
				'size'      => 21,
				'slug'      => 'normal',
			),
			array(
				'name'      => _x( 'Large', 'Name of the large font size in the block editor', 'mtf' ),
				'shortName' => _x( 'L', 'Short name of the large font size in the block editor.', 'mtf' ),
				'size'      => 26.25,
				'slug'      => 'large',
			),
			array(
				'name'      => _x( 'Larger', 'Name of the larger font size in the block editor', 'mtf' ),
				'shortName' => _x( 'XL', 'Short name of the larger font size in the block editor.', 'mtf' ),
				'size'      => 32,
				'slug'      => 'larger',
			),
		)
	);

	// If we have a dark background color then add support for dark editor style.
	// We can determine if the background color is dark by checking if the text-color is white.
	if ( '#ffffff' === strtolower( mtf_get_color_for_area( 'content', 'text' ) ) ) {
		add_theme_support( 'dark-editor-style' );
	}

}
add_action( 'after_setup_theme', 'mtf_block_editor_settings' );

function mtf_read_more_tag( $html ) {
	return preg_replace( '/<a(.*)>(.*)<\/a>/iU', sprintf( '<div class="read-more-button-wrap"><a$1><span class="faux-button">$2</span> <span class="screen-reader-text">"%1$s"</span></a></div>', get_the_title( get_the_ID() ) ), $html );
}
add_filter( 'the_content_more_link', 'mtf_read_more_tag' );

function mtf_customize_controls_enqueue_scripts() {
	$theme_version = wp_get_theme()->get( 'Version' );

	// Add script for controls.
	wp_enqueue_script( 'mtf-customize-controls', get_template_directory_uri() . '/static/js/wordpress.js', array( 'customize-controls', 'underscore', 'jquery' ), $theme_version, false );
	wp_localize_script( 'mtf-customize-controls', 'mtfBgColors', mtf_get_customizer_color_vars() );
}
add_action( 'customize_controls_enqueue_scripts', 'mtf_customize_controls_enqueue_scripts' );

function mtf_customize_preview_init() {
	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_script( 'mtf-customize-preview', get_theme_file_uri( '/static/js/wordpress.js' ), array( 'customize-preview', 'customize-selective-refresh', 'jquery' ), $theme_version, true );
	wp_localize_script( 'mtf-customize-preview', 'mtfBgColors', mtf_get_customizer_color_vars() );
	wp_localize_script( 'mtf-customize-preview', 'mtfPreviewEls', mtf_get_elements_array() );

	wp_add_inline_script(
		'mtf-customize-preview',
		sprintf(
			'wp.customize.selectiveRefresh.partialConstructor[ %1$s ].prototype.attrs = %2$s;',
			wp_json_encode( 'cover_opacity' ),
			wp_json_encode( mtf_customize_opacity_range() )
		)
	);
}
add_action( 'customize_preview_init', 'mtf_customize_preview_init' );

function mtf_get_color_for_area( $area = 'content', $context = 'text' ) {

	// Get the value from the theme-mod.
	$settings = get_theme_mod(
		'accent_accessible_colors',
		array(
			'content'       => array(
				'text'      => '#000000',
				'accent'    => '#f2af2d',
				'secondary' => '#cf4a93',
				'borders'   => '#00a3cf',
			),
			'header-footer' => array(
				'text'      => '#000000',
				'accent'    => '#f2af2d',
				'secondary' => '#cf4a93',
				'borders'   => '#00a3cf',
			),
		)
	);

	// If we have a value return it.
	if ( isset( $settings[ $area ] ) && isset( $settings[ $area ][ $context ] ) ) {
		return $settings[ $area ][ $context ];
	}

	// Return false if the option doesn't exist.
	return false;
}

function mtf_get_customizer_color_vars() {
	$colors = array(
		'content'       => array(
			'setting' => 'background_color',
		),
		'header-footer' => array(
			'setting' => 'header_footer_background_color',
		),
	);
	return $colors;
}

function mtf_get_elements_array() {

	// The array is formatted like this:
	// [key-in-saved-setting][sub-key-in-setting][css-property] = [elements].
	$elements = array(
		'content'       => array(
			'accent'     => array(
				'color'            => array( '.color-accent', '.color-accent-hover:hover', '.color-accent-hover:focus', ':root .has-accent-color', '.has-drop-cap:not(:focus):first-letter', '.wp-block-button.is-style-outline', 'a' ),
				'border-color'     => array( 'blockquote', '.border-color-accent', '.border-color-accent-hover:hover', '.border-color-accent-hover:focus' ),
				'background-color' => array( 'button:not(.toggle)', '.button', '.faux-button', '.wp-block-button__link', '.wp-block-file .wp-block-file__button', 'input[type="button"]', 'input[type="reset"]', 'input[type="submit"]', '.bg-accent', '.bg-accent-hover:hover', '.bg-accent-hover:focus', ':root .has-accent-background-color', '.comment-reply-link' ),
				'fill'             => array( '.fill-children-accent', '.fill-children-accent *' ),
			),
			'background' => array(
				'color'            => array( ':root .has-background-color', 'button', '.button', '.faux-button', '.wp-block-button__link', '.wp-block-file__button', 'input[type="button"]', 'input[type="reset"]', 'input[type="submit"]', '.wp-block-button', '.comment-reply-link', '.has-background.has-primary-background-color:not(.has-text-color)', '.has-background.has-primary-background-color *:not(.has-text-color)', '.has-background.has-accent-background-color:not(.has-text-color)', '.has-background.has-accent-background-color *:not(.has-text-color)' ),
				'background-color' => array( ':root .has-background-background-color' ),
			),
			'text'       => array(
				'color'            => array( 'body', '.entry-title a', ':root .has-primary-color' ),
				'background-color' => array( ':root .has-primary-background-color' ),
			),
			'secondary'  => array(
				'color'            => array( 'cite', 'figcaption', '.wp-caption-text', '.post-meta', '.entry-content .wp-block-archives li', '.entry-content .wp-block-categories li', '.entry-content .wp-block-latest-posts li', '.wp-block-latest-comments__comment-date', '.wp-block-latest-posts__post-date', '.wp-block-embed figcaption', '.wp-block-image figcaption', '.wp-block-pullquote cite', '.comment-metadata', '.comment-respond .comment-notes', '.comment-respond .logged-in-as', '.pagination .dots', '.entry-content hr:not(.has-background)', 'hr.styled-separator', ':root .has-secondary-color' ),
				'background-color' => array( ':root .has-secondary-background-color' ),
			),
			'borders'    => array(
				'border-color'        => array( 'pre', 'fieldset', 'input', 'textarea', 'table', 'table *', 'hr' ),
				'background-color'    => array( 'caption', 'code', 'code', 'kbd', 'samp', '.wp-block-table.is-style-stripes tbody tr:nth-child(odd)', ':root .has-subtle-background-background-color' ),
				'border-bottom-color' => array( '.wp-block-table.is-style-stripes' ),
				'border-top-color'    => array( '.wp-block-latest-posts.is-grid li' ),
				'color'               => array( ':root .has-subtle-background-color' ),
			),
		),
		'header-footer' => array(
			'accent'     => array(
				'color'            => array( 'body:not(.overlay-header) .primary-menu > li > a', 'body:not(.overlay-header) .primary-menu > li > .icon', '.modal-menu a', '.footer-menu a, .footer-widgets a', '#site-footer .wp-block-button.is-style-outline', '.wp-block-pullquote:before', '.singular:not(.overlay-header) .entry-header a', '.archive-header a', '.header-footer-group .color-accent', '.header-footer-group .color-accent-hover:hover' ),
				'background-color' => array( '.social-icons a', '#site-footer button:not(.toggle)', '#site-footer .button', '#site-footer .faux-button', '#site-footer .wp-block-button__link', '#site-footer .wp-block-file__button', '#site-footer input[type="button"]', '#site-footer input[type="reset"]', '#site-footer input[type="submit"]' ),
			),
			'background' => array(
				'color'            => array( '.social-icons a', 'body:not(.overlay-header) .primary-menu ul', '.header-footer-group button', '.header-footer-group .button', '.header-footer-group .faux-button', '.header-footer-group .wp-block-button:not(.is-style-outline) .wp-block-button__link', '.header-footer-group .wp-block-file__button', '.header-footer-group input[type="button"]', '.header-footer-group input[type="reset"]', '.header-footer-group input[type="submit"]' ),
				'background-color' => array( '#site-header', '.footer-nav-widgets-wrapper', '#site-footer', '.menu-modal', '.menu-modal-inner', '.search-modal-inner', '.archive-header', '.singular .entry-header', '.singular .featured-media:before', '.wp-block-pullquote:before' ),
			),
			'text'       => array(
				'color'               => array( '.header-footer-group', 'body:not(.overlay-header) #site-header .toggle', '.menu-modal .toggle' ),
				'background-color'    => array( 'body:not(.overlay-header) .primary-menu ul' ),
				'border-bottom-color' => array( 'body:not(.overlay-header) .primary-menu > li > ul:after' ),
				'border-left-color'   => array( 'body:not(.overlay-header) .primary-menu ul ul:after' ),
			),
			'secondary'  => array(
				'color' => array( '.site-description', 'body:not(.overlay-header) .toggle-inner .toggle-text', '.widget .post-date', '.widget .rss-date', '.widget_archive li', '.widget_categories li', '.widget cite', '.widget_pages li', '.widget_meta li', '.widget_nav_menu li', '.powered-by-wordpress', '.to-the-top', '.singular .entry-header .post-meta', '.singular:not(.overlay-header) .entry-header .post-meta a' ),
			),
			'borders'    => array(
				'border-color'     => array( '.header-footer-group pre', '.header-footer-group fieldset', '.header-footer-group input', '.header-footer-group textarea', '.header-footer-group table', '.header-footer-group table *', '.footer-nav-widgets-wrapper', '#site-footer', '.menu-modal nav *', '.footer-widgets-outer-wrapper', '.footer-top' ),
				'background-color' => array( '.header-footer-group table caption', 'body:not(.overlay-header) .header-inner .toggle-wrapper::before' ),
			),
		),
	);

	/**
	* Filters MTF theme elements
	*
	* @since MissionCommand 6.0.0
	*
	* @param array Array of elements
	*/
	return apply_filters( 'mtf_get_elements_array', $elements );
}

require_once dirname( __FILE__ ) . '/classes/class-tgm-plugin-activation.php';
function mtf_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin bundled with a theme.
		array(
			'name'               => 'Mission Command', // The plugin name.
			'slug'               => 'mission-command', // The plugin slug (typically the folder name).
			'source'             => dirname( __FILE__ ) . '/lib/plugins/mission-command.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => 'https://github.com/jrfnl/WP-adminbar-comments-to-pending/archive/master.zip', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),

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

function theme_prefix_register_elementor_locations( $elementor_theme_manager ) {

	$elementor_theme_manager->register_all_core_location();

}
add_action( 'elementor/theme/register_locations', 'theme_prefix_register_elementor_locations' );
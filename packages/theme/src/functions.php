<?php
function mtf_theme_support() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Custom background color.
	add_theme_support(
		'custom-background',
		array(
			'default-preset'			=>	'fill',
			'default-repeat'			=>	'no-repeat',
			'default-attachment'	=>	'scroll',
			'default-color' 			=> 	'f5efe0',
			'wp-head-callback'		=>	function () {
				// $background is the saved custom image, or the default image.
				$background = set_url_scheme( get_background_image() );
				$color = get_background_color();
		
				if ( get_theme_support( 'custom-background', 'default-color' ) === $color ) {
						$color = false;
				}
		
				$type_attr = current_theme_supports( 'html5', 'style' ) ? '' : ' type="text/css"';
		
				if ( ! $background && ! $color ) {
						if ( is_customize_preview() ) {
								printf( '<style%s id="custom-background-css"></style>', $type_attr );
						}
						return;
				}
		
				$style = $color ? "background-color: #$color;" : '';
		
				if ( $background ) {
						$image = ' background-image: url("' . esc_url_raw( $background ) . '");';
		
						// Background Position.
						$position_x = get_theme_mod( 'background_position_x', get_theme_support( 'custom-background', 'default-position-x' ) );
						$position_y = get_theme_mod( 'background_position_y', get_theme_support( 'custom-background', 'default-position-y' ) );
		
						if ( ! in_array( $position_x, array( 'left', 'center', 'right' ), true ) ) {
								$position_x = 'left';
						}
		
						if ( ! in_array( $position_y, array( 'top', 'center', 'bottom' ), true ) ) {
								$position_y = 'top';
						}
		
						$position = " background-position: $position_x $position_y;";
		
						// Background Size.
						$size = get_theme_mod( 'background_size', get_theme_support( 'custom-background', 'default-size' ) );
		
						if ( ! in_array( $size, array( 'auto', 'contain', 'cover' ), true ) ) {
								$size = 'auto';
						}
		
						$size = " background-size: $size;";
		
						// Background Repeat.
						$repeat = get_theme_mod( 'background_repeat', get_theme_support( 'custom-background', 'default-repeat' ) );
		
						if ( ! in_array( $repeat, array( 'repeat-x', 'repeat-y', 'repeat', 'no-repeat' ), true ) ) {
								$repeat = 'repeat';
						}
		
						$repeat = " background-repeat: $repeat;";
		
						// Background Scroll.
						$attachment = get_theme_mod( 'background_attachment', get_theme_support( 'custom-background', 'default-attachment' ) );
		
						if ( 'fixed' !== $attachment ) {
								$attachment = 'scroll';
						}
		
						$attachment = " background-attachment: $attachment;";
		
						$style .= $image . $position . $size . $repeat . $attachment;
				}
				?>
<style<?php echo $type_attr; ?> id="custom-background-css">
.custom-background:not(body) { <?php echo trim( $style ); ?> }
</style>
				<?php				
			}
		)
	);

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// Set post thumbnail size.
	set_post_thumbnail_size( 1200, 9999 );

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
	 */
	load_theme_textdomain( 'mtf' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add custom image size used in Cover Template.
	add_image_size( 'mtf-fullscreen', 1980, 9999 );

	/*
	 * Adds `async` and `defer` support for scripts registered or enqueued
	 * by the theme.
	 */
	$loader = new WordPress_Script_Loader();
	add_filter( 'script_loader_tag', array( $loader, 'filter_script_loader_tag' ), 10, 2 );

}
add_action( 'after_setup_theme', 'mtf_theme_support' );

/**
 * REQUIRED FILES
 * Include required files.
 */
// Handle SVG icons.
		require get_template_directory() . '/classes/class-svg-icons.php';
		require get_template_directory() . '/inc/svg-icons.php';

		// Custom script loader class.
		require get_template_directory() . '/classes/class-script-loader.php';

		// Custom Admin.
		require get_template_directory() . '/admin/index.php';

		// Required plugins.
		require get_template_directory() . '/inc/tgmpa-plugins.php';

function mtf_menus() {
	register_nav_menus(
		array(
			'header-menu' => __( 'Header Menu' ),
			'footer-menu' => __( 'Footer Menu' )
		)
	);
}
add_action( 'init', 'mtf_menus' );

function mtf_register_styles() {

	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'mtf-style', get_template_directory_uri() . '/assets/css/style.css', array(), $theme_version );
	wp_style_add_data( 'mtf-style', 'rtl', 'replace' );

	// Add print CSS.
	wp_enqueue_style( 'mtf-print-style', get_template_directory_uri() . '/assets/css/print.css', null, $theme_version, 'print' );

}
add_action( 'wp_enqueue_scripts', 'mtf_register_styles' );

function mtf_register_scripts() {

	$theme_version = wp_get_theme()->get( 'Version' );

	if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'mtf-js', get_template_directory_uri() . '/assets/js/vendors.js', array(), $theme_version, false );
	wp_script_add_data( 'rkmanglani-js', 'async', true );
}
add_action( 'wp_enqueue_scripts', 'mtf_register_scripts' );

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

function mtf_skip_link() {
	echo '<a class="skip-link screen-reader-text" href="#site-content">' . __( 'Skip to the content', 'mtf' ) . '</a>';
}
add_action( 'wp_body_open', 'mtf_skip_link', 5 );

function mtf_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'mtf_skip_link_focus_fix' );

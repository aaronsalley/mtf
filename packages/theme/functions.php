<?php 
/**
 * Theme Name:        Musical Theatre Factory
 * Theme URI:         https://mtf.nyc/
 * Author:            Disruptv LLC
 * Author URI:        https://disruptv.llc/
 * Description:       Our default theme for 2020 is designed to take full advantage of the flexibility of the block editor. Organizations and businesses have the ability to create dynamic landing pages with endless layouts using the group and column blocks. The centered content column and fine-tuned typography also makes it perfect for traditional blogs. Complete editor styles give you a good idea of what your content will look like, even before you publish. You can give your site a personal touch by changing the background colors and the accent color in the Customizer. The colors of all elements on your site are automatically calculated based on the colors you pick, ensuring a high, accessible color contrast for your visitors.
 * Tags:              blog, one-column, custom-background, custom-colors, custom-logo, custom-menu, editor-style, featured-images, footer-widgets, full-width-template, rtl-language-support, sticky-post, theme-options, threaded-comments, translation-ready, block-styles, wide-blocks, accessibility-ready
 * Version:           7.1
 * Requires at least: 5.0
 * Tested up to:      5.4
 * Requires PHP:      7.0
 * License:           GNU General Public License v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       mtfmusicals
 * This theme, like WordPress, is licensed under the GPL.
 * Use it to make something cool, have fun, and share what you've learned with others.
 */

if ( ! isset ( $content_width) )
  $content_width = 800;

if ( ! function_exists( 'mtfmusicals_setup' ) ) :
  /**
  * Sets up theme defaults and registers support for various WordPress features
  *
  *  It is important to set up these functions before the init hook so that none of these
  *  features are lost.
  *
  *  @since Musical Theatre Factory 1.0
  */
  function mtfmusicals_setup() {
    load_theme_textdomain( 'mtfmusicals', get_template_directory() . '/i18n' );

    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'menus' );
    add_theme_support( 'custom-logo' );
    
    add_theme_support( 'post-formats',  array ( 'aside', 'gallery', 'quote', 'image', 'video' ) );
    add_post_type_support( 'page', 'excerpt' );
    
    register_nav_menus( array ( 'mega' => 'Site Menu', 'nav' => 'Main Navigation' ) );
}
endif;
add_action( 'after_setup_theme', 'mtfmusicals_setup' );

function add_theme_scripts() {
  wp_enqueue_style( 'style', get_stylesheet_uri() ); 

  if ( wp_get_environment_type() === 'development' ) {
    
  }
}
add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

// include 'inc/cors.php';
include 'inc/elementor.php';
include 'inc/events/events.php';
include 'inc/media/media.php';
include 'inc/required-plugins.php';
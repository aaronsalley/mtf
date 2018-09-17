<?php
function return_false() {
  return false;
}

function hex2rgb($hex, $a = 1) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgba = array($r, $g, $b, $a);
   return implode(",", $rgba); // returns the rgb values separated by commas
   //return $rgb; // returns an array with the rgb values
}

function mtf_archive_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    }

    return $title;
}
add_filter( 'get_the_archive_title', 'mtf_archive_title' );

function mtf_excerpt_more( $link ) {
  if ( is_admin() ) {
    return $link;
  }

  $format = get_post_format( get_the_ID() );
  $text = '';

  $permalink = get_permalink( get_the_ID() );

  switch ($format) {
    case "aside":
      $text = "";
      break;
    case "chat":
      $text = "";
      break;
    case "gallery":
      $text = "View Gallery";
      break;
    case "link":
      $text = "Follow Link";
      $permalink = get_post_meta( get_the_ID(), "URL", true );
      break;
    case "image":
      $text = "See Image";
      break;
    case "quote":
      $text = "";
      break;
    case "status":
      $text = "";
      break;
    case "video":
      $text = "Watch Video";
      break;
    case "audio":
      $text = "Listen";
      break;
    default:
      $text = "Continue Reading";
      break;
  }

    return sprintf( '<p class="read-more"><a href="%1$s">%2$s</a></p>',
        $permalink,
        __( $text . '→', 'mtf' )
    );

}
add_filter( 'excerpt_more', 'mtf_excerpt_more' );

function mtf_events_category() {
    $tribe_events_cat = get_taxonomy( 'tribe_events_cat' );
  $singular = 'program';
  $plural = 'programs';
    $tribe_events_cat->rewrite['slug'] = $plural;

    register_taxonomy( 'tribe_events_cat', 'tribe_events', (array) $tribe_events_cat );
}
add_action( 'init', 'mtf_events_category', 11 );

function mtf_podcast_feed_rss2( $for_comments ) {
    $rss_template = get_template_directory() . '/etc/feed-podcast-rss2.php';
    if( get_query_var( 'post_type' ) == 'podcast' and file_exists( $rss_template ) )
        load_template( $rss_template );
    else
        do_feed_rss2( $for_comments ); // Call default function
}
remove_all_actions( 'do_feed_rss2' );
add_action( 'do_feed_rss2', 'mtf_podcast_feed_rss2', 10, 1 );

function mtf_feeds() {
  $post_types = array('podcast');
  foreach( $post_types as $post_type ) {
      $feed = get_post_type_archive_feed_link( $post_type );
      if ( $feed === '' || !is_string( $feed ) ) {
          $feed =  get_bloginfo( 'rss2_url' ) . "?post_type=$post_type";
      }
      printf(__('<link rel="%1$s" type="%2$s" title="%3$s" href="%4$s" />'), "alternate", "application/rss+xml", get_bloginfo()." &#8211; Podcasts", $feed);
  }
}
add_action( 'wp_head', 'mtf_feeds', 1 );

add_action( 'wp_enqueue_scripts', 'mtf_clean_up', 99 );
function mtf_clean_up() {
  //remove generator meta tag
  remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
  remove_action( 'wp_head', 'wp_resource_hints', 2 );

  // All actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // Filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );

  // Remove generator tags
  remove_action('wp_head', 'wp_generator');

  //first check that woo exists to prevent fatal errors
  if ( function_exists( 'is_woocommerce' ) ) {
    //dequeue scripts and styles
    if ( ! is_woocommerce() ) {
      wp_dequeue_style( 'woocommerce-general' );
      wp_dequeue_style( 'woocommerce-smallscreen' );
      wp_dequeue_style( 'woocommerce-layout' );
      wp_dequeue_style( 'woocommerce_frontend_styles' );
      wp_dequeue_style( 'woocommerce_fancybox_styles' );
      wp_dequeue_style( 'woocommerce_chosen_styles' );
      wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
      wp_dequeue_script( 'wc_price_slider' );
      wp_dequeue_script( 'wc-single-product' );
      wp_dequeue_script( 'wc-add-to-cart' );
      wp_dequeue_script( 'wc-cart-fragments' );
      wp_dequeue_script( 'wc-checkout' );
      wp_dequeue_script( 'wc-add-to-cart-variation' );
      wp_dequeue_script( 'wc-single-product' );
      wp_dequeue_script( 'wc-cart' );
      wp_dequeue_script( 'wc-chosen' );
      wp_dequeue_script( 'woocommerce' );
      wp_dequeue_script( 'prettyPhoto' );
      wp_dequeue_script( 'prettyPhoto-init' );
      wp_dequeue_script( 'jquery-blockui' );
      wp_dequeue_script( 'jquery-placeholder' );
      wp_dequeue_script( 'fancybox' );
      wp_dequeue_script( 'jqueryui' );
    }
  }
}

add_action( 'wp_head', 'mtf_javascript_detection', 0 );
function mtf_javascript_detection() {
  echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}

add_action('wp_print_scripts', 'enqueueScriptsFix', 100);
function enqueueScriptsFix() {
    if (!is_admin()) {
        if (!empty($_SERVER['HTTPS'])) {
            global $wp_scripts;
            foreach ((array) $wp_scripts->registered as $script) {
                if (stripos($script->src, 'http://', 0) !== FALSE)
                    $script->src = str_replace('http://', 'https://', $script->src);
            }
        }
    }
}

add_action('wp_print_styles', 'enqueueStylesFix', 100);
function enqueueStylesFix() {
  if (!is_admin()) {
      if (!empty($_SERVER['HTTPS'])) {
          global $wp_styles;
          foreach ((array) $wp_styles->registered as $script) {
              if (stripos($script->src, 'http://', 0) !== FALSE)
                  $script->src = str_replace('http://', 'https://', $script->src);
          }
      }
  }
  if (function_exists('linkssc_css')) {
      remove_action('wp_head', 'linkssc_css');
      $url = plugins_url('links-shortcode.css', WP_PLUGIN_DIR . '/links-shortcode/');
      wp_enqueue_style('links-shortcode', $url);
  }
}

/**
 * Return the details of the start/end date/time.
 *
 * The highest level means of customizing this function's output is simply to adjust the date format settings under
 * Events > Settings > Display, and WordPress time formats (via the General Settings admin screen).
 * Beyond that, however, there are two filters which can be used to exercise further control here.
 *
 * The first is 'tribe_events_event_schedule_details_formatting' which allows an array of format settings to be
 * altered - it's basic make-up is as a simple set of key:value pairs as follows.
 *
 * "show_end_time": for single day events only (not including all day events) it may not always be desirable to
 *     include the end time. In that situation, this setting can be set to false and the end time will not be
 *     displayed.
 *
 * "time": if it is undesirable to show times and only dates should be displayed then this setting can be set to
 *     false. If it is false it will by extension cause 'show_end_time' to be false.
 *
 * The resulting string can also be caught and manipulated, or completely overridden, using the
 * 'tribe_events_event_schedule_details' filter, should none of the above settings be sufficient.
 *
 * @category Events
 * @TODO use tribe_get_datetime_format() and related functions if possible
 *
 * @param int|null $event
 * @param string $before
 * @param string $after
 *
 * @return mixed|void
 */
function tribe_events_get_event_schedule_details( $event = null, $before = '', $after = '', $link = true ) {
  if ( is_null( $event ) ) {
    global $post;
    $event = $post;
  }
  if ( is_numeric( $event ) ) {
    $event = get_post( $event );
  }
  $inner                    = '<span class="date-start">';
  $format                   = '';
  $date_without_year_format = tribe_get_date_format();
  $date_with_year_format    = tribe_get_date_format( true );
  $time_format              = get_option( 'time_format' );
  $datetime_separator       = tribe_get_option( 'dateTimeSeparator', ' @ ' );
  $time_range_separator     = tribe_get_option( 'timeRangeSeparator', ' - ' );
  $settings = array(
    'show_end_time' => true,
    'time'          => true,
  );
  $settings = wp_parse_args( apply_filters( 'tribe_events_event_schedule_details_formatting', $settings ), $settings );
  if ( ! $settings['time'] ) {
    $settings['show_end_time'] = false;
  }
  /**
   * @var $show_end_time
   * @var $time
   */
  extract( $settings );
  $format = $date_with_year_format;
  /**
   * If a yearless date format should be preferred.
   *
   * By default, this will be true if the event starts and ends in the current year.
   *
   * @param bool    $use_yearless_format
   * @param WP_Post $event
   */
  $use_yearless_format = apply_filters( 'tribe_events_event_schedule_details_use_yearless_format',
    (
      tribe_get_start_date( $event, false, 'Y' ) === date_i18n( 'Y' )
      && tribe_get_end_date( $event, false, 'Y' ) === date_i18n( 'Y' )
    ),
    $event
  );
  if ( $use_yearless_format ) {
    $format = $date_without_year_format;
  }
  if ( tribe_event_is_multiday( $event ) ) { // multi-date event
    $format2ndday = apply_filters( 'tribe_format_second_date_in_range', $format, $event );
    if ( tribe_event_is_all_day( $event ) ) {
      $inner .= tribe_get_start_date( $event, true, $format );
      $inner .= '</span>' . $time_range_separator;
      $inner .= '<span class="date-end">';
      $end_date_full = tribe_get_end_date( $event, true, Tribe__Date_Utils::DBDATETIMEFORMAT );
      $end_date_full_timestamp = strtotime( $end_date_full );
      // if the end date is <= the beginning of the day, consider it the previous day
      if ( $end_date_full_timestamp <= strtotime( tribe_beginning_of_day( $end_date_full ) ) ) {
        $end_date = tribe_format_date( $end_date_full_timestamp - DAY_IN_SECONDS, false, $format2ndday );
      } else {
        $end_date = tribe_get_end_date( $event, false, $format2ndday );
      }
      $inner .= $end_date;
    } else {
      $inner .= tribe_get_start_date( $event, false, $format ) . ( $time ? $datetime_separator . tribe_get_start_date( $event, false, $time_format ) : '' );
      $inner .= '</span>' . $time_range_separator;
      $inner .= '<span class="date-end">';
      $inner .= tribe_get_end_date( $event, false, $format2ndday ) . ( $time ? $datetime_separator . tribe_get_end_date( $event, false, $time_format ) : '' );
    }
  } elseif ( tribe_event_is_all_day( $event ) ) { // all day event
    $inner .= tribe_get_start_date( $event, true, $format );
  } else { // single day event
    if ( tribe_get_start_date( $event, false, 'g:i A' ) === tribe_get_end_date( $event, false, 'g:i A' ) ) { // Same start/end time
      $inner .= tribe_get_start_date( $event, false, $format ) . ( $time ? $datetime_separator . tribe_get_start_date( $event, false, $time_format ) : '' );
    } else { // defined start/end time
      $inner .= tribe_get_start_date( $event, false, $format ) . ( $time ? $datetime_separator . tribe_get_start_date( $event, false, $time_format ) : '' );
      $inner .= '</span>' . ( $show_end_time ? $time_range_separator : '' );
      $inner .= '<span class="time">';
      $inner .= ( $show_end_time ? tribe_get_end_date( $event, false, $time_format ) : '' );
    }
  }
  $inner .= '</span>';
  /**
   * Provides an opportunity to modify the *inner* schedule details HTML (ie before it is
   * wrapped).
   *
   * @param string $inner_html  the output HTML
   * @param int    $event_id    post ID of the event we are interested in
   */
  $inner = apply_filters( 'tribe_events_event_schedule_details_inner', $inner, $event->ID );
  // Wrap the schedule text
  $schedule = $before . $inner . $after;

  /**
   * Provides an opportunity to modify the schedule details HTML for a specific event after
   * it has been wrapped in the before and after markup.
   *
   * @param string $schedule  the output HTML
   * @param int    $event_id  post ID of the event we are interested in
   * @param string $before    part of the HTML wrapper that was prepended
   * @param string $after     part of the HTML wrapper that was appended
   */
  if( !$link ) {
   return $inner;
 } else {
    return apply_filters( 'tribe_events_event_schedule_details', $schedule, $event->ID, $before, $after );
  }
}

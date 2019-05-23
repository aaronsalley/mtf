<?php
/**
 * Block: Event Date Time
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/blocks/event-datetime.php
 *
 * See more documentation about our Blocks Editor templating system.
 *
 * @link {INSERT_ARTCILE_LINK_HERE}
 *
 * @version 4.7
 *
 */

$event_id = get_the_ID();
$event = get_post( $event_id );

$date_format = 'F j';
$start_date = tribe_get_start_date( $event_id, false, $date_format );
$start_day = tribe_get_start_date( $event_id, false, 'l' );
$start_ts = tribe_get_start_date( $event_id, false, Tribe__Date_Utils::DBDATEFORMAT );
$end_date = tribe_get_end_date( $event_id, false, $date_format );
$end_day = tribe_get_end_date( $event_id, false, 'l' );
$end_ts = tribe_get_end_date( $event_id, false, Tribe__Date_Utils::DBDATEFORMAT );

if ( has_blocks( get_the_content( $event_id ) ) ) {
  $blocks = parse_blocks( get_the_content( $event_id ) );
  foreach ( $blocks as $block ) {
    if( $block[blockName] === 'tribe/event-website') {
     $website = $block[attrs][urlLabel];
    }
  }
} else {
  $website = tribe_get_event_website_url();
}

$button_text = 'Get tickets';
$rel = 'bookmark';
$target = '_blank';
if ( $website && !strpos($website, 'eventbrite.com') ) {
	if(strpos($website, 'google.com')) {
		$button_text = 'Get Started';
	}
	if(strpos($website, 'goo.gl/forms')) {
		$button_text = 'Sign Up';
	}
} else {
	$website = '#get-tickets';
  $rel = 'noopener';
  $target = '_self';
}
?>

<div class="tribe-events-schedule tribe-clearfix">
  <div class="tribe-events-dates">
    <span class="tribe-events-start-date">
      <time datetime="<?php esc_attr_e( $start_ts ) ?>"><?php esc_html_e( $start_date ) ?></time>
      <dfn><?php esc_html_e( $start_day ) ?></dfn>
    </span>
    <?php if ( tribe_event_is_multiday() ) : echo ' - '; // Multiday events	?>
      <span class="tribe-events-end-date">
        <time datetime="<?php esc_attr_e( $end_ts ) ?>"><?php esc_html_e( $end_date ) ?></time>
        <dfn><?php esc_html_e( $end_day ) ?></dfn>
      </span>
    <?php endif; ?>
  </div>
  <?php if ( tribe_get_venue() ) : ?>
    <span class="tribe-events-venue"><?php echo tribe_get_venue(); ?></span>
  <?php endif; ?>
  <?php if ( tribe_get_cost() ) : ?>
    <span class="tribe-events-cost"><?php echo tribe_get_cost( null, true ) ?></span>
  <?php endif; ?>
  <a href="<?php echo $website; ?>" 
     rel="<?php echo $rel; ?>" 
     target="<?php echo $target; ?>"
     class="tribe-events-tickets-cta"><?php echo $button_text; ?></a>
</div>

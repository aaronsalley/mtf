<?php
/**
 * Single Event Category
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$event_id = get_the_ID();

echo tribe_get_event_taxonomy( $event_id, array(
        'before'	=> '<p class="tribe-events-single-event-category">',
        'sep'			=> ' ',
        'after'		=> '</p>',
      ));

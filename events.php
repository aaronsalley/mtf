<?php
/**
 * Template Name: Events Template
 * This file is the basic wrapper template for all the views if 'Default Events Template'
 * is selected in Events -> Settings -> Template -> Events Template.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/default-template.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

get_header();
?>
	<?php if ( is_tax() ) { ?>
		<?php echo term_description(); ?>
	<? } else { ?>
<!-- 		<?php tribe_events_before_html(); ?> -->
		<?php tribe_get_view(); ?>
		<?php tribe_events_after_html(); ?>
	<? } ?>
<?php
get_footer();

<?php
/**
 * List View Single Event
 * This file contains one event in the list view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/single-event.php
 *
 * @version 4.6.19
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
?>
<!-- Event Image -->
<?php echo tribe_event_featured_image( null, 'medium' ); ?>

<!-- Event Title -->
<?php do_action( 'tribe_events_before_the_event_title' ) ?>
<h3 class="tribe-events-list-event-title">
	<a class="tribe-event-url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title_attribute() ?>" rel="bookmark">
		<?php the_title(); ?>
	</a>
</h3>
<?php do_action( 'tribe_events_after_the_event_title' ) ?>

<div class="magic-box">
	<!-- Event Meta -->
	<?php do_action( 'tribe_events_before_the_meta' ) ?>
	<div class="tribe-events-event-meta">
		<a class="tribe-event-url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title_attribute() ?>" rel="bookmark">
			<!-- Schedule & Recurrence Details -->
			<span class="tribe-event-schedule-details"><?php echo tribe_events_event_schedule_details(); ?></span>
			<?php if ( tribe_get_cost() ) : ?>
				<!-- Event Cost -->
				<span class="ticket-cost"><?php echo tribe_get_cost( null, true ); ?></span>
			<?php endif; ?>
		</a>
	</div><!-- .tribe-events-event-meta -->
	<?php do_action( 'tribe_events_after_the_meta' ); ?>

	<!-- Event Content -->
	<?php do_action( 'tribe_events_before_the_content' ); ?>
	<div class="tribe-events-list-event-description tribe-events-content description entry-summary">
		<a class="tribe-events-read-more" href="<?php echo esc_url( tribe_get_event_link() ); ?>" rel="bookmark">
			<?php echo tribe_events_get_the_excerpt( null, wp_kses_allowed_html( 'post' ) ); ?>
		</a>
	</div><!-- .tribe-events-list-event-description -->
	<?php do_action( 'tribe_events_after_the_content' ); ?>
</div>

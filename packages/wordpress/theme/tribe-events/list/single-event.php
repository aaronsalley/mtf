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
$time_format = get_option( 'time_format', Tribe__Date_Utils::TIMEFORMAT );

$start_date = tribe_get_start_date( null, false, 'F j' );
$start_time = tribe_get_start_date( null, false, $time_format );
$start_ts = tribe_get_start_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );
$end_date = tribe_get_display_end_date( null, false, 'F j' );
$end_ts = tribe_get_end_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );
?>
<!-- Event Image -->
<?php 
if ( tribe_event_featured_image() ) {
	echo tribe_event_featured_image( null, 'medium' );
} else {
	echo '<div class="event-image-placeholder"></div>';
}
?>

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
			<div class="tribe-events-dates">
				<span class="tribe-events-start-date">
					<time datetime="<?php esc_attr_e( $start_ts ) ?>"><?php esc_html_e( $start_date ) ?>
						<?php if ( !tribe_event_is_multiday() ) : esc_html_e(' at '); // Multiday events	?>
							<span><?php esc_html_e( $start_time ) ?></span>
						<?php endif; ?>
					</time>
				</span>
				<?php if ( tribe_event_is_multiday() ) : echo ' - '; // Multiday events	?>
					<span class="tribe-events-end-date">
						<time datetime="<?php esc_attr_e( $end_ts ) ?>"><?php esc_html_e( $end_date ) ?></time>
					</span>
				<?php endif; ?>
			</div>
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

	<div class="tribe-events-list-tags">
		<?php echo tribe_get_event_categories(); ?>
		<?php echo tribe_meta_event_tags(); ?>
	</div>
</div>

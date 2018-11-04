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
global $post;

// Setup an array of venue details for use later in the template
$venue_details = tribe_get_venue();

// The address string via tribe_get_venue_details will often be populated even when there's
// no address, so let's get the address string on its own for a couple of checks below.
$venue_address = tribe_get_address();

// Venue
$has_venue_address = ( ! empty( $venue_details['address'] ) ) ? ' location' : '';

// Organizer
$organizer = tribe_get_organizer();

$has_tags = has_tag();

?>

<a class="url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title_attribute() ?>" rel="bookmark">

	<!-- Event Image -->
	<?php if ( is_front_page() ) {
		echo tribe_event_featured_image( null, 'thumbnail', false );
	} else {
		echo tribe_event_featured_image( null, 'event', false );
	}
	?>

	<!-- Event Title -->
	<?php do_action( 'tribe_events_before_the_event_title' ) ?>
	<h5 class="title">
			<?php the_title() ?>
	</h5>
	<?php do_action( 'tribe_events_after_the_event_title' ) ?>

	<!-- Event Meta -->
	<?php do_action( 'tribe_events_before_the_meta' ) ?>
	<div class="meta">
		<!-- Schedule & Recurrence Details -->
		<div class="schedule">
			<?php echo tribe_events_event_schedule_details( $post->ID ); ?>
		</div>

		<?php if ( $venue_details ) : ?>
			<!-- Venue Display Info -->
			<div class="venue">
				<?php echo $venue_details; ?>
			</div> <!-- .events-venue-details -->
		<?php endif; ?>
	</div><!-- .events-event-meta -->
	<?php do_action( 'tribe_events_after_the_meta' ) ?>

	<!-- Event Cost -->
	<?php if ( tribe_get_cost() ) : ?>
		<div class="cost">
			<span class="ticket-cost"><?php echo tribe_get_cost( null, true ); ?></span>
			<?php
			/**
			 * Runs after cost is displayed in list style views
			 *
			 * @since 4.5
			 */
			do_action( 'tribe_events_inside_cost' )
			?>
		</div>
	<?php endif; ?>
</a>

<?php if( $has_tags ) : ?>
	<div class="tags">
		<?php
		foreach ( get_the_tags() as $tag ){
			$link = get_term_link($tag, $tag->taxonomy);
			echo '<span class="tag"><a href="' . esc_url( $link ) . '" rel="tag">#' . $tag->name . '</a></span>';
		};
		?>
	</div>
<?php endif; ?>

<?php
do_action( 'tribe_events_after_the_content' );

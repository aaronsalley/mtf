<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural   = tribe_get_event_label_plural();

$event_id = get_the_ID();

$website = tribe_get_event_website_url();
if ( $website && !strpos($website, 'eventbrite.com') ) {
	$website = tribe_get_event_website_url();
} else {
	$website = '#get-tickets';
}
?>

<div class="blur">
	<?php echo tribe_event_featured_image( $event_id, 'event', false ); ?>
</div>

<?php tribe_get_template_part('list/title', 'bar'); ?>

<div class="content">
	<!-- Notices -->
	<?php tribe_the_notices() ?>

	<?php while ( have_posts() ) :  the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('single-event'); ?>>
			<!-- Event header -->
			<header id="header" <?php tribe_events_the_header_attributes() ?>>
				<?php echo tribe_event_featured_image( $event_id, 'event', false ); ?>
				<div class="wrap">
					<?php echo tribe_events_event_schedule_details( $event_id, '<h5 class="schedule">', '</h5>' ); ?>
					<?php the_title( '<h2 class="title">', '</h2>' ); ?>

					<div class="schedule tribe-clearfix">
						<?php if ( tribe_get_cost() ) : ?>
							<span class="cost"><?php echo tribe_get_cost( null, true ) ?></span>
						<?php endif; ?>
					</div>
					<a class="button" href="<?php echo $website; ?>"><?php esc_html_e('Get tickets'); ?></a>
				</div>
			</header>
			<menu class="links">
				<?php do_action( 'tribe_events_single_event_after_the_content' ) ?>
			</menu>
			<!-- #header -->

			<!-- Event content -->
			<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
			<div class="description">
				<?php the_content(); ?>
			</div>
			<!-- .single-event-description -->

			<!-- Event meta -->
			<?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
			<?php tribe_get_template_part( 'modules/meta' ); ?>
			<?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>
		</div> <!-- #post-x -->
		<?php if ( get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments', false ) ) comments_template() ?>
	<?php endwhile; ?>

</div><!-- #content -->

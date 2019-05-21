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

$start_date = tribe_get_start_date( null, false, 'F j' );
$start_day = tribe_get_start_date( null, false, 'l' );
$start_ts = tribe_get_start_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );
$end_date = tribe_get_display_end_date( null, false, 'F j' );
$end_day = tribe_get_display_end_date( null, false, 'l' );
$end_ts = tribe_get_end_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );

$website = tribe_get_event_website_url();
$button_text = 'Get tickets';
if ( $website && !strpos($website, 'eventbrite.com') ) {
	if(strpos($website, 'google.com')) {
		$button_text = 'Get Started';
	}
	if(strpos($website, 'goo.gl/forms')) {
		$button_text = 'Sign Up';
	}
} else {
	$website = '#get-tickets';
}
?>

<div id="tribe-events-content" class="tribe-events-single">
	<?php while ( have_posts() ) :  the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<!-- Event featured image, but exclude link -->
			<?php echo tribe_event_featured_image( $event_id, 'full', false ); ?>

			<p class="tribe-events-back">
				<a href="<?php echo esc_url( tribe_get_events_link() ); ?>"> <?php printf( '&laquo; ' . esc_html_x( 'All %s', '%s Events plural label', 'the-events-calendar' ), $events_label_plural ); ?></a>
			</p>

			<!-- Notices -->
			<?php tribe_the_notices(); ?>

			<!-- Event header -->
			<div id="tribe-events-header" <?php tribe_events_the_header_attributes(); ?>>
				<!-- Navigation -->
				<nav class="tribe-events-nav-pagination" aria-label="<?php printf( esc_html__( '%s Navigation', 'the-events-calendar' ), $events_label_singular ); ?>">
					<ul class="tribe-events-sub-nav">
						<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%' ) ?></li>
						<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% <span>&raquo;</span>' ) ?></li>
					</ul>
					<!-- .tribe-events-sub-nav -->
				</nav>
			</div>
			<!-- #tribe-events-header -->

			<?php the_title( '<h2 class="tribe-events-single-event-title">', '</h2>' ); ?>
			<?php echo tribe_get_event_taxonomy( $event_id, array(
							'before'	=> '<p class="tribe-events-single-event-category">',
							'sep'			=> ' ',
							'after'		=> '</p>',
						));
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
				<a href="<?php echo $website; ?>" class="tribe-events-tickets-cta"><?php echo $button_text; ?></a>
			</div>

			<!-- Event content -->
			<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
			<div class="tribe-events-single-event-description tribe-events-content">
				<?php the_content(); ?>
			</div>
			<!-- .tribe-events-single-event-description -->
			<?php do_action( 'tribe_events_single_event_after_the_content' ) ?>

			<!-- Event meta -->
			<?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
			<?php tribe_get_template_part( 'modules/meta' ); ?>
			<?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>
		</div> <!-- #post-x -->
		<?php if ( get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments', false ) ) comments_template() ?>
	<?php endwhile; ?>

	<!-- Event footer -->
	<div id="tribe-events-footer">
		<!-- Navigation -->
		<nav class="tribe-events-nav-pagination" aria-label="<?php printf( esc_html__( '%s Navigation', 'the-events-calendar' ), $events_label_singular ); ?>">
			<ul class="tribe-events-sub-nav">
				<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%' ) ?></li>
				<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% <span>&raquo;</span>' ) ?></li>
			</ul>
			<!-- .tribe-events-sub-nav -->
		</nav>
	</div>
	<!-- #tribe-events-footer -->

</div><!-- #tribe-events-content -->

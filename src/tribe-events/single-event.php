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

?>

<header class="header">
	<div class="masthead">
		<h2 class="title"><?php the_title(); ?></h2>
		<button class="button"><?php esc_html_e('Support us'); ?></button>
	</div>
	<?php for($i = 0; $i < 10; $i++){
		$instagram[] = '<div class="post">
			<img class="image" src="#" />
		</div>';
	}
	echo $instagram = '<div class="instagram feed"><div class="wrap">' . implode($instagram) . '</div></div>'; ?>
</header>

<div class="content">
	<!-- Notices -->
	<?php tribe_the_notices() ?>

	<?php while ( have_posts() ) :  the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('single-event'); ?>>
			<!-- Event header -->
			<header id="header" <?php tribe_events_the_header_attributes() ?>>
				<?php echo tribe_event_featured_image( $event_id, 'full', false ); ?>
				<div class="wrap">
					<?php the_title( '<h2 class="single-event-title">', '</h2>' ); ?>

					<div class="schedule tribe-clearfix">
						<?php echo tribe_events_event_schedule_details( $event_id, '<h3>', '</h3>' ); ?>
						<?php if ( tribe_get_cost() ) : ?>
							<span class="cost"><?php echo tribe_get_cost( null, true ) ?></span>
						<?php endif; ?>
					</div>
					<!-- #header -->
				</div>
			</header>

			<!-- Event content -->
			<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
			<div class="description">
				<?php the_content(); ?>
			</div>
			<!-- .single-event-description -->
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
		<nav class="nav-pagination" aria-label="<?php printf( esc_html__( '%s Navigation', 'the-events-calendar' ), $events_label_singular ); ?>">
			<ul class="tribe-events-sub-nav">
				<li class="nav-previous"><?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%' ) ?></li>
				<li class="nav-next"><?php tribe_the_next_event_link( '%title% <span>&raquo;</span>' ) ?></li>
			</ul>
			<!-- .sub-nav -->
		</nav>
	</div>
	<!-- #footer -->

</div><!-- #content -->

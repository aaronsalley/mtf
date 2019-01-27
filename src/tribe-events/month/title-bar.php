<?php
/**
 * Month View Title Template
 * The title template for the month view of events.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/month/title-bar.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 * @since   4.6.19
 *
 */
?>

<header class="header">
  <div class="masthead">
		<?php do_action( 'tribe_events_before_the_title' ); ?>
		<h2 class="title"><?php echo tribe_get_events_title() ?></h2>
		<?php do_action( 'tribe_events_after_the_title' ); ?>
    <a class="button" href="/donate" target="_blank"><?php esc_html_e('Support us'); ?></a>
  </div>
  <?php get_template_part('template-parts/gallery'); ?>
</header>

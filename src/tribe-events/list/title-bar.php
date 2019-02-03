<?php
/**
 * List View Title Template
 * The title template for the list view of events.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/title-bar.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 * @since   4.6.19
 *
 */

 function tribe_get_text_categories ( $event_id = null ) {

   if ( is_null( $event_id ) ) {
     $event_id = get_the_ID();
   }

   $event_cats = '';

   $term_list = wp_get_post_terms( $event_id, Tribe__Events__Main::TAXONOMY );

   foreach( $term_list as $term_single ) {
     $event_cats .= $term_single->name . ', ';
   }

   return rtrim($event_cats, ', ');

 }
?>

<header class="header">
  <div class="masthead">
		<?php do_action( 'tribe_events_before_the_title' ); ?>
		<h2 class="title">
      <?php
        if( is_single() ) {
          echo tribe_get_text_categories();
        } else {
          echo tribe_get_events_title();
        }
      ?>
    </h2>
		<?php do_action( 'tribe_events_after_the_title' ); ?>
    <a class="button" href="/donate" target="_blank"><?php esc_html_e('Support us'); ?></a>
  </div>
  <?php get_template_part('template-parts/gallery'); ?>
</header>

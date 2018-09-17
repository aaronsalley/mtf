<?php
/**
 * Related Events Template
 * The template for displaying related events on the single event page.
 *
 * You can recreate an ENTIRELY new related events view by doing a template override, and placing
 * a related-events.php file in a tribe-events/pro/ directory within your theme directory, which
 * will override the /views/pro/related-events.php.
 *
 * You can use any or all filters included in this file or create your own filters in
 * your functions.php. In order to modify or extend a single filter, please see our
 * readme on templates hooks and filters
 *
 * @package TribeEventsCalendarPro
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

global $post;

$posts = tribe_get_related_posts();

if ( is_array( $posts ) && ! empty( $posts ) ) : ?>

<h3 class="related-events-title"><?php printf( __( 'Related %s', 'tribe-events-calendar-pro' ), tribe_get_event_label_plural() ); ?></h3>

<div class="related-events tribe-clearfix">
	<?php foreach ( $posts as $post ) : setup_postdata($post);
	
		$post_parent = '';
		if ( $post->post_parent ) {
			$post_parent = ' data-parent-post-id="' . absint( $post->post_parent ) . '"';
		}

		$classes = array('event');
		if ( has_tag() === true ) $classes[] = 'has-tags';
		$classes = implode( ' ', $classes );
		?>
		<div id="post-<?php the_ID(); ?>" class="<?php tribe_events_event_classes($classes); ?>" <?php echo $post_parent; ?>>
			<?php
			$event_type = tribe( 'tec.featured_events' )->is_featured( $post->ID ) ? 'featured' : 'event';

			/**
			 * Filters the event type used when selecting a template to render
			 *
			 * @param $event_type
			 */
			$event_type = apply_filters( 'tribe_events_list_view_event_type', $event_type );

			tribe_get_template_part( 'list/single', $event_type );
			?>
	</div>
	<?php endforeach; wp_reset_postdata(); ?>
</div>
<?php
endif;

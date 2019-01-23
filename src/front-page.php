<?php
global $post;

get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <h2 class="mission">
    <?php
    add_filter('the_content', 'remove_shortcode_from');
    the_content();
    remove_filter('the_content', 'remove_shortcode_from')
    ?>
  </h2>
  <?php $events = tribe_get_events( array(
    'posts_per_page' => 4,
    'orderby' => 'event_date',
    // 'order' => 'DESC',
    'start_date' => date("Y-m-d H:i:s")
  ));
  ?>
  <div id="tribe-events" class="events list">
    <?php foreach ( $events as $post ) : setup_postdata($post);

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
	<?php get_template_part('template-parts', 'gallery.php'); ?>
<?php endwhile; else : ?>
	<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
<?php get_footer(); ?>

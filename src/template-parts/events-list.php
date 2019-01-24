<div id="tribe-events" class="events list">
  <?php $events = tribe_get_events( array(
    'posts_per_page' => 4,
    'orderby' => 'event_date',
    // 'order' => 'DESC',
    'start_date' => date("Y-m-d H:i:s")
  ));

  foreach ( $events as $post ) : setup_postdata($post);

    $post_parent = '';
    $classes = array('event');
    $_id = get_the_ID();

    if ( $post->post_parent ) {
      $post_parent = ' data-parent-post-id="' . absint( $post->post_parent ) . '"';
    }

    if ( has_tag() === true ) $classes[] = 'has-tags';
    $classes = implode( ' ', $classes );
    $classes = $classes . ' ' . tribe_events_event_classes($classes, false);

    echo "<div id='post-$_id' class='$classes' $post_parent>";
      /**
       * Filters the event type used when selecting a template to render
       *
       * @param $event_type
       */
      $event_type = tribe( 'tec.featured_events' )->is_featured( $post->ID ) ? 'featured' : 'event';
      $event_type = apply_filters( 'tribe_events_list_view_event_type', $event_type );
      tribe_get_template_part( 'list/single', $event_type );

    echo "</div>";

  endforeach; wp_reset_postdata(); ?>
</div>

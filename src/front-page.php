<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <div class="mission">
    <?php the_content(); ?>
  </div>
  <?php for( $i = 0; $i < 4; $i++){
    $event = [
      'status'  => 'live',
      'logo_id' => '#',
      'title'   => 'Event Title',
      'date'    => 'Month XX at XX:XX',
      'venue'   => 'Venue',
    ];
    $events[] = '<article class="event ' . $event['status'] . '">
      <img class="image" src="' . $event['logo_id'] . '" />
      <h5 class="title">' . $event['title'] . '</h2>
      <p class="date">' . $event['date'] . '</p>
      <p class="location">' . $event['venue'] . '</p>
    </article>';
  }
  echo $events = '<div class="events list">' . implode($events) . '</div>'; ?>
  <?php for($i = 0; $i < 40; $i++){
    $instagram[] = '<div class="post">
      <img class="image" src="#" />
    </div>';
  }
  echo $instagram = '<div class="instagram wall">' . implode($instagram) . '</div>'; ?>
<?php endwhile; else : ?>
	<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
<?php get_footer(); ?>

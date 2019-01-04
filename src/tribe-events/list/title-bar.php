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
?>

<header class="header">
  <div class="masthead">
		<?php do_action( 'tribe_events_before_the_title' ); ?>
		<h1 class="title"><?php echo tribe_get_events_title() ?></h1>
		<?php do_action( 'tribe_events_after_the_title' ); ?>
    <a class="button" href="/donate" target="_blank"><?php esc_html_e('Support us'); ?></a>
  </div>
  <?php for($i = 0; $i < 10; $i++){
		$instagram[] = '<div class="post">
			<img class="image" src="#" />
		</div>';
	}

  $frontpage_id = get_option( 'page_on_front' );

  if ( get_post_gallery($frontpage_id) ) :
      $gallery = get_post_gallery( $frontpage_id, false );
      $instagram = array();
      /* Loop through all the image and output them one by one */
      foreach( $gallery['src'] as $src ) :
        $instagram[] = '<div class="post">
          <img src="' . $src . '" class="image" alt="Gallery image" />
        </div>';
      endforeach;
  endif;
	echo $instagram = '<div id="instagram" class="feed"><div class="wrap">' . implode($instagram) . '</div></div>'; ?>
</header>

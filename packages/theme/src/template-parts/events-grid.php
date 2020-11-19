<?php 
$query = tribe_get_events(array(
    'start_date'  =>  current_datetime(),
), true );

if ( $query -> have_posts() ):

$cta = 'Buy Tickets';
?>
<div id="events" class="grid py-5 bg-light">
  <div class="container py-5">
    <h2 class="row mx-0"><?php _e( 'Coming Up Next', 'mtf' ); ?></h2>
    <div class="row mt-5 mb-3 mx-0">
      <?php while( $query -> have_posts() ) : $query -> the_post(); ?>
      <a href="<?php the_permalink(); ?>" class="card col-md-6 col-lg-4 col-xl-3 p-0">
        <div class="card-img-top">
          <?php 
          if( has_post_thumbnail() ) {
            the_post_thumbnail( 'medium' ); 
          } ?>
        </div>
        <header class="card-header">
          <h5 class="h5 card-title"><?php the_title(); ?></h5>
        </header>
        <div class="card-body">
          <p class="card-text date"><?php echo tribe_get_start_date(); ?></p>
          <div class="card-text excerpt"><?php the_excerpt(); ?></div>
        </div>
        <footer class="card-footer d-flex justify-content-between py-0">
          <div class="btn text-left"><?php _e($cta, 'mtf'); ?></div>
          <div class="btn text-right"><?php _e('Details', 'mtf'); ?></div>
        </footer>
      </a>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
    <a href="/events" class="btn btn-block text-uppercase text-right font-weight-bold"><?php _e('See all events', 'mtf'); ?></a>
  </div>
</div>
<?php endif; ?>
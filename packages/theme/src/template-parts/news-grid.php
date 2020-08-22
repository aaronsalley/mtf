<?php 
$query = new WP_Query( array(
  'post_type' => 'post',
  'category_name' => 'press,news',
));

if ( $query -> have_posts() ):
?>
<div id="news" class="masonry py-5 custom-background">
  <div class="container py-5">
    <h2 class="text-light"><?php _e( 'Latest News', 'mtf' ); ?></h2>
    <div class="card-columns pb-2 mt-5">
      <?php while ( $query -> have_posts() ) : $query -> the_post(); ?>
      <a href="<?php the_permalink(); ?>" class="card">
        <header class="card-header">
          <h5 class="h5 card-title"><?php the_title(); ?></h5>
        </header>
        <div class="card-body">
          <div class="card-text border border-dark"><?php the_date('m.d.Y'); ?></div>
          <div class="card-text excerpt"><?php the_excerpt(); ?></div>
        </div>
        <footer class="card-body d-flex justify-content-end">
          <div class="btn text-right"><?php _e('Read On', 'mtf'); ?></div>
        </footer>
      </a>
      <?php endwhile; ?>
    </div>
    <a class="btn btn-block text-light text-uppercase text-right font-weight-bold"><?php _e('See all news', 'mtf'); ?></a>
  </div>
</div>
<?php endif; ?>
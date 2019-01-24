<section class="blog-posts">
  <?php
  $_posts = new WP_Query([
    'post_type' => 'post',
    'ignore_sticky_posts' => true,
  ]);
  if ( $_posts->have_posts() ) : echo "<div class='grid-sizer'></div><div class='gutter-sizer'></div>";
    while ( $_posts->have_posts() ) : $_posts->the_post();
    $class = is_sticky() ? 'sticky' : '';
    ?>
    <article <?php post_class($class); ?>>
      <div class="container">
        <figure class="image"></figure>
        <header class="header">
          <h3 class="lead"><?php the_title(); ?></h3>
          <p class="meta"></p>
          <section class="teaser">
            <?php the_excerpt(); ?>
          </section>
        </header>
      </div>
    </article>
  <?php endwhile; else : ?>
    <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
  <?php endif; wp_reset_postdata();?>
</section>

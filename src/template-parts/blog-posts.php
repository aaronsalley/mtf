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
      <a href="<?php the_permalink(); ?>">
        <div class="container">
          <figure class="image" style="background-image:url(<?php the_post_thumbnail_url(); ?>)">
            <?php the_post_thumbnail(); ?>
          </figure>
          <h3 class="lead"><?php the_title(); ?></h3>
        </div>
      </a>
    </article>
  <?php endwhile; else : ?>
  <?php endif; wp_reset_postdata();?>
</section>

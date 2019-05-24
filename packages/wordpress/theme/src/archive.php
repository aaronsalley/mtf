<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
  $class = is_sticky() ? 'sticky' : '';
?>
  <article <?php post_class( $class ); ?>>
    <a href="<?php the_permalink(); ?>">
      <?php the_post_thumbnail(); ?>
      <h2 class="title"><?php the_title(); ?></h2>
      <p class="date"><?php the_date('n/j/Y'); ?></p>
      <div class="excerpt"><?php the_excerpt(); ?></div>
      <span class="readmore">Read more</span>
    </a>
  </article>
<?php endwhile; endif; ?>
<?php get_footer(); ?>

<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <article <?php post_class(); ?>>
    <?php the_post_thumbnail(); ?>
    <?php the_title(); ?>
    <?php the_excerpt(); ?>
  </article>
<?php endwhile; endif; ?>
<?php // TODO: if there's a category, display loop before the footer ?>
<?php get_footer(); ?>

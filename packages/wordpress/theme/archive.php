<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <article <?php post_class(); ?>>
    <a href="<?php the_permalink(); ?>">
      <?php the_post_thumbnail(); ?>
      <?php the_title(); ?>
      <?php the_excerpt(); ?>
    </a>
  </article>
<?php endwhile; endif; ?>
<?php get_template_part('related', 'loop'); ?>
<?php get_footer(); ?>

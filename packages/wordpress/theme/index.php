<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <article <?php post_class(); ?>>
    <?php the_content(); ?>
  </article>

<?php endwhile; else : ?>

	<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>

<?php endif; ?>
<?php get_footer(); ?>

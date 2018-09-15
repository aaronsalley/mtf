<?php get_header(); ?>
<main id="app">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <header class="instagram feed">
    <?php the_title(); ?>
    <button class="button"><?php esc_html_e('Support us'); ?></button>
    <?php echo $instagram->instagram_posts(); ?>
  </header>
  <section class="content">
    <?php the_content(); ?>
  </sectin>
<?php endwhile; else : ?>
	<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
</main>
<?php get_footer(); ?>

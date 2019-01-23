<?php
global $post;

get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <h2 class="mission">
    <?php
    add_filter('the_content', 'remove_shortcode_from');
    the_content();
    remove_filter('the_content', 'remove_shortcode_from')
    ?>
  </h2>
	<?php get_template_part('template-parts/events', 'list'); ?>
	<?php get_template_part('template-parts/gallery'); ?>
	<?php get_template_part('template-parts/blog', 'posts'); ?>
	<?php endwhile; else : ?>
	<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
<?php get_footer(); ?>

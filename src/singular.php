<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <header class="header">
    <div class="masthead">
      <h2 class="title"><?php the_title(); ?></h2>
      <button class="button"><?php esc_html_e('Support us'); ?></button>
    </div>
    <div class="instagram feed">
      <div class="wrap">
        <?php echo $instagram->instagram_posts(10); ?>
      </div>
    </div>
  </header>
  <section class="content">
    <?php the_content(); ?>
  </sectin>
<?php endwhile; else : ?>
	<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
<?php get_footer(); ?>

<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <?php get_template_part('template-parts/header', 'masthead'); ?>

  <article <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
    <header>
      <h2 class="title" itemprop="headline"><?php the_title(); ?></h2>
    </header>
    <section class="content" itemprop="articleBody">
      <?php the_content(); ?>
    </section>
    <footer>
      <?php the_date(); ?>
    </footer>
  </article>
<?php endwhile; else : ?>
	<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
<?php get_footer(); ?>

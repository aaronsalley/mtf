<?php get_header(); ?>
<main class="Post_container">
  <header>
    <?php get_template_part('components/molecules/TheTitle/index'); ?>
    <div>
      <?php the_excerpt(); ?>
    </div>
  </header>
  <section class="content"><?php the_content(); ?></section>
</main>
<?php get_footer(); ?>
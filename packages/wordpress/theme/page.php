<?php get_header(); ?>
<main class="Page_container">
  <section class="content"><?php the_content(); ?></section>
  <aside>
    <?php get_template_part('components/molecules/TheTitle/index'); ?>
    <div>
      <?php the_excerpt(); ?>
    </div>
  </aside>
</main>
<?php get_footer(); ?>
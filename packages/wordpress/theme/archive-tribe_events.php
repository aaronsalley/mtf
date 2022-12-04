<?php get_header(); ?>
<main>
  <section>
    <section>
      <!-- <menu></menu> -->
      <div>{event items}</div>
      <button>See past events</button>
    </section>
  </section>
  <aside>
    <?php get_template_part('components/the_title'); ?>
    <div>
      <?php the_excerpt(); ?>
    </div>
  </aside>
</main>
<?php get_footer(); ?>
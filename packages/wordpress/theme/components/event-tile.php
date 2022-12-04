<article>
  <a class="Event_tile_container" href="<?php the_permalink(); ?>">
    <header>
      <div>
        <?php the_post_thumbnail(); ?>
      </div>
      <h3><?php the_title(); ?></h3>
    </header>
    <section>
      <time><?php echo MTF_Musicals\Events::dates(); ?></time>
      <div><?php the_excerpt(); ?></div>
    </section>
    <footer>
      <button type="button">Details</button>
    </footer>
  </a>
</article>
<article>
  <a class="Event_row_container" href="<?php the_permalink(); ?>">
    <div>
      <?php the_post_thumbnail(); ?>
    </div>
    <section>
      <header>
        <h2><?php the_title(); ?></h2>
        <time><?php echo MTF_Musicals\Events::dates(); ?></time>
        <address>{locationName}</address>
      </header>
      <div className={styles['summary']} dangerouslySetInnerHTML={{ __html: excerpt }}></div>
      <footer>
        <button>Details</button>
      </footer>
    </section>
  </a>
</article>
<article class="Article_tile_container">
  <a href=<?php the_permalink(); ?>>
    <header>
      <h3><?php the_title(); ?></h3>
    </header>
    <section>
      <time><?php the_date(); ?></time>
      <div><?php the_excerpt(); ?></div>
    </section>
    <footer>
      <button type="button">Read more</button>
    </footer>
  </a>
</article>
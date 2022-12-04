<article class="Article_tile_container">
  <Link href={url as string}>
  <a>
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
  </Link>
</article>
<?php
$__terms = [];

if ($taxonomy === 'tags') {
  $__terms = get_the_tags();
} else {
  $__terms = get_the_category();
}

if ($__terms) {
  $terms = [];

  foreach ($__terms as $term) {
    $terms[] = $term->name;
  }

  $terms = implode(' ', $terms);
}

?>
<article class="Article_tile_container">
  <a href=<?php the_permalink(); ?>>
    <span><?php echo $terms; ?></span>
    <header>
      <h3><?php the_title(); ?></h3>
    </header>
    <section>
      <div><?php the_excerpt(); ?></div>
    </section>
    <footer>
      <button type="button">Read more</button>
    </footer>
  </a>
</article>
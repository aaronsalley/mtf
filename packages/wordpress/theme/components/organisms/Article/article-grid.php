<?php
$max_columns = 4;
$the_query = new WP_Query([
  'post_type' => 'post',
  'tax_query' => [
    [
      'taxonomy'  => 'category',
      'field' => 'slug',
      'terms' => 'news'
    ]
  ],
  'posts_per_page'  => 8,
]);

if ($the_query->have_posts()) :
  $columns;
  for ($i = 0; $i < $max_columns; $i++) {
    $columns["column${i}"] = [];
  }

  $j = 0;
  while ($the_query->have_posts()) {
    $i = $j % $max_columns;
    $the_query->the_post();

    array_push(
      $columns["column${i}"],
      MTF_Musicals::load_template_part('components/molecules/Article/article', 'tile')
    );

    $j++;
  }

  $articles = [];
  for ($i = 0; $i < $max_columns; $i++) {
    array_push(
      $articles,
      "<div>" . join('', $columns["column$i"]) . "</div>"
    );
  }
?>
  <section id="news" class="Article_grid_container">
    <div>
      <?php echo join('', $articles); ?>
    </div>
    <a class="button" href="<?php echo get_term_link('news', 'category'); ?>">See all news</a>
  </section>
<?php
endif;
wp_reset_postdata();
?>
<?php
$max_columns = 7;
$the_query = new WP_Query([
  'post_type' => 'attachment',
  'post_status' => 'any',
  'tax_query' => [
    [
      'taxonomy'  => 'media_cats',
      'field' => 'slug',
      'terms' => 'maker'
    ]
  ],
  'posts_per_page'  => 22,
  'orderby' => 'rand'
]);

function tile($min = 181, $max = 384)
{
  $random = floor(mt_rand() / mt_getrandmax() * ($max - $min + 1)) + $min;
  $height = ($random / $min) * 100;

  MTF_Musicals::logger($height);


  return "<figure style='padding-bottom: $height%;'>" . wp_get_attachment_image(get_the_ID(), 'medium-large') . "</figure>";
}

if ($the_query->have_posts()) :
  $columns;
  for ($i = 0; $i < $max_columns; $i++) {
    $columns["column${i}"] = [];
  }

  $i = 0;
  while ($the_query->have_posts()) {
    $j = $i % $max_columns;
    $the_query->the_post();

    $tile = tile();
    $big_tile = tile(263, 311);

    // MTF_Musicals::logger($the_query->post_count);

    if ($i < 4) array_push($columns["column0"], $tile);
    else if ($i < 7) array_push($columns["column1"], $tile);
    else if ($i === 7) array_push($columns["column2"], $big_tile);
    else if ($i < 10) array_push($columns["column2"], $tile);
    else if ($i < 14) array_push($columns["column3"], $tile);
    else if ($i < 16) array_push($columns["column4"], $tile);
    else if ($i === 16) array_push($columns["column5"], $big_tile);
    else if ($i < 19) array_push($columns["column5"], $tile);
    else array_push($columns["column6"], $tile);

    $i++;
  }

  $gallery = [];
  for ($i = 0; $i < $max_columns; $i++) {
    array_push(
      $gallery,
      "<div>" . join('', $columns["column$i"]) . "</div>"
    );
  }
?>
  <section id="makers">
    <div><?php echo join('', $gallery); ?></div>
  </section>
<?php
endif;
wp_reset_postdata();
?>
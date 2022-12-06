<?php get_header(); ?>
<?php
echo $article_CTA = 'Read Article';
// $args  = array(
//   'posts_per_page'      => 1,
//   'post__in'            => get_option('sticky_posts'),
//   'ignore_sticky_posts' => 1,
// );
// $query = new WP_Query($args);


// if ($query->have_posts()) : while ($query->have_posts()) :

//     $i = 0;

//     $query->the_post();

//   endwhile;
// endif;
?>
<main>
  <?php
  $args = [
    'category_name' => 'press'
  ];
  $the_query = new WP_Query($args);
  if ($the_query->have_posts()) :
  ?>
    <!-- display recent sticky from the past quarter; else display most recent -->
    <article>
      <span><?php the_post_thumbnail('large'); ?></span>
      <div>
        <caption><?php the_category(); ?></caption>
        <header>
          <h3><?php the_title(); ?></h3>
          <p><?php the_excerpt(); ?></p>
        </header>
        <button><?php echo $article_CTA; ?></button>
      </div>
    </article>
    <section>
      <h2>Press</h2>
      <div>
        <button></button>
        <div>
          <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
            <article>
              <span><?php the_post_thumbnail('medium'); ?></span>
              <div>
                <caption><?php the_category(); ?></caption>
                <header>
                  <h3><?php the_title(); ?></h3>
                  <p><?php the_excerpt(); ?></p>
                </header>
                <button><?php echo $article_CTA; ?></button>
              </div>
            </article>
          <?php endwhile; ?>
        </div>
        <button></button>
      </div>
    </section>
  <?php
  endif;
  wp_reset_postdata();

  $args = [
    'category_name' => 'news'
  ];
  $the_query = new WP_Query($args);
  if ($the_query->have_posts()) :
  ?>
    <div>
      <section>
        <h2>News</h2>
        <div>
          <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
            <article>
              <span><?php the_post_thumbnail('medium'); ?></span>
              <div>
                <h3><?php the_title(); ?></h3>
                <button><?php echo $article_CTA; ?></button>
              </div>
            </article>
          <?php endwhile; ?>
        </div>
      </section>
      <aside></aside>
    </div>
  <?php
  endif;
  wp_reset_postdata();

  $args = [
    'tax_query' => [
      'relation'  => 'AND',
      [
        'taxonomy' => 'category',
        'field' => 'slug',
        'terms'  => ['blog']
      ],
      [
        'taxonomy' => 'post_format',
        'field' => 'slug',
        'terms'  => ['post-format-video']
      ],
    ]
  ];
  $the_query = new WP_Query($args);
  if ($the_query->have_posts()) :
  ?>
    <section>
      <?php
      $i = 0;
      MTF_Musicals::logger(count($the_query->posts));
      while ($the_query->have_posts()) : if ($i = 1) echo '<div>';
        $the_query->the_post(); ?>
        <article>
          <span><?php the_post_thumbnail('large'); ?></span>
          <div>
            <caption><?php the_category(); ?></caption>
            <h3><?php the_title(); ?></h3>
            <div>Watch <button></button><span></span><time></time></div>
          </div>
        </article>
      <?php $i++;
      endwhile;
      if ($i > 0 && count($the_query->posts) > 1) echo '</div>'; ?>
    </section>
  <?php
  endif;
  wp_reset_postdata();
  ?>
  <div>
    <section>
      <?php
      $args = [
        'tax_query' => [
          'relation'  => 'AND',
          [
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms'  => ['oped', 'blog'],
          ],
          [
            'taxonomy' => 'post_format',
            'field' => 'slug',
            'terms'  => ['post-format-video'],
            'operator' => 'NOT IN'
          ],
        ]
      ];
      $the_query = new WP_Query($args);
      if ($the_query->have_posts()) :
      ?>
        <h2>Thought Leadership</h2>
        <div>
          <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
            <article>
              <span><?php the_post_thumbnail('medium'); ?></span>
              <div>
                <caption><?php the_category(); ?></caption>
                <header>
                  <h3><?php the_title(); ?></h3>
                  <p><?php the_excerpt(); ?></p>
                </header>
                <button><?php echo $article_CTA; ?></button>
              </div>
            </article>
          <?php endwhile; ?>
        </div>
      <?php
      endif;
      wp_reset_postdata();
      ?>
    </section>
    <article>
      <span><?php the_post_thumbnail('large'); ?></span>
      <div>
        <header>
          <h3><?php the_title(); ?></h3>
          <p><?php the_excerpt(); ?></p>
        </header>
        <button><?php echo $article_CTA; ?></button>
      </div>
    </article>
  </div>
</main>
<?php get_footer(); ?>
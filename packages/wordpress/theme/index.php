<?php get_header(); ?>
<?php $article_CTA = 'Read Article';
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
      <span class="image"><?php the_post_thumbnail('large'); ?></span>
      <div>
        <span class="post-categories"><?php the_category(' '); ?></span>
        <header>
          <h3 class="headline"><?php the_title(); ?></h3>
          <p class="lede"><?php the_excerpt(); ?></p>
        </header>
        <button class="left"><?php echo $article_CTA; ?></button>
      </div>
    </article>

    <section>
      <h2>Press</h2>
      <div>
        <button></button>
        <div>
          <?php while ($the_query->have_posts()) : $the_query->the_post(); // TODO: make carousel
          ?>
            <article>
              <span class="image"><?php the_post_thumbnail('medium'); ?></span>
              <div>
                <span class="post-categories"><?php the_category(' '); ?></span>
                <header>
                  <h3 class="headline"><?php the_title(); ?></h3>
                  <p class="lede"><?php the_excerpt(); ?></p>
                </header>
                <button class="left"><?php echo $article_CTA; ?></button>
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
      <h2>News</h2>
      <section>
        <div>
          <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
            <article>
              <span class="image"><?php the_post_thumbnail('medium'); ?></span>
              <div>
                <h3 class="headline"><?php the_title(); ?></h3>
                <button class="left"><?php echo $article_CTA; ?></button>
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
    'posts_per_page' => 4,
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
      while ($the_query->have_posts()) : $the_query->the_post();
        // TODO: make carousel
        if ($i === 1) {
          echo '<div>';
        } ?>
        <article>
          <span class="image"><?php the_post_thumbnail('large'); ?></span>
          <div>
            <span class="post-categories"><?php the_tags(' '); ?></span>
            <h3 class="headline"><?php the_title(); ?></h3>
            <div>Watch <button></button><span></span><time></time></div>
          </div>
        </article>
      <?php $i++;
        if ($i === count($the_query->posts)) {
          echo '</div>';
        }
      endwhile; ?>
    </section>
  <?php
  endif;
  wp_reset_postdata();
  ?>
  <div>
    <h2>Thought Leadership</h2>
    <section>
      <?php
      $args = [
        'posts_per_page' => 3,
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
        <div>
          <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
            <article>
              <span class="image"><?php the_post_thumbnail('medium'); ?></span>
              <div>
                <span class="post-categories"><?php the_category(' '); ?></span>
                <header>
                  <h3 class="headline"><?php the_title(); ?></h3>
                  <p class="lede"><?php the_excerpt(); ?></p>
                </header>
                <button class="left"><?php echo $article_CTA; ?></button>
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
      <!-- <span class="image"><?php the_post_thumbnail('large'); ?></span>
      <div>
        <header>
          <h3 class="headline"><?php the_title(); ?></h3>
          <p class="lede"><?php the_excerpt(); ?></p>
        </header>
        <button class="inverted left"><?php echo $article_CTA; ?></button>
      </div> -->
    </article>
  </div>
</main>
<?php get_footer(); ?>
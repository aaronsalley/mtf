<?php get_header(); ?>
<?php $article_CTA = 'Read Article';
function the_post_terms($taxonomy = 'category', $separator = ' ')
{
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

    echo implode($separator, $terms);
  }

  return;
}
?>
<main>
  <?php

  $args  = array(
    'posts_per_page' => 1,
    'tax_query' => [
      'relation'  => 'AND',
      [
        'taxonomy' => 'category',
        'field' => 'slug',
        'terms'  => ['news', 'press'],
      ],
      [
        'taxonomy' => 'post_format',
        'field' => 'slug',
        'terms'  => ['post-format-video'],
        'operator' => 'NOT IN'
      ],
    ],
    'post__in' => get_option('sticky_posts'),
    'ignore_sticky_posts' => 1,
  );
  $hero = new WP_Query($args);
  $hero_ID = $hero->post->ID;

  $args = [
    'posts_per_page' => 4,
    'post__not_in' => [$hero_ID],
    'tax_query' => [
      'relation'  => 'AND',
      [
        'taxonomy' => 'category',
        'field' => 'slug',
        'terms'  => ['news'],
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
    <!-- display recent sticky from the past quarter; else display most recent -->
    <?php if ($hero->have_posts()) : while ($hero->have_posts()) : $hero->the_post(); ?>
        <article>
          <a href=<?php the_permalink(); ?>>
            <span class="image"><?php the_post_thumbnail('large'); ?></span>
            <div>
              <span class="categories"><?php the_post_terms(); ?></span>
              <header>
                <h3 class="headline"><?php the_title(); ?></h3>
                <p class="lede"><?php the_excerpt(); ?></p>
              </header>
              <button class="left"><?php echo $article_CTA; ?></button>
            </div>
          </a>
        </article>
    <?php endwhile;
    endif;
    wp_reset_postdata(); ?>

    <section>
      <h2>News</h2>
      <div>
        <button></button>
        <div>
          <?php while ($the_query->have_posts()) : $the_query->the_post(); // TODO: make carousel
          ?>
            <article>
              <a href=<?php the_permalink(); ?>>
                <span class="image"><?php the_post_thumbnail('medium'); ?></span>
                <div>
                  <header>
                    <h3 class="headline"><?php the_title(); ?></h3>
                    <p class="lede"><?php the_excerpt(); ?></p>
                  </header>
                  <button class="left"><?php echo $article_CTA; ?></button>
                </div>
              </a>
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
    'post__not_in' => [$hero_ID],
    'category_name' => 'press'
  ];
  $the_query = new WP_Query($args);
  if ($the_query->have_posts()) :
  ?>
    <div>
      <h2>Press</h2>
      <section>
        <div>
          <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
            <article>
              <a href=<?php the_permalink(); ?>>
                <span class="image"><?php the_post_thumbnail('medium'); ?></span>
                <div>
                  <h3 class="headline"><?php the_title(); ?></h3>
                  <button class="left"><?php echo $article_CTA; ?></button>
                </div>
              </a>
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
          <a href=<?php the_permalink(); ?>>
            <span class="image"><?php the_post_thumbnail('large'); ?></span>
            <div>
              <span class="categories"><?php the_post_terms('tags'); ?></span>
              <h3 class="headline"><?php the_title(); ?></h3>
              <div>Watch <button></button><span></span><time></time></div>
            </div>
          </a>
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
            'terms'  => ['thoughtleadership'],
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
              <a href=<?php the_permalink(); ?>>
                <span class="image"><?php the_post_thumbnail('medium'); ?></span>
                <div>
                  <header>
                    <h3 class="headline"><?php the_title(); ?></h3>
                    <p class="lede"><?php the_excerpt(); ?></p>
                  </header>
                  <button class="left"><?php echo $article_CTA; ?></button>
                </div>
              </a>
            </article>
          <?php endwhile; ?>
        </div>
      <?php
      endif;
      wp_reset_postdata();
      ?>
    </section>
    <article>
      <!--
          <a href=<?php the_permalink(); ?>>
          <span class="image"><?php the_post_thumbnail('large'); ?></span>
        <div>
                  <span class="categories"><?php the_post_terms(); ?></span>
          <header>
            <h3 class="headline"><?php the_title(); ?></h3>
            <p class="lede"><?php the_excerpt(); ?></p>
          </header>
          <button class="inverted left"><?php echo $article_CTA; ?></button>
        </div>
      </a>
             -->
    </article>
  </div>
</main>
<?php get_footer(); ?>
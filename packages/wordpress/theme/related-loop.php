<?php
$_tags = get_the_terms( get_the_ID(), 'post_tag' );
foreach( $_tags as $tag ) {
  $tags[] = $tag->slug;
}

$_categories = get_the_terms( get_the_ID(), 'category' );
foreach( $_categories as $category ) {
  $categories[] = $category->slug;
}

$args = array(
    'post_type' => array('post', 'tribe_events'),
    'tax_query' => array(
    'relation'  => 'OR',
        // from events
        array(
            'taxonomy' => 'tribe_events_cat',
            'field'    => 'slug',
            'terms'    => $categories + $tags,
        ),
        // from posts and events
        array(
            'taxonomy' => 'post_tag',
            'field'    => 'slug',
            'terms'    => $tags,
        ),
        // from posts
        array(
            'taxonomy' => 'category',
            'field'    => 'slug',
            'terms'    => $categories,
        ),
    ),
    'post__not_in'  => array( get_the_ID() ),
);
$related = new WP_Query( $args ); 

if ( $related->have_posts() ) : while ( $related->have_posts() ) : $related->the_post(); ?>
  <article <?php post_class(); ?>>
    <a href="<?php the_permalink(); ?>">
      <?php the_post_thumbnail(); ?>
      <?php the_title(); ?>
      <?php the_excerpt(); ?>
    </a>
  </article>
<?php endwhile; endif; 
wp_reset_postquery();

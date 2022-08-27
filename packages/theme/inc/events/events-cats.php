<?php
// Add category functionality to events
add_filter( 'register_taxonomy_args', 'mtfmusicals_events_cats_args', 10, 2 );
function mtfmusicals_events_cats_args( $args, $taxonomy_name ) {
 
    if ( 'tribe_events_cat' === $taxonomy_name ) {
        $args['show_in_graphql'] = true;
        $args['graphql_single_name'] = 'category';
        $args['graphql_plural_name'] = 'categories';
    }
 
    return $args;
}

/**
 * Add capability to query events categories using where in Graph
 */
// Register events categories 'where' args
add_action('graphql_register_types', 'mtfmusicals_graph_events_cats');
function mtfmusicals_graph_events_cats() {

  // Registered post type in Graph (use PascalCase singular name)
  $post_type = "Event";

  register_graphql_field('RootQueryTo' . $post_type . 'ConnectionWhereArgs', 'category', [
      'type' => 'String',
      'description' => __('The category to filter by', 'mtfmusicals'),
  ]);
};

// Make events categories queryable by name
add_filter('graphql_post_object_connection_query_args', 'mtfmusicals_graph_where_events_cats', 10, 5);
function mtfmusicals_graph_where_events_cats($query_args, $source, $args, $context, $info) {

  $category = $args['where']['category'];

  if (isset($category)) {
      $query_args['tax_query'] = [
          [
            'taxonomy' => 'tribe_events_cat',
            'field'    => 'slug',
            'terms'    => $category,
          ]
      ];
  }

  return $query_args;
};
<?php
// Add category functionality to events
add_filter( 'register_taxonomy_args', function ( $args, $taxonomy ) {
 
  // Add attributes to taxonomy
  // TODO: Don't show at root
  if ( 'tribe_events_cat' === $taxonomy ) {
      $args['show_in_graphql'] = true;
      $args['graphql_single_name'] = 'event_category';
      $args['graphql_plural_name'] = 'event_categories';
  }

  return $args;

}, 10, 2 );


/**
 * Add capability to query events categories using where in Graph
 */
// Register events categories 'where' args
add_action('graphql_register_types', function () {

  // Registered post type in Graph (use PascalCase singular name)
  $GraphQLType = "Event";

  register_graphql_field('RootQueryTo' . $GraphQLType . 'ConnectionWhereArgs', 'event_category', [
      'type' => 'String',
      'description' => __('The category to filter by', 'mtfmusicals'),
  ]);

});

// Make events categories queryable by name
add_filter('graphql_post_object_connection_query_args', function ($query_args, $source, $args, $context, $info) {

  $category = $args['where']['event_category'];

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

}, 10, 5);
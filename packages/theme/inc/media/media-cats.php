<?php
// Add category functionality to medias
// TODO: Don't show at root
add_action( 'init', function () {
  $labels = array(
      'name'              => 'Media Categories',
      'singular_name'     => 'Media Category',
      'search_items'      => 'Search Media Categories',
      'all_items'         => 'All Media Categories',
      'parent_item'       => 'Parent Media Category',
      'parent_item_colon' => 'Parent Media Category:',
      'edit_item'         => 'Edit Media Category',
      'update_item'       => 'Update Media Category',
      'add_new_item'      => 'Add New Media Category',
      'new_item_name'     => 'New Media Category Name',
      'menu_name'         => 'Media Category',
  );

  $args = array(
      'labels' => $labels,
      'hierarchical' => true,
      'query_var' => 'true',
      'rewrite' => 'true',
      'show_admin_column' => 'true',
      'show_in_graphql' => true,
      'graphql_single_name' => 'MediaCategory',
      'graphql_plural_name' => 'MediaCategories',  
  );

  register_taxonomy( 'media_cats', 'attachment', $args );
});


/**
 * Add capability to query media categories using where in Graph
 */
// Register media categories 'where' args
add_action('graphql_register_types', function () {

  // Registered post type in Graph (use PascalCase singular name)
  $GraphQLType = "MediaItem";

  register_graphql_field('RootQueryTo' . $GraphQLType . 'ConnectionWhereArgs', 'mediaCategory', [
      'type' => 'String',
      'description' => __('The category to filter by.', 'mtfmusicals'),
  ]);
});

// Make media categories queryable by name
add_filter('graphql_post_object_connection_query_args', function ($query_args, $source, $args, $context, $info) {

  $category = $args['where']['mediaCategory'];

  if (isset($category)) {
      $query_args['tax_query'] = [
          [
            'taxonomy' => 'media_cats',
            'field'    => 'slug',
            'terms'    => $category,
          ]
      ];
  }

  return $query_args;
}, 10, 5);
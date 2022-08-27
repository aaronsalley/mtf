<?php
// Add category functionality to medias
add_action( 'init', 'mtfmusicals_add_attachment_cats_taxonomy' );
function mtfmusicals_add_attachment_cats_taxonomy() {
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
      'graphql_single_name' => 'category',
      'graphql_plural_name' => 'categories',  
  );

  register_taxonomy( 'media_cats', 'attachment', $args );
}

/**
 * Add capability to query media categories using where in Graph
 */
// Register media categories 'where' args
add_action('graphql_register_types', 'mtfmusicals_graph_media_cats');
function mtfmusicals_graph_media_cats() {

  // Registered post type in Graph (use PascalCase singular name)
  $post_type = "MediaItem";

  register_graphql_field('RootQueryTo' . $post_type . 'ConnectionWhereArgs', 'category', [
      'type' => 'String',
      'description' => __('The category to filter by', 'mtfmusicals'),
  ]);
};

// Make media categories queryable by name
add_filter('graphql_post_object_connection_query_args', 'mtfmusicals_graph_where_media_cats', 10, 5);
function mtfmusicals_graph_where_media_cats($query_args, $source, $args, $context, $info) {

  $category = $args['where']['category'];

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
};
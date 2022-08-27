<?php
// Add tag functionality to medias
add_action( 'init', 'mtfmusicals_add_attachment_tags_taxonomy' );
function mtfmusicals_add_attachment_tags_taxonomy() {
  $labels = array(
      'name'              => 'Tags',
      'singular_name'     => 'Tag',
      'search_items'      => 'Search Tags',
      'all_items'         => 'All Tags',
      'parent_item'       => 'Parent Tag',
      'parent_item_colon' => 'Parent Tag:',
      'edit_item'         => 'Edit Tag',
      'update_item'       => 'Update Tag',
      'add_new_item'      => 'Add New Tag',
      'new_item_name'     => 'New Tag Name',
      'menu_name'         => 'Tag',
  );

  $args = array(
      'labels' => $labels,
      'hierarchical' => false,
      'query_var' => 'true',
      'rewrite' => 'true',
      'show_admin_column' => 'true',
      'show_in_graphql' => true,
      'graphql_single_name' => 'tag',
      'graphql_plural_name' => 'tags',  
);

  register_taxonomy( 'media_tags', 'attachment', $args );
}

/**
 * Add capability to query media categories using where in Graph
 */
// Register media categories 'where' args
add_action('graphql_register_types', 'mtfmusicals_graph_media_tags');
function mtfmusicals_graph_media_tags() {

  // Registered post type in Graph (use PascalCase singular name)
  $post_type = "MediaItem";

  register_graphql_field('RootQueryTo' . $post_type . 'ConnectionWhereArgs', 'tag', [
      'type' => 'String',
      'description' => __('The tag to filter by', 'mtfmusicals'),
  ]);
};

// Make media categories queryable by name
add_filter('graphql_post_object_connection_query_args', 'mtfmusicals_graph_where_media_tags', 10, 5);
function mtfmusicals_graph_where_media_tags($query_args, $source, $args, $context, $info) {

  $tag = $args['where']['tag'];

  if (isset($tag)) {
      $query_args['tax_query'] = [
          [
            'taxonomy' => 'media_tags',
            'field'    => 'slug',
            'terms'    => $tag,
          ]
      ];
  }

  return $query_args;
};
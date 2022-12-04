<?php

namespace MTF_Musicals;

class Media extends \MTF_Musicals
{
  function __construct()
  {
    add_filter('bulk_actions-upload', [$this, 'media_bulk_edit']);
    add_filter('handle_bulk_actions-upload', [$this, 'handle_bulk_media_update'], 10, 3);
    add_action('admin_notices', [$this, 'confirm_bulk_media_update_success']);
    add_action('init', [$this, 'register_media_categories']);
    add_action('graphql_register_types', [$this, 'media_categories_root_query']);
    add_filter('graphql_post_object_connection_query_args', [$this, 'query_media_by_categories'], 10, 5);
    add_action('init', [$this, 'register_media_tags']);
    add_action('graphql_register_types', [$this, 'media_tags_root_query']);
    add_filter('graphql_post_object_connection_query_args', [$this, 'query_media_by_tags'], 10, 5);
  }

  function media_bulk_edit($bulk_actions)
  {
    $bulk_actions['edit'] = __('Edit', self::$DOMAIN);
    return $bulk_actions;
  }

  function handle_bulk_media_update($redirect_url, $action, $post_ids)
  {
    if ($action == 'edit') {
      $redirect_url = add_query_arg('edit', count($post_ids), $redirect_url);

      foreach ($post_ids as $post_id) {
        // TODO: update all changed fields
        wp_update_post([
          'ID' => $post_id,
        ]);
      }
    }
    return $redirect_url;
  }

  function confirm_bulk_media_update_success()
  {
    if (!empty($_REQUEST['edit'])) {
      $num_changed = (int) $_REQUEST['edit'];
      printf('<div id="message" class="updated notice is-dismissable"><p>' . __('Updated %d posts.', self::$DOMAIN) . '</p></div>', $num_changed);
    }
  }

  // Add category functionality to medias // TODO: Don't show at root
  function register_media_categories()
  {
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

    register_taxonomy('media_cats', 'attachment', $args);
  }

  /**
   * Add capability to query media categories using where in Graph
   */
  // Register media categories 'where' args
  function media_categories_root_query()
  {

    // Registered post type in Graph (use PascalCase singular name)
    $GraphQLType = "MediaItem";

    register_graphql_field('RootQueryTo' . $GraphQLType . 'ConnectionWhereArgs', 'mediaCategory', [
      'type' => 'String',
      'description' => __('The category to filter by.', 'mtfmusicals'),
    ]);
  }

  // Make media categories queryable by name
  function query_media_by_categories($query_args, $source, $args, $context, $info)
  {

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
  }
  // Add tag functionality to medias // TODO: Don't show at root
  function register_media_tags()
  {

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
      'graphql_single_name' => 'media_tag',
      'graphql_plural_name' => 'media_tags',
    );

    register_taxonomy('media_tags', 'attachment', $args);
  }

  /**
   * Add capability to query media tags using where in Graph
   */
  // Register media categories 'where' args
  function media_tags_root_query()
  {

    // Registered post type in Graph (use PascalCase singular name)
    $GraphQLType = "MediaItem";

    register_graphql_field('RootQueryTo' . $GraphQLType . 'ConnectionWhereArgs', 'media_tag', [
      'type' => 'String',
      'description' => __('The tag to filter by', 'mtfmusicals'),
    ]);
  }

  // Make media tags queryable by name
  function query_media_by_tags($query_args, $source, $args, $context, $info)
  {

    $tag = $args['where']['media_tag'];

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
  }
}

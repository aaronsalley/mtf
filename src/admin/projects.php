<?php
require_once( 'custom-post-types.php' );

// Create Projects post type
new custom_post_type( 'project', null, null, array(
  'menu_icon'	=> 'dashicons-image-filter',
      'hierarchical' => true,
      'has_archive' => false,
      'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'excerpt' )
) );

new custom_taxonomy( 'project_cat', 'project', 'categories', 'category', array(
  'labels'=> array(
    'name' => 'Project Categories',
    'menu_name' => 'Categories'
  ),
  'hierarchical' => true,
      'show_admin_column'  => true
) );
new custom_taxonomy( 'project_tag', 'project', 'tags', 'tag', array(
  'labels'=> array(
    'name' => 'Project Tags',
    'menu_name' => 'Tags'
  ),
      'show_admin_column'  => true
) );

function project_columns_head($defaults){
  $new = array();
  foreach($defaults as $key => $title) {
    if ($key=='title') // Put the Thumbnail column before the Author column
      $new['artwork'] = 'Show Artwork';
    $new[$key] = $title;
  }
  return $new;
}
function project_columns_content($column_name, $post_ID){
    if ($column_name == 'artwork') {
      $post_thumbnail_id = get_post_thumbnail_id($post_ID);
      if ($post_thumbnail_id) {
      echo wp_get_attachment_image($post_thumbnail_id, array(80,80));
      }
    }
}
add_filter('manage_project_posts_columns', 'project_columns_head');
add_action('manage_project_posts_custom_column', 'project_columns_content', 10, 2);

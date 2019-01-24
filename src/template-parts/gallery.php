<?php
$gallery = array();

$frontpage_id = get_option( 'page_on_front' );

$_content = get_page( $frontpage_id );
$_content = $_content->post_content;
$_content = parse_blocks( $_content );
foreach( $_content as $_block ) :
  if( $_block["blockName"]=="core/gallery" ) :
    $_gallery = $_block["attrs"]["ids"];

    foreach( $_gallery as $image ) {
      $image = wp_get_attachment_image( $image );
      $gallery[] = "<figure class='post'>$image</figure>";
    }

  endif;
endforeach;

echo $gallery = '<div class="gallery"><div class="wrap">' . implode($gallery) . '</div></div>'; ?>

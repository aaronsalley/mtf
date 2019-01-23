<?php
for($i = 0; $i < 100; $i++) {
  $gallery[] = '<figure class="post">
    <img src="#" />
  </figure>';
}

$frontpage_id = get_option( 'page_on_front' );

if ( get_post_gallery($frontpage_id) ) :
  $_gallery = get_post_gallery( $frontpage_id, false );
  $gallery = array();
  /* Loop through all the image and output them one by one */
  foreach( $_gallery['src'] as $src ) :
    $gallery[] = '<figure class="post">
      <img src="' . $src . '" alt="Gallery image" />
    </figure>';
  endforeach;
endif;

echo $gallery = '<div class="gallery"><div class="wrap">' . implode($gallery) . '</div></div>'; ?>

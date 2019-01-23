<?php
for($i = 0; $i < 100; $i++) {
  $gallery[] = '<figure class="post">
    <img src="#" />
  </figure>';
}

if ( get_post_gallery() ) :
  $_gallery = get_post_gallery( get_the_ID(), false );
  $gallery = array();
  /* Loop through all the image and output them one by one */
  foreach( $_gallery['src'] as $src ) :
    $gallery[] = '<figure class="post">
      <img src="' . $src . '" alt="Gallery image" />
    </figure>';
  endforeach;
endif;

echo $gallery = '<div class="gallery wall"><div class="wrap">' . implode($gallery) . '</div></div>'; ?>

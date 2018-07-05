<?php
	global $post;
	
	if ( is_archive() ) {
		$label = get_queried_object()->labels->singular_name;
		$menu_id = strtolower( str_replace(' ', '_', $label) );
	} elseif ( $post->post_name !=='' ) {
		$menu_id = $post->post_name;
	} else {
		$menu_id = 'profile';
	}

	$menu_id = $menu_id . '-pages';

	$menu_items = json_decode( 
		json_encode( 
			array( 
				array('title'=>'All', 'link'=>'#'), 
				array('title'=>'Current', 'link'=>'#'), 
				array('title'=>'Past', 'link'=>'#'),
			)
		)
	, FALSE);

    if( !empty( $menu_items ) ) {
        $sibling_pages = "";
        foreach( $menu_items as $menu_item ) {
	        $classes = implode( ' ', array('page-item', ''));
        	$sibling_pages .= "<li class={$classes}><a href={$menu_item->link}>{$menu_item->title}</a></li>";
        }
    }
    
    if ( !empty( $sibling_pages )) {
	    echo "<menu id='{$menu_id}'><ul class='menu'>{$sibling_pages}</ul></menu>";
	}
?>
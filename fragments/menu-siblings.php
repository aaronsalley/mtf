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
    $section_id = empty( $post->ancestors ) ? $post->ID : end( $post->ancestors );
    $locations = get_nav_menu_locations();
    $menu = wp_get_nav_menu_object( $locations[ 'main' ] );
	$section_id = wp_get_nav_menu_items( $menu->term_id, array(
	   'posts_per_page' => -1,
	   'meta_key' => '_menu_item_object_id',
	   'meta_value' => $section_id // the currently displayed post
	));
	$section_id = $section_id[0]->ID;
    $menu_items = wp_get_nav_menu_items( $menu->term_id, array( 
    	'numberposts' => -1
    ) );
    
    if( !empty( $menu_items ) ) {
	    $sibling_pages = '';
	    
        foreach( $menu_items as $menu_item ) {
	        $classes = implode( ' ', array('page-item', ''));
	        if ( $menu_item->menu_item_parent == $section_id || $menu_item->ID == $section_id )
            	$sibling_pages .= "<li class={$classes}><a href='" . $menu_item->url . "'>" . $menu_item->title . "</a></li>";
        }
    }
    
    if ( !empty( $sibling_pages )) {
	    echo "<menu id='{$menu_id}'><ul class='menu'>{$sibling_pages}</ul></menu>";
	}
?>	

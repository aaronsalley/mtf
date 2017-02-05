<?php get_header(); ?>
<?php
	$menu_class = $post->post_name . '-pages';
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

	//print_r($menu_items);

    if( !empty( $menu_items ) ) {
        $sibling_pages = "<menu class='{$menu_class}'><ul class='menu'>";
        foreach( $menu_items as $menu_item ) {
	        $classes = implode( ' ', array('page-item', ''));
	        if ( $menu_item->menu_item_parent == $section_id || $menu_item->ID == $section_id )
            	$sibling_pages .= "<li class={$classes}><a href='" . $menu_item->url . "'>" . $menu_item->title . "</a></li>";
        }
        $sibling_pages .= '</ul></menu>';
    }
?>	
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<header class="header">
		<div class="background" style="background-image:url(<?php the_post_thumbnail_url(); ?>)"></div>
		<h1 class="title"><?php the_title(); ?></h1>
	</header>
	<?php echo $sibling_pages; ?>
	<div class="content">
		<?php the_content(); ?>
	</div>
	<aside class="sidebar">
		<?php dynamic_sidebar(); ?>
	</aside>
	<footer class="footer">
	</footer>
	<?php echo $sibling_pages; ?>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
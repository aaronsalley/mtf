<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body id="perspective" <?php body_class( 'site' ); ?>>
	<header class="header">
		<menu class="action">
			<?php 
/*
			wp_nav_menu( array(
				'container'			=> '',
				'container_class'	=> 'action',
				'theme_location'	=> 'action'
			)); 
*/
			?>
		</menu>
		<button class="menu-icon" type="button" data-toggle="offCanvas"></button>
		<?php the_custom_logo(); ?>		
		<?php wp_nav_menu( array(
			'container'			=> 'nav',
			'container_class'	=> 'site-nav outer-nav',
			'theme_location'	=> 'main'
		)); ?>
	</header>

	<?php 
		if ( is_archive() ) {
			$label = get_queried_object()->labels->name;
			$id = strtolower( str_replace(' ', '_', $label) );
		} elseif ( $post->post_name !=='' ) {
			$id = $post->post_name;
		} else {
			$id = 'profile';
		}
	?>
	<div id="<?php echo $id; ?>" class="content">
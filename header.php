<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class( 'site' ); ?>>
	<header class="header">
		<a href="" class="mtf-logo"><?php the_custom_logo(); ?></a>
		<menu class="user">
			<span><?php echo 'Welcome back, {{$user name}}!'; ?></span>
			<?php wp_nav_menu( array(
				'container'			=> '',
				'container_class'	=> 'user',
				'theme_location'	=> 'action'
			)); ?>
		</menu>
		<?php wp_nav_menu( array(
			'container'			=> 'nav',
			'container_class'	=> 'site-nav',
			'theme_location'	=> 'main'
		)); ?>
	</header>
	
	<div class="content">
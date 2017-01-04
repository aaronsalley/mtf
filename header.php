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
		<div class="branding">
			<a href="" class="mtf-logo"><?php the_custom_logo(); ?></a>
		</div>
		<nav class="navigation">
			<menu class="user">
				<?php if( is_user_logged_in() ) {
					$user = wp_get_current_user();
					
					echo "<span>Welcome back, {$user->display_name}!</span>";
				} else {
					echo _e( 'Sign up or log in!', 'mtf' );
				} ?>
				<?php wp_nav_menu( array(
					'container'			=> '',
					'container_class'	=> 'user',
					'theme_location'	=> 'action'
				)); ?>
			</menu>
			<?php wp_nav_menu( array(
				'container'			=> 'nav',
				'container_class'	=> 'site',
				'theme_location'	=> 'main'
			)); ?>
		</nav>
	</header>
	
	<div class="content">
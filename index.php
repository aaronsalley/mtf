<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
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
		<section class="">
			<article class="tab">
				<h2 class="lead">{{lead text}}</h2>
			</article>
		</section>
		
		<section class="events">
			<?php 
				$events = new WP_Query( array(
					'post_type'		=> 'tribe_events',
					'eventDisplay'	=> 'custom',
				));

			if( $events->have_posts() ) : while( $events->have_posts() ) : $events->the_post();
			$class = implode( ' ', str_replace( 'tribe_events', 'event', get_post_class()));
			?>
			<article class="<?php echo $class; ?>">
				<div class="image">{{event image}}</div>
				<p><span class="date">{{event date}}</span> @ <span class="time">{{event time}}</span></p>
				<h2 class="title"><?php the_title(); ?></h2>
			</article>
			<?php 
				endwhile; endif; wp_reset_postdata();
			?>
		</section>
		
		<section class="blog">
			<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
			<article <?php post_class(); ?>>
				<header class="header">
					<h2 class="title"><?php the_title(); ?></h2>
					<p class="categories"><?php the_terms( $post->ID, 'category' ); ?></p>
				</header>
				<?php the_content(); ?>
				<footer><span class="related"><?php the_terms( $post->ID, 'post_tag', '', ',', ' | ' ); ?></span><span class="date"><?php the_date(); ?></span></footer>
			</article>
			<?php endwhile; endif; ?>
		</section>
		
		<section class="">
			<my-app>Loading AppComponent content here ...</my-app>
		</section>
		
		<section class="">
		</section>

		<section class="gallery">
		</section>

		<section class="">
		</section>
		
	</div>
	
	<footer class="footer">
		<?php wp_nav_menu( array(
			'container'			=> 'nav',
			'container_class'	=> 'site-nav',
			'theme_location'	=> 'main'
		)); ?>
	</footer>
</body>

</html>

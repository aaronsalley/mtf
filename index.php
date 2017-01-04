<?php get_header(); ?>
<section id="mission">
	<?php 
		$mission = new WP_Query( array(
			'post_type'		=> 'page'
		)); 

	if ( $mission->have_posts() ) : $i = 1 ; while( $mission->have_posts() ) : $mission->the_post();
	?>
	<article <?php post_class( $i == 1 ? 'is-active' : '' ); ?>>
		<a class="lead" href="#"><h3><?php the_title(); ?></h3></a>
		<div class="excerpt"><?php the_excerpt(); ?></div>
	</article>
	<?php 
		$i++; endwhile; endif; wp_reset_postdata();
	?>
</section>

<section id="events">
	<h2 class="section-title"><?php echo _e('Upcoming Events', 'mtf'); ?></h2>
	<div class="carousel">
		<?php 
			$events = new WP_Query( array(
				'post_type'		=> 'tribe_events',
				'eventDisplay'	=> 'custom'
			));
	
		if( $events->have_posts() ) : while( $events->have_posts() ) : $events->the_post();
		$class = implode( ' ', str_replace( 'tribe_events', 'event', get_post_class() ));
		?>
		<article class="<?php echo $class; ?>">
			<div class="image"><img alt='{{event image}}' src=""/></div>
			<p><span class="date">{{event date}}</span> @ <span class="time">{{event time}}</span></p>
			<h3 class="title"><?php the_title(); ?></h3>
		</article>
		<?php 
			endwhile; endif; wp_reset_postdata();
		?>
	</div>
</section>

<section id="blog">
	<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
	<article <?php post_class(); ?>>
		<header class="header">
			<h3 class="title"><?php the_title(); ?></h3>
			<p class="categories"><?php the_terms( $post->ID, 'category' ); ?></p>
		</header>
		<?php the_content(); ?>
		<footer><span class="related"><?php the_terms( $post->ID, 'post_tag', '', ',', ' | ' ); ?></span><span class="date"><?php the_date(); ?></span></footer>
	</article>
	<?php endwhile; endif; ?>
</section>

<section id="support">
</section>

<section id="volunteer">
</section>

<section id="gallery">
</section>

<section id="">
</section>
<?php get_footer(); ?>
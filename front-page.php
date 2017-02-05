<?php get_header(); ?>
<section id="mission">
	<?php 
		$mission = new WP_Query( array(
			'post_type'		=> 'page',
			'post_parent'	=> get_page_by_path('about')->ID
		)); 

	if ( $mission->have_posts() ) : $i = 1 ; while( $mission->have_posts() ) : $mission->the_post(); ?>
	<article <?php post_class( $i == 1 ? 'is-active' : '' ); ?>>
		<div class="background" style="background-image:url(<?php the_post_thumbnail_url(); ?>)"></div>
		<a class="lead" href="#"><h3><?php the_title(); ?></h3></a>
		<div class="excerpt"><a href="<?php the_permalink(); ?>"><?php the_excerpt(); ?></a></div>
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
			$class = implode(' ', str_replace( 'tribe_events', 'event', get_post_class() ));
			$date = strtotime($post->EventStartDate);
			$this_date = date('D, M j', $date);
			$this_time = date('h:iA', $date);
		?>
		<article class="<?php echo $class; ?>">
			<a href="<?php the_permalink(); ?>">
				<div class="image"><img alt="<?php the_title(); ?>" src="<?php the_post_thumbnail_url( 'full' ); ?>"/></div>
				<h4 class="time"><?php echo $this_date; ?> @ <?php echo $this_time; ?></h4>
				<h3 class="title"><?php the_title(); ?></h3>
			</a>
		</article>
		<?php 
			endwhile; endif; wp_reset_postdata();
		?>
	</div>
</section>

<section id="blog">
	<?php 
		$blog = new WP_Query( array(
			'post_type' => 'post',
			'posts_per_page' => 3
		));

	if( $blog->have_posts() ) : while( $blog->have_posts() ) : $blog->the_post();
	?>
	<article <?php post_class(); ?>>
		<header class="header">
			<h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<h4 class="categories"><?php the_terms( $post->ID, 'category' ); ?></h4>
		</header>
		<?php the_excerpt(); ?>
		<footer><span class="related"><?php the_terms( $post->ID, 'post_tag', '', ',', ' | ' ); ?></span><span class="date"><?php the_date(); ?></span></footer>
	</article>
	<?php endwhile; endif; wp_reset_postdata(); ?>
</section>

<section id="support">
	<?php
		$support = new WP_Query( array(
			'pagename' => 'about/sponsorship'
		));
	
	if( $support->have_posts() ) : while( $support->have_posts() ) : $support->the_post(); ?>
	<article <?php post_class(); ?>>
		<h2 class="title"><?php the_title(); ?></h3>
		<?php the_excerpt(); ?>
	</article>
	<?php endwhile; endif; wp_reset_postdata(); ?>
</section>

<section id="volunteer">
	<?php
		$volunteer = new WP_Query( array(
			'pagename' => 'community/volunteer'
		));
	
	if( $volunteer->have_posts() ) : while( $volunteer->have_posts() ) : $volunteer->the_post(); ?>
	<article <?php post_class(); ?>>
		<h2 class="title"><?php the_title(); ?></h3>
		<?php the_excerpt(); ?>
	</article>
	<?php endwhile; endif; wp_reset_postdata(); ?>
</section>

<section id="gallery">
</section>

<section id="">
</section>

<?php get_footer(); ?>
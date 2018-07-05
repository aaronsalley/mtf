<?php get_header(); ?>
<section id="mission">
	<?php echo do_shortcode( '[accordion_slider id="1"]' ); ?>
</section>

<section id="events">
	<h2 class="section-title"><?php echo _e('Next at the Factory', 'mtf'); ?></h2>
	<div class="carousel">
		<?php
			$events = tribe_get_events( array(
				'eventDisplay' => 'upcoming',
//				'start_date' => current_time( 'timestamp', 0 )
			));
	
		foreach( $events as $event ) {			
			$class = implode(' ', str_replace( 'tribe_events', 'event', get_post_class( '', $event ) ));
			$date = strtotime($event->EventStartDate);
			$this_date = date('D, M j', $date);
			$this_time = date('h:iA', $date);
		?>
		<article class="<?php echo $class; ?>">
			<a href="<?php echo get_the_permalink($event); ?>">
				<div class="image"><img alt="<?php echo get_the_title($event); ?>" src="<?php echo get_the_post_thumbnail_url( $event, array(300,300) ); ?>"/></div>
				<h3 class="time"><?php echo $this_date; ?></h3>
				<h4 class="title"><?php echo get_the_title($event); ?></h4>
			</a>
		</article>
		<?php 
		}
		?>
	</div>
</section>

<section>
	<?php the_content(); ?>
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
			<h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
			<h5 class="categories"><?php the_terms( $post->ID, 'category' ); ?></h5>
		</header>
		<content class="excerpt">
			<?php the_excerpt(); ?>
		</content>
		<footer><span class="related"><?php the_terms( $post->ID, 'post_tag', '', ', ', ' | ' ); ?></span><span class="date"><?php the_date(); ?></span></footer>
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
		<a href="<?php the_permalink();?>">
			<h2 class="title"><?php the_title(); ?></h3>
			<content class="excerpt">
				<?php the_excerpt(); ?>
			</content>
		</a>
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
		<a href="<?php the_permalink();?>">
			<h2 class="title"><?php the_title(); ?></h3>
			<content class="excerpt">
				<?php the_excerpt(); ?>
			</content>
		</a>
	</article>
	<?php endwhile; endif; wp_reset_postdata(); ?>
</section>
<?php get_footer(); ?>
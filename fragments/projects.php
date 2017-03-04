<?php 
$projects = new WP_Query( array(
	'post_type' => 'project',
	'orderby' => 'title',
	'order' => ASC,
	'posts_per_page' => -1
));

if ( $projects->have_posts() ) : echo "<section class='projects'>"; while ( $projects->have_posts() ) : $projects->the_post(); ?>
	<article <?php post_class(); ?>>
		<a href="<?php the_permalink(); ?>">
			<div class="artwork"></div>
			<h3 class="title"><?php the_title(); ?></h3>
			<div class="summary"><?php the_excerpt(); ?></div>
		</a>
	</article>
<?php 
endwhile; echo "</section>"; endif; wp_reset_postdata();
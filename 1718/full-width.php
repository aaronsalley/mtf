<?php
	/*
		Template Name: Full Width
	*/
?>
<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<header class="header">
		<div class="background" style="background-image:url(<?php echo get_the_post_thumbnail_url(); ?>)"></div>
		<h1 class="title"><?php the_title(); ?></h1>
	</header>
	<?php get_template_part( 'partials/menu', 'siblings' ); ?>
	<content class="content full-width">
		<?php the_content(); ?>
	</content>
	<?php get_template_part( 'partials/' . $post->post_name ); ?>
	<footer class="footer">
		<?php get_template_part( 'partials/menu', 'siblings' ); ?>
	</footer>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<header class="header">
		<div class="background" style="background-image:url(<?php the_post_thumbnail_url(); ?>)"></div>
		<h1 class="title"><?php the_title(); ?></h1>
	</header>
	<div class="content">
		<?php the_content(); ?>
	</div>
	<footer class="footer">
	</footer>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
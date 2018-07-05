<?php get_header(); ?>
<article <?php post_class(); ?>>
	<p class="date"><?php the_date(); ?></p>
	<h2 class="title"><?php the_title(); ?></h2>
	<div class="content"><?php the_content(); ?></div>
</article>
<?php get_footer(); ?>
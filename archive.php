<?php get_header(); ?>
	<header class="header">
		<div class="background" style="background-image:url(<?php the_post_thumbnail_url(); ?>)"></div>
		<h1 class="title"><?php the_archive_title(); ?></h1>
	</header>
	<?php get_template_part( 'fragments/menu', 'siblings' ); ?>
	<content class="content">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<a href="<?php the_permalink(); ?>">
			<h2><?php the_title(); ?></h2>
			<div><?php the_excerpt(); ?></div>
		</a>
		<?php endwhile; endif; ?>
	</content>
	<?php get_template_part( 'fragments/' . $post->post_name ); ?>
	<aside class="sidebar">
		<?php dynamic_sidebar(); ?>
	</aside>
	<footer class="footer">
		<?php get_template_part( 'fragments/menu', 'siblings' ); ?>
	</footer>
<?php get_footer(); ?>
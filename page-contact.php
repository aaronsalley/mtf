<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<header class="header">
		<div class="background" style="background-image:url(<?php the_post_thumbnail_url(); ?>)"></div>
		<h1 class="title"><?php the_title(); ?></h1>
	</header>
	<div class="content">
		<?php the_content(); ?>
	</div>
	<?php foreach ( array( 'editor', 'board' ) as $directory ) { ?>
	<section class="members">
		<?php 
		$users = new WP_User_Query( array(
			'role'	=> $directory
		));
		?>
		<h2 class="role"><?php echo get_option( $wpdb->get_blog_prefix() . 'user_roles' )[$directory][name];?></h2>
		<?php if ( ! empty( $users->results ) ) : foreach ( $users->results as $user ) : ?>
		<article class="member">
			<a href="mailto:<?php echo $user->user_email;?>">
				<div class="headshot"><?php echo get_avatar($user->ID, '150'); ?></div>
				<h4 class="name"><?php echo $user->display_name; ?></h4>
				<h4 class="position"><?php echo 'Position'; ?></h4>
			</a>
		</article>
		<?php endforeach; endif; wp_reset_postdata(); ?>
	</section>
	<?php } ?>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
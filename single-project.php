<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<header class="header">
		<div class="background" style="background-image:url(<?php the_post_thumbnail_url(); ?>)"></div>
		<h1 class="title"><?php the_title(); ?></h1>
	</header>
	<?php get_template_part( 'fragments/menu', 'siblings' ); ?>
	<content class="content">
		<?php the_content(); ?>
	</content>
	<aside class="sidebar">
		<section id="members">
			<header class="header">
				<h2 class="title">Company</h2>
			</header>
		<?php $users = new WP_User_Query( array(
			'role__not_in'	=> 'subscriber',
			)); 
			$directory = array( $post->post_name );
			
			if ( ! empty( $users->results ) ) : foreach ( $users->results as $user ) :
			
			// Get attached projects from user
			$projects = get_user_meta( $user->ID, 'projects' );
			foreach ( $projects[0] as $project ) {
				if ( $project == $post->ID ) {
					$customer = $wpdb->get_row("SELECT c_id FROM " . $wpdb->prefix . "wc_crm_customer_list WHERE user_id = '{$user->ID}'");
					$this_user = new WC_CRM_Customer($customer->c_id);
					$peepso = new PeepSoUser($user->ID);
				?>
				<article class="member">
					<a href="<?php echo $peepso->get_profileurl(); ?>">
						<div class="headshot"><img class="avatar" src="<?php echo $peepso->get_avatar(true); ?>"/></div>
						<h5 class="name"><?php echo $this_user->name; ?></h5>
						<h5 class="role"><?php echo ''; ?></h5>
					</a>
				</article>
				<?
				}
			}
			endforeach; endif;
		?>
		</section>
		<section id="blog">
			<header class="header">
				<h2 class="title">Blog</h2>
			</header>
		<?php $blog = new WP_Query( array(
			'post_type' => 'post',
			'tax_query' => array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'post_tag',
					'field'    => 'slug',
					'terms'    => array( $post->post_name ),
				)
			)		
		));
			
			if( $blog->have_posts() ) : while( $blog->have_posts() ) : $blog->the_post(); ?>
			<article <?php post_class(); ?>>
				<header class="header">
					<h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
					<h5 class="categories"><?php the_terms( $post->ID, 'category' ); ?></h5>
				</header>
				<content class="excerpt">
					<?php the_excerpt(); ?>
				</content>
				<footer>
					<span class="date"><?php the_date(); ?></span>
				</footer>
			</article>
		<?php endwhile; endif; wp_reset_postdata(); ?>
		</section>
		<section id="related">
			<header class="header">
				<h2 class="title">Related Projects</h2>
			</header>
		</section>
		<?php dynamic_sidebar(); ?>
	</aside>
	<footer class="footer">
		<?php get_template_part( 'fragments/menu', 'siblings' ); ?>
	</footer>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
<?php
/*
$groups = get_terms( array(
	'taxonomy' => 'ctc_person_group'
));
*/

$groups = array(
	'administration',
	'mtfstaff',
	'board-of-directors',
	'advisory-board',
	'professional-consultants'
);

foreach ($groups as $group ){
// 	$group = $group->slug;
	
	$people = new WP_Query( array(
		'post_type' => 'ctc_person',
		'posts_per_page' => -1,
		'orderby' => 'title',
		'order' => ASC,
		'tax_query' => array(
			array(
				'taxonomy' => 'ctc_person_group',
				'field'    => 'slug',
				'terms'    => $group
			)
		)
	));
	
	if ( $people->have_posts() && in_array( $group, array('administration', 'mtfstaff') )) : ?> 
	<section id="<?php echo $group; ?>" class="members">
		<?php while ( $people->have_posts() ) : $people->the_post(); ?>
		<article class="member">
			<a href="mailto:<?php echo get_metadata('post', $post->ID, '_ctc_person_email', true); ?>">
				<div class="headshot"><?php echo wp_get_attachment_image( get_metadata('post', $post->ID, '_thumbnail_id', true), 'thumbnail', false, array('class'=>'avatar') ); ?></div>
				<h5 class="name"><?php the_title(); ?></h5>
				<h5 class="position"><?php echo get_metadata('post', $post->ID, '_ctc_person_position', true); ?></h5>
				<h5 class="contact"><?php echo get_metadata('post', $post->ID, '_ctc_person_email', true); ?></h5>
			</a>
		</article>
		<?php endwhile; ?>
	</section>
	<?php elseif( $people->have_posts() ) : ?>
	<section id="<?php echo $group; ?>" class="members">
		<h2><?php echo get_term_by('slug', $group, 'ctc_person_group')->name; ?></h2>
		<?php while ( $people->have_posts() ) : $people->the_post(); ?>
		<article class="member">
			<h4 class="name"><?php the_title(); ?></h4>
		</article>
		<?php endwhile; ?>
	</section>	
	<?php endif;
};
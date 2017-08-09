<?php 
$members = new WP_Query( array(
	'post_type' => 'ctc_person',
	'posts_per_page' => -1,
	'orderby' => 'title',
	'order' => ASC,
	'tax_query' => array(
		array(
			'taxonomy' => 'ctc_person_group',
			'field'    => 'slug',
			'terms'    => 'members'
		)
	)
));
if ( $members->have_posts() ) : ?> 
<section id="<?php echo 'members'; ?>" class="members">
	<?php while ( $members->have_posts() ) : $members->the_post(); ?>
	<article <?php echo post_class('member'); ?>>
		<div class="headshot"><?php echo wp_get_attachment_image( get_metadata('post', $post->ID, '_thumbnail_id', true), 'thumbnail', false, array('class'=>'avatar') ); ?></div>
		<h5 class="name"><?php the_title(); ?></h5>
	</article>
	<?php endwhile; ?>
</section>
<?php endif; ?>
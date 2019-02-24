<header class="header">
	<div class="masthead">
		<h2 class="title"><?php
		$categories = get_the_category();
		$title = get_the_title();
		
		if ( ! empty( $categories ) ) {
		    $title = esc_html( $categories[0]->name );
		}

		echo $title;
		?></h2>
		<a class="button" href="/donate" target="_blank"><?php esc_html_e('Support us'); ?></a>
	</div>
	<?php get_template_part('template-parts/gallery'); ?>
</header>

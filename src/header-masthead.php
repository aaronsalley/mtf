<header class="header">
	<div class="masthead">
		<h2 class="title"><?php the_title(); ?></h2>
		<button class="button"><?php esc_html_e('Support us'); ?></button>
	</div>
	<?php for($i = 0; $i < 10; $i++){
		$instagram[] = '<div class="post">
			<img class="image" src="#" />
		</div>';
	}
	echo $instagram = '<div id="instagram" class="feed"><div class="wrap">' . implode($instagram) . '</div></div>'; ?>
</header>

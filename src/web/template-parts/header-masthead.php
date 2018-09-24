<header class="header">
	<div class="masthead">
		<h2 class="title"><?php the_title(); ?></h2>
		<a class="button" href="https://ticketcentral.com/online/default.asp?doWork::WScontent::loadArticle=Load&BOparam::WScontent::loadArticle::article_id=A871863B-5CF9-463D-A054-A89187A9B231" target="_blank"><?php esc_html_e('Support us'); ?></a>
	</div>
	<?php for($i = 0; $i < 10; $i++){
		$instagram[] = '<div class="post">
			<img class="image" src="#" />
		</div>';
	}
	echo $instagram = '<div id="instagram" class="feed"><div class="wrap">' . implode($instagram) . '</div></div>'; ?>
</header>

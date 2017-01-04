	</div>
	
	<footer class="footer">
		<div class="container">
			<?php wp_nav_menu( array(
				'container'			=> 'nav',
				'container_class'	=> 'site-nav',
				'theme_location'	=> 'main'
			)); ?>
			<aside class="widgets">
				<?php dynamic_sidebar( 'footer-widgets' ); ?>
			</aside>
		</div>
	</footer>
	<?php wp_footer(); ?>
</body>

</html>

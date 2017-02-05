	</div>
	
	<footer id="footer">
		<div class="container">
			<?php wp_nav_menu( array(
				'container'			=> 'nav',
				'container_class'	=> 'site-nav',
				'theme_location'	=> 'main'
			)); ?>
			<aside class="widgets">
				<?php dynamic_sidebar( 'footer-widgets' ); ?>
			</aside>
			<img class="mtf-logo" src="<?php echo get_theme_file_uri() . '/src/img/MTF-Script-Red.png'; ?>" alt="MTF logo with script" />
		</div>
	</footer>
	<?php wp_footer(); ?>
</body>

</html>

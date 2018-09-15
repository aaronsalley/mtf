    <footer>
      <div class="wrap">
        <?php wp_nav_menu(array(
          'menu' => '',
          'menu_id' => 'top-nav',
          'container' => 'nav',
          'theme_location' => '',
        )); ?>
        <address>
          <form>
          </form>
          <a href="/legal"><?php esc_html_e('How do we use this information?', 'mtf'); ?></a>
          <p id="copyright">©<?php echo date('Y'); ?> Copyright Musical Theatre Factory. 440 Lafayette St., 4th Floor, New York, NY 10001. All Rights Reserved.</p>
        </address>
      </div>
    </footer>
    <?php wp_footer(); ?>
  </body>
</html>

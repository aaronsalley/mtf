    </main>
    <footer id="bottombar">
      <div class="wrap">
        <?php wp_nav_menu(array(
          'menu' => '',
          'menu_id' => 'top-nav',
          'container' => 'nav',
          'theme_location' => '',
        )); ?>
          <form id="mailchimp">
            <div class="input-group">
              <input class="input-group-field"
                type="email"
                name="email"
                placeholder="Join our mailing list">
              <div class="input-group-button">
                <button type="submit" class="button"><?php esc_html_e('Sign up'); ?></button>
              </div>
            </div>
            <a class="gdpr" href="/legal"><?php esc_html_e('How do we use this information?', 'mtf'); ?></a>
            <address class="address">
              <p id="copyright">© <?php echo date('Y'); ?> Musical Theatre Factory. 440 Lafayette St, 4th Floor, New York, NY 10003.</p>
            </address>
          </form>
      </div>
    </footer>
    <?php wp_footer(); ?>
  </body>
</html>
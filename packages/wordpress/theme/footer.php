    <footer class="Footer_container">
      <div class="devo">
        <a class="guidestar" href="https://www.guidestar.org/profile/47-1254076"></a>
        <a class="amazonsmile" href="https://smile.amazon.com/ch/47-1254076"></a>
        <p>
          Musical Theatre Factory, Inc. (EIN 47-1254076) is a registered
          501(c)(3) Public Charity incorporated in the State of New York. All
          donations are tax-deductible to the fullest extent under the law.
        </p>
        <?php get_template_part('components/molecules/form/form', 'email_subscribe'); ?>
      </div>
      <menu class="Menu_mega_container">
        <?php wp_nav_menu([
          'theme_location' => 'mega',
          'container' => null,
          'fallback_cb' => false
        ]); ?>
      </menu>
      <p class="copyright">
        The gear logo, MTF Makers™, MTFxR™, Assembly Line™, 4x15™, Research & Dramaturgy™ (R&D™), artistic practice incubator™, new development accelerator™, manifested imagination™, and all lines of programming are ™ and ©<?php echo date('Y'); ?>
        Musical Theatre Factory Inc. All Rights Reserved.
      </p>
    </footer>

    <?php wp_footer(); ?>
    </body>

    </html>
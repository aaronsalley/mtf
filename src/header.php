<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <header data-sticky-container>
      <div id="header-bar" class="sticky" data-sticky data-options="marginTop:0;" style="width:100%" data-sticky-on="small">
        <section class="title-bar" data-responsive-toggle="topbar">
          <div class="title-bar-title">
            <?php the_custom_logo(); ?>
          </div>
          <button id="toggler" class="menu-icon" type="button" data-toggle="topbar"></button>
        </section>
        <section id="topbar">
          <h1 class="branding">
            <a href=<?php echo home_url(); ?>>
              <?php bloginfo('name'); ?>
              <?php bloginfo('description'); ?>
              <?php the_custom_logo(); ?>
            </a>
          </h1>
          <menu class="social menu">
            <?php wp_nav_menu(array(
              'menu' => '',
              'menu_id' => 'social',
              'container' => null,
              'theme_location' => 'social',
              'items_wrap' => '%3$s',
            )); ?>
            <a class="donate button" href="/donate" target="_blank"><?php esc_html_e('Donate'); ?></a>
          </menu>
          <?php wp_nav_menu(array(
            'menu' => '',
            'menu_id' => 'main-nav',
            'container' => 'nav',
            'container_class' => 'main menu',
            'theme_location' => 'primary',
          )); ?>
        </section>
      </div>
    </header>
    <main id="wp_main">

<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <header id="topbar">
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
        <button class="donate button"><?php esc_html_e('Donate'); ?></button>
      </menu>
      <?php wp_nav_menu(array(
        'menu' => '',
        'menu_id' => 'main-nav',
        'container' => 'nav',
        'container_class' => 'main menu',
        'theme_location' => 'primary',
      )); ?>
    </header>
    <main id="app">

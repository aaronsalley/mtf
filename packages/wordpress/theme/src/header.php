<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="manifest" id="manifest">
    <?php wp_head(); ?>
  </head>
  <body id="app" <?php body_class(); ?>>
    <header id="topbar" class="header">
      <div class="container">
        <div class="branding">
          <?php the_custom_logo(); ?>
        </div>
        <?php wp_nav_menu( array(
          'theme_location'  =>  'menu-2',
          'container'       =>  '',
        )); ?>
        <button class="menu-icon" type="button" data-toggle="sidenav"></button>
      </div>
    </header>
    <div id="content" class="container">
      <?php get_sidebar(); ?>
      <div id="main" class="main">

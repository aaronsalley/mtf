<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
  </head>
  <body>
    <header>
      <h1 class="branding">
        <?php bloginfo('name'); ?>
        <?php bloginfo('description'); ?>
        <?php the_custom_logo(); ?>
      </h1>
      <menu class="social-menu">
        <?php wp_nav_menu(array(
          'menu' => '',
          'menu_id' => 'social',
          'container' => null,
          'theme_location' => '',
          'items_wrap' => '%3$s',
        )); ?>
      </menu>
      <?php get_template_part('templates/nav', 'logged_in'); ?>
    </header>

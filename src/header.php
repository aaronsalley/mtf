<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class('app'); ?>>
    <header id="header">
      <h1 class="branding">
        <?php bloginfo('name'); ?>
        <?php bloginfo('description'); ?>
        <button class="menu-icon" type="button" data-open="navDrawer"></button>
        <?php the_custom_logo(); ?>
      </h1>
      <menu class="menu">
        <?php wp_nav_menu(array(
          'menu' => '',
          'menu_id' => 'action',
          'container' => null,
          'theme_location' => 'action',
          'items_wrap' => '%3$s',
        )); ?>
      </menu>
    </header>
    <div id="main">
      <?php get_template_part('template-parts/navigation', 'drawer'); ?>
      <div id="content">

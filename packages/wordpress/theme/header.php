<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class('app'); ?>>
    <header class="header">
      <div class="container">
        <div class="logo">
          <?php the_custom_logo(); ?>
        </div>
        <?php wp_nav_menu( array(
          'theme_location'  =>  'menu-2',
          'container'       =>  '',
        )); ?>
      </div>
    </header>
    <div class="main">
      <?php get_sidebar(); ?>
      <section class="content">

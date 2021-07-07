<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <link rel="profile" href="http://gmpg.org/xfn/11">

        <link rel='manifest' href='/manifest.json' />
        <link rel='apple-touch-icon' href='/apple-icon.png'></link>
        <meta name='theme-color' content='#3f9a59' />
        <link rel='icon' href='/favicon.ico' />
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <?php
    // Elementor `header` location
    if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {
      get_template_part( 'template-parts/header' );
    }

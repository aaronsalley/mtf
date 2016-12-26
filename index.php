<html>
  <head>
    <title>Angular QuickStart JS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- 1. Load libraries -->
    <!-- IE required polyfill -->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/node_modules/core-js/client/shim.min.js"></script>

    <script src="<?php echo get_stylesheet_directory_uri(); ?>/node_modules/zone.js/dist/zone.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/node_modules/reflect-metadata/Reflect.js"></script>

    <script src="<?php echo get_stylesheet_directory_uri(); ?>/node_modules/rxjs/bundles/Rx.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/node_modules/@angular/core/bundles/core.umd.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/node_modules/@angular/common/bundles/common.umd.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/node_modules/@angular/compiler/bundles/compiler.umd.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/node_modules/@angular/platform-browser/bundles/platform-browser.umd.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/node_modules/@angular/platform-browser-dynamic/bundles/platform-browser-dynamic.umd.js"></script>

    <!-- 2. Load our 'modules' -->
    <script src='<?php echo get_stylesheet_directory_uri(); ?>/app/app.component.js'></script>
    <script src='<?php echo get_stylesheet_directory_uri(); ?>/app/app.module.js'></script>
    <script src='<?php echo get_stylesheet_directory_uri(); ?>/app/main.js'></script>

  </head>

  <!-- 3. Display the application -->
  <body>
    <my-app>Loading...</my-app>
  </body>

</html>

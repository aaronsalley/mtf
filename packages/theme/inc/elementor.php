<?php
add_action( 'elementor/theme/register_locations', function ( $elementor_theme_manager ) {

  $elementor_theme_manager->register_all_core_location();
  
  });


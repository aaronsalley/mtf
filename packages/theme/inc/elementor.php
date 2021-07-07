<?php
function theme_prefix_register_elementor_locations( $elementor_theme_manager ) {

$elementor_theme_manager->register_all_core_location();

}
add_action( 'elementor/theme/register_locations', 'theme_prefix_register_elementor_locations' );

<?php
add_action( 'elementor/theme/register_locations', 'mtfmusicals_register_elementor_locations' );
function mtfmusicals_register_elementor_locations( $elementor_theme_manager ) {

$elementor_theme_manager->register_all_core_location();

}

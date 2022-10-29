<?php
/**
 * Add Tribe Events to Graph.
 */
add_filter( 'register_post_type_args', function ( $args, $post_type ) {
 
    if ( 'tribe_events' === $post_type ) {
        $args['show_in_graphql'] = true;
        $args['graphql_single_name'] = 'event';
        $args['graphql_plural_name'] = 'events';
    }
 
    return $args;
}, 10, 2 );

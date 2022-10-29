<?php

add_action( 'graphql_register_types', function() {
  // Adds event start datetime
  register_graphql_field( 'Event', 'datetimeStart', [
    'type' => 'String',
    'description' => __( 'The cost of the food item', 'mtfmusicals' ),
    'resolve' => function( $event ) {

      if( 'WP_ENVIRONMENT_TYPE' !== 'production' ){
        logger( get_post_custom_keys($event -> databaseId) );
      }

      return get_post_meta( $event -> databaseId, '_EventStartDateUTC', true );
    }
  ] );

  // Adds event end datetime
  register_graphql_field( 'Event', 'datetimeEnd', [
    'type' => 'String',
    'description' => __( 'The cost of the food item', 'mtfmusicals' ),
    'resolve' => function( $event ) {
      return get_post_meta( $event -> databaseId, '_EventEndDateUTC', true );
    }
  ] );

  // TODO: Adds event location
  // register_graphql_field( 'Event', 'location', [
  //   'type' => 'String',
  //   'description' => __( 'The cost of the food item', 'mtfmusicals' ),
  //   'resolve' => function( $event ) {
  //     return get_post_meta( $event -> databaseId, '_EventEndDateUTC', true );
  //   }
  // ] );

  register_graphql_field( 'Event', 'isAllDay', [
    'type' => 'Boolean',
    'description' => __( 'The cost of the food item', 'mtfmusicals' ),
    'resolve' => function( $event ) {
      return get_post_meta( $event -> databaseId, '_EventAllDay', true );
    }
  ] );

  // Adds event price
  register_graphql_field( 'Event', 'ticketPrice', [
    'type' => 'String',
    'description' => __( 'The cost of the food item', 'mtfmusicals' ),
    'resolve' => function( $event ) {
      return get_post_meta( $event -> databaseId, '_EventCost', true );
    }
  ] );

  // Adds event ticket link
  register_graphql_field( 'Event', 'eventURL', [
    'type' => 'String',
    'description' => __( 'The cost of the food item', 'mtfmusicals' ),
    'resolve' => function( $event ) {
      return get_post_meta( $event -> databaseId, '_EventURL', true );
    }
  ] );
} );

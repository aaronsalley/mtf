<?php

namespace MTF_Musicals;

class Events extends \MTF_Musicals
{

  private static $EVENT_CATEGORY = 'event_category';

  function __construct()
  {
    add_filter('register_post_type_args', [$this, 'show_events_in_graph'], 10, 2);
    add_action('graphql_register_types', [$this, 'register_events_fields']);
    add_filter('register_taxonomy_args', [$this, 'register_events_categories'], 10, 2);
    add_action('graphql_register_types', [$this, 'event_categories_root_query']);
    add_filter('graphql_post_object_connection_query_args', [$this, 'query_events_by_categories'], 10, 5);
  }

  function show_events_in_graph($args, $post_type)
  {

    if ('tribe_events' === $post_type) {
      $args['show_in_graphql'] = true;
      $args['graphql_single_name'] = 'event';
      $args['graphql_plural_name'] = 'events';
    }

    return $args;
  }

  function register_events_fields()
  {
    // Adds event start datetime
    register_graphql_field('Event', 'datetimeStart', [
      'type' => 'String',
      'description' => __('The cost of the food item', self::$DOMAIN),
      'resolve' => function ($event) {

        if ('WP_ENVIRONMENT_TYPE' !== 'production') {
          $this::logger(get_post_custom_keys($event->databaseId));
        }

        return get_post_meta($event->databaseId, '_EventStartDateUTC', true);
      }
    ]);

    // Adds event end datetime
    register_graphql_field('Event', 'datetimeEnd', [
      'type' => 'String',
      'description' => __('The cost of the food item', self::$DOMAIN),
      'resolve' => function ($event) {
        return get_post_meta($event->databaseId, '_EventEndDateUTC', true);
      }
    ]);

    // Adds event location title
    register_graphql_field('Event', 'locationName', [
      'type' => 'String',
      'description' => __('The cost of the food item', self::$DOMAIN),
      'resolve' => function ($event) {

        $venue_id = get_post_meta($event->databaseId, '_EventVenueID', true);
        if ($venue_id === "") return null;

        $post = get_post($venue_id);

        if ('WP_ENVIRONMENT_TYPE' !== 'production') {
          $this::logger($venue_id);
        }

        return $post->post_title;
      }
    ]);

    register_graphql_field('Event', 'isAllDay', [
      'type' => 'Boolean',
      'description' => __('The cost of the food item', self::$DOMAIN),
      'resolve' => function ($event) {
        return get_post_meta($event->databaseId, '_EventAllDay', true);
      }
    ]);

    // Adds event price
    register_graphql_field('Event', 'ticketPrice', [
      'type' => 'String',
      'description' => __('The cost of the food item', self::$DOMAIN),
      'resolve' => function ($event) {
        return get_post_meta($event->databaseId, '_EventCost', true);
      }
    ]);

    // Adds event ticket link
    register_graphql_field('Event', 'eventURL', [
      'type' => 'String',
      'description' => __('The cost of the food item', self::$DOMAIN),
      'resolve' => function ($event) {
        return get_post_meta($event->databaseId, '_EventURL', true);
      }
    ]);
  }

  function register_events_categories($args, $taxonomy)
  {

    // Add attributes to taxonomy
    // TODO: Don't show at root
    if ('tribe_events_cat' === $taxonomy) {
      $args['show_in_graphql'] = true;
      $args['graphql_single_name'] = self::$EVENT_CATEGORY;
      $args['graphql_plural_name'] = 'event_categories';
    }

    return $args;
  }

  // Register events categories 'where' args
  function event_categories_root_query()
  {

    // Registered post type in Graph (use PascalCase singular name)
    $GraphQLType = "Event";

    register_graphql_field('RootQueryTo' . $GraphQLType . 'ConnectionWhereArgs', self::$EVENT_CATEGORY, [
      'type' => 'String',
      'description' => __('The category to filter by', self::$DOMAIN),
    ]);
  }

  // Make events categories queryable by name
  function query_events_by_categories($query_args, $source, $args, $context, $info)
  {

    $category = $args['where'][self::$EVENT_CATEGORY];

    if (isset($category)) {
      $query_args['tax_query'] = [
        [
          'taxonomy' => 'tribe_events_cat',
          'field'    => 'slug',
          'terms'    => $category,
        ]
      ];
    }

    return $query_args;
  }

  public static function dates()
  {
    return tribe_get_start_date($display_time = false) === tribe_get_end_date($display_time = false) ?
      tribe_get_start_date() : tribe_get_start_date() . " - " . tribe_get_end_date();
  }
}

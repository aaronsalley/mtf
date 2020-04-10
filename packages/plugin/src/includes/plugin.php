<?php
namespace MISSION_CONTROL;

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

class Mission_Control {
  public static $instance = null;

  public static function getInstance() {
    if ( !self::$instance )
      self::$instance = new self;
    return self::$instance;
  }

  function textdomain() {
    load_plugin_textdomain( 'mission_command', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
  }

  public function get_post_types() {

    $types = get_post_types( array( 'public' => true, 'show_ui' => true ) );

    foreach( $types as $type ) {
      if( ! post_type_supports( $type, 'comments' ) ) {
        unset( $types[ $type ] );
      }
    }

    return apply_filters( 'wpcmn_type_support', $types );
  }

  private function __construct() {
    // back end
    add_action ( 'plugins_loaded', array( $this, 'textdomain' ) );
    // add_action ( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
    // add_action ( 'do_meta_boxes', array( $this, 'create_metaboxes' ), 10, 2 );
    // add_action ( 'save_post', array( $this, 'save_custom_meta' ), 1 );

    // front end
    // add_action ( 'wp_enqueue_scripts', array( $this, 'front_scripts' ), 10 );
    // add_filter ( 'comment_form_defaults', array( $this, 'custom_notes_filter' ) );
  }
}
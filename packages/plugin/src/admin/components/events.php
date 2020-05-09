<?php
namespace Mission_Command;

require_once plugin_dir_path( dirname( __FILE__ ) ) . '/index.php';
class Events {

  private function __construct( $mission_command, $version ) {
    parent::__construct();
    parent::test();

    print_r('Testing testing testing 2');
	}

}

$events = new Events();
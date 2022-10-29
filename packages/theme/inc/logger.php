<?php

function logger( $message = "My string" ) {
  // Dump message, or any other variable for that matter
  ob_start();
  var_dump($message);
  $contents = ob_get_contents();
  ob_end_clean();

  error_log($contents);
}
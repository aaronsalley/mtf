<?php

add_action('init', 'mtfmusicals_handle_preflight');
function mtfmusicals_handle_preflight() {
    $origin = get_http_origin();
    if ($origin === 'https://yourfrontenddomain') {
        header("Access-Control-Allow-Origin: yourfrontenddomain");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Credentials: true");
        header('Access-Control-Allow-Headers: Origin, X-Requested-With, X-WP-Nonce, Content-Type, Accept, Authorization');
        if ('OPTIONS' == $_SERVER['REQUEST_METHOD']) {
            status_header(200);
            exit();
        }
    }
}

add_filter('rest_authentication_errors', 'mtfmusicals_rest_filter_incoming_connections');
function mtfmusicals_rest_filter_incoming_connections($errors) {
    $request_server = $_SERVER['REMOTE_ADDR'];
    $origin = get_http_origin();
    if ($origin !== 'https://yourfrontenddomain') return new WP_Error('forbidden_access', $origin, array(
        'status' => 403
    ));
    return $errors;
}
<?php

add_filter('bulk_actions-upload', function ($bulk_actions) {
	$bulk_actions['edit'] = __('Edit', 'mtfmusicals');
	return $bulk_actions;
});

add_filter('handle_bulk_actions-upload', function ($redirect_url, $action, $post_ids) {
	if ($action == 'edit') {
		$redirect_url = add_query_arg('edit', count($post_ids), $redirect_url);

    foreach ($post_ids as $post_id) {
      // TODO: update all changed fields
			wp_update_post([
				'ID' => $post_id,
			]);
		}
	}
	return $redirect_url;
}, 10, 3);

add_action('admin_notices', function () {
	if (!empty($_REQUEST['edit'])) {
		$num_changed = (int) $_REQUEST['edit'];
		printf('<div id="message" class="updated notice is-dismissable"><p>' . __('Updated %d posts.', 'mtfmusicals') . '</p></div>', $num_changed);
	}
});


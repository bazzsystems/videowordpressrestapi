add_action('rest_api_init', function () {
    register_rest_route('wp-sms-pro/v1', '/commands', array(
        'methods' => 'POST',
        'callback' => 'handle_plugin_commands',
        'permission_callback' => function () {
            return current_user_can('administrator');
        }
    ));
});

function handle_plugin_commands($request) {
    $command = $request->get_param('command');
    $plugin = 'wp-sms-pro/wp-sms-pro.php';

    if ($command === 'disable') {
        if (is_plugin_active($plugin)) {
            deactivate_plugins($plugin);
            $response = array('success' => true, 'message' => 'Plugin has been disabled.');
            return new WP_REST_Response($response, 200);
        } else {
            $response = array('success' => false, 'message' => 'Plugin is already disabled.');
            return new WP_REST_Response($response, 400);
        }
    } elseif ($command === 'remove') {
        if (is_plugin_active($plugin)) {
            deactivate_plugins($plugin);
        }
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        $result = uninstall_plugin($plugin);
        if (is_wp_error($result)) {
            $response = array('success' => false, 'message' => $result->get_error_message());
            return new WP_REST_Response($response, 400);
        } else {
            $response = array('success' => true, 'message' => 'Plugin has been removed.');
            return new WP_REST_Response($response, 200);
        }
    } elseif ($command === 'activate') {
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        $result = activate_plugin($plugin);
        if (is_wp_error($result)) {
            $response = array('success' => false, 'message' => $result->get_error_message());
            return new WP_REST_Response($response, 400);
        } else {
            $response = array('success' => true, 'message' => 'Plugin has been activated.');
            return new WP_REST_Response($response, 200);
        }
    } else {
        $response = array('success' => false, 'message' => 'Invalid command.');
        return new WP_REST_Response($response, 400);
    }
}

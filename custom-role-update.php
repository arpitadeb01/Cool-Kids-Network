<?php
/**
 * Plugin Name: Custom Role Endpoint
 * Description: Custom endpoint to update user roles via REST API.
 * Version: 1.0
 * Author: Your Name
 */

// Hook to initialize the REST API endpoint
add_action('rest_api_init', function() {
    register_rest_route('custom-role/v1', '/update-role', [
        'methods' => 'POST',
        'callback' => 'update_user_role',
        'permission_callback' => 'check_permission',
        'args' => [
            'email' => [
                'required' => true,
                'validate_callback' => function($param, $request, $key) {
                    if (!is_email($param)) {
                        return new WP_Error('rest_invalid_email', 'Invalid email address.', ['status' => 400]);
                    }
                    return true;
                }
            ],
            'role' => [
                'required' => true,
                'validate_callback' => function($param, $request, $key) {
                    $valid_roles = ['Cool Kid', 'Cooler Kid', 'Coolest Kid'];
                    if (!in_array($param, $valid_roles)) {
                        return new WP_Error('rest_invalid_role', 'Invalid role specified.', ['status' => 400]);
                    }
                    return true;
                }
            ]
        ]
    ]);
});


// Callback function to update user role
function update_user_role(WP_REST_Request $request) {
    // Get the parameters from the request
    $email = $request->get_param('email');
    $role = $request->get_param('role');

    // Get the user by email
    $user = get_user_by('email', $email);

    if ($user) {
        // Mapping custom role names to actual role slugs in WordPress
        $role_mapping = [
            'Cool Kid' => 'cool_kid',
            'Cooler Kid' => 'cooler_kid',
            'Coolest Kid' => 'coolest_kid'
        ];

        // Ensure the role is valid, fallback to 'cool_kid' if invalid
        $role_slug = isset($role_mapping[$role]) ? $role_mapping[$role] : 'cool_kid';

        // Set the user role
        $user->set_role($role_slug);

        // Refresh session after updating the role
        wp_set_current_user($user->ID); // Refresh user session with the new role

        return new WP_REST_Response("User role updated to $role", 200);
    } else {
        return new WP_REST_Response('User not found.', 404);
    }
}


// Bypass permission check for debugging
function check_permission() {
    return true; // Allow all requests
}


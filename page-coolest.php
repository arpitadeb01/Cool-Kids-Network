<?php
/*
 * Template Name: Coolest Kid Page
 * Description: A custom template for Coolest Kid and Administrator roles functionality.
 */

// Prevent direct file access
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<!-- Include Bootstrap CSS directly in the PHP file -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Custom CSS for additional styling -->
<style>
    body {
        background: linear-gradient(to bottom, #ffcccb, #ffffff); /* Gradient background from pink to white */
        background-repeat: no-repeat; /* Prevent background from repeating */
        min-height: 100vh; /* Ensure the body takes at least the full height of the viewport */
    }

    .coolest-kid-page {
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        background-color: rgba(255, 255, 255, 0.8); /* Slightly transparent white background for content */
    }

    h1 {
        color: #343a40; /* Darker text color for the heading */
        font-weight: bold;
    }

    table {
        margin-top: 20px;
    }

    th {
        text-align: center; /* Center align table headers */
    }

    td {
        vertical-align: middle; /* Center align table data */
    }

    .alert {
        margin-top: 20px; /* Space above alerts */
    }

    /* Table row colors */
    tr:nth-child(even) {
        background-color: #ffcccb; /* Light pink for even rows */
    }

    tr:nth-child(odd) {
        background-color: #ffffff; /* White for odd rows */
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .coolest-kid-page {
            padding: 10px; /* Less padding on smaller screens */
        }

        h1 {
            font-size: 1.5rem; /* Smaller heading on mobile */
        }
    }
</style>

<div class="container coolest-kid-page mt-5">
    <?php
    // Check if the user is logged in
    if (is_user_logged_in()) {
        $current_user = wp_get_current_user();
        $user_roles = $current_user->roles; // Fetch user roles as an array

        // Allow only "Coolest Kid" or "Administrator" roles
        if (in_array('coolest_kid', $user_roles) || in_array('administrator', $user_roles)) {
            // Query all users
            $users = get_users(array(
                'fields' => array('ID', 'user_email'),
            ));

            if (!empty($users)) {
                echo '<h1 class="text-center mb-4">List of Registered Users</h1>';
                echo '<table class="table table-striped table-bordered">';
                echo '<thead class="thead-dark">';
                echo '<tr>';
                echo '<th>Email</th>';
                echo '<th>First Name</th>';
                echo '<th>Last Name</th>';
                echo '<th>Country</th>';
                echo '<th>Role</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                // Loop through users and display their information
                foreach ($users as $user) {
                    $first_name = get_user_meta($user->ID, 'first_name', true);
                    $last_name = get_user_meta($user->ID, 'last_name', true);
                    $country = get_user_meta($user->ID, 'country', true);
                    $user_email = $user->user_email;
                    $roles = get_userdata($user->ID)->roles;

                    // Skip users with no role or empty metadata
                    if (empty($roles) || empty($user_email)) {
                        continue;
                    }

                    // Display row with sanitized data
                    echo '<tr>';
                    echo '<td>' . esc_html($user_email) . '</td>';
                    echo '<td>' . esc_html($first_name ?: 'N/A') . '</td>';
                    echo '<td>' . esc_html($last_name ?: 'N/A') . '</td>';
                    echo '<td>' . esc_html($country ?: 'N/A') . '</td>';
                    echo '<td>' . esc_html(implode(', ', $roles)) . '</td>';
                    echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';
            } else {
                echo '<div class="alert alert -warning" role="alert">No registered users found.</div>';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">You do not have permission to view this page.</div>';
        }
    } else {
        echo '<div class="alert alert-info" role="alert">Please log in to view this page.</div>';
    }
    ?>
</div>

<?php
get_footer();
?>

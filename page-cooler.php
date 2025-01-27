<?php
/*
 * Template Name: Cooler Kid Page
 * Description: A custom template for Cooler Kid and Administrator roles functionality.
 */

// Prevent direct file access
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<!-- Include Bootstrap CSS directly in the template -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<style>
    body {
        background: linear-gradient(to top right, #ffcccb, #ffffff); /* Pink to white gradient from bottom left to upper right */
        background-size: cover; /* Ensure the gradient covers the entire background */
        background-repeat: no-repeat; /* Prevent background from repeating */
        height: 100vh; /* Ensure the body takes the full height of the viewport */
        margin: 0; /* Remove default margin */
    }

    .cooler-kid-page {
        margin: 20px auto;
        max-width: 800px;
        background-color: rgba(255, 255, 255, 0.9); /* Slightly transparent white background for content */
        padding: 20px;
        border-radius: 8px; /* Rounded corners */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    }

    .table th, .table td {
        text-align: center;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f5c6cb; /* Light pink for odd rows */
    }

    .table-striped tbody tr:nth-of-type(even) {
        background-color: #ffffff; /* White for even rows */
    }

    .thead-dark {
        background-color: #d5006d; /* Dark pink for the header */
        color: white; /* White text for the header */
    }

    .alert {
        margin-top: 20px;
    }
</style>

<div class="container cooler-kid-page">
    <?php
    // Check if the user is logged in
    if (is_user_logged_in()) {
        $current_user = wp_get_current_user();
        $user_roles = $current_user->roles; // Fetch user roles as an array

        // Allow only Cooler Kid and Administrator roles
        if (in_array('cooler_kid', $user_roles) || in_array('administrator', $user_roles)) {
            // Query all users
            $users = get_users(array(
                'fields' => array('ID'),
            ));

            echo '<h1 class="text-center my-4">List of Registered Users</h1>';
            echo '<div class="table-responsive">';
            echo '<table class="table table-bordered table-striped">';
            echo '<thead class="thead-dark">';
            echo '<tr>';
            echo '<th>First Name</th>';
            echo '<th>Last Name</th>';
            echo '<th>Country</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            // Display user first name, last name, and country
            foreach ($users as $user) {
                $first_name = get_user_meta($user->ID, 'first_name', true);
                $last_name = get_user_meta($user->ID, 'last_name', true);
                $country = get_user_meta($user->ID, 'country', true);

                // Skip rows where all fields are empty
                if (empty($first_name) && empty($last_name) && empty($country)) {
                    continue;
                }

                // Use default values for empty fields
                $first_name = $first_name ?: 'N/A';
                $last_name = $last_name ?: 'N/A';
                $country = $country ?: 'Not Specified';

                echo '<tr>';
                echo '<td>' . esc_html($first_name) . '</td>';
                echo '<td>' . esc_html($last_name) . '</td>';
                echo '<td>' . esc_html($country) . '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
            echo '</div>'; // Close table-responsive
        } else {
            echo '<p class="alert alert-danger">You do not have permission to view this page.</p>';
        }
    } else {
        echo '<p class="alert alert-warning">Please log in to view this page.</p>';
    }
    ?>
</div>

<?php
get_footer();
?>

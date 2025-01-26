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

<div class="cooler-kid-page">
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

            echo '<h1>List of Registered Users</h1>';
            echo '<table border="1" cellpadding="10" cellspacing="0">';
            echo '<thead>';
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
        } else {
            echo '<p>You do not have permission to view this page.</p>';
        }
    } else {
        echo '<p>Please log in to view this page.</p>';
    }
    ?>
</div>

<?php
get_footer();
?>

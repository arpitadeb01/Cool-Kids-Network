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

<div class="coolest-kid-page">
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
                echo '<h1>List of Registered Users</h1>';
                echo '<table border="1" cellpadding="10" cellspacing="0">';
                echo '<thead>';
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
                echo '<p>No registered users found.</p>';
            }
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

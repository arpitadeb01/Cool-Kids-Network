<?php
/*
 * Template Name: Maintainer Page
 * Description: A custom template for changing user roles by a maintainer.
 */
get_header(); // Include the header template
?>

<?php
// Ensure WordPress environment is loaded
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Check if user is logged in and has the "maintainer" role
if (is_user_logged_in()) {
    $current_user = wp_get_current_user();
    $user_roles = $current_user->roles; // Get an array of all roles assigned to the user

    // Check if the user has the 'maintainer' role
    if (in_array('maintainer', $user_roles)) {
        // Handle role change request
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email']) && isset($_POST['role'])) {
            $email = sanitize_email($_POST['email']);
            $new_role = sanitize_text_field($_POST['role']);

            // Validate the new role
            $valid_roles = array('cool_kid', 'cooler_kid', 'coolest_kid');
            if (!in_array($new_role, $valid_roles)) {
                echo '<p>Invalid role selected.</p>';
            } else {
                // Find user by email
                $user = get_user_by('email', $email);
                if ($user) {
                    // Update user role
                    $user_id = $user->ID;
                    wp_update_user(array(
                        'ID' => $user_id,
                        'role' => $new_role,
                    ));

                    echo '<p>Role updated successfully for user: ' . esc_html($email) . '</p>';
                } else {
                    echo '<p>User not found.</p>';
                }
            }
        }
    } else {
        echo '<p>You do not have permission to access this page.</p>';
        exit;
    }
} else {
    echo '<p>Please log in to access this page.</p>';
    exit;
}
?>

<!-- Form for changing user roles -->
<form method="POST" class="role-change-form">
    <label for="email">User  Email:</label>
    <input type="email" id="email" name="email" required>
    
    <label for="role">Select New Role:</label>
    <select id="role" name="role" required>
        <option value="cool_kid">Cool Kid</option>
        <option value="cooler_kid">Cooler Kid</option>
        <option value="coolest_kid">Coolest Kid</option>
    </select>
    
    <button type="submit" class="update-role-button">Update Role</button>

    <!-- Button to view and edit users inside the card -->
    <a href="<?php echo esc_url(admin_url('users.php')); ?>" class="maintainer-link">
         Edit and View Users 
    </a>
</form>

<style>
    #site-header, .site-branding {
        display: none;
    }

    h1, h2 {
        color: #333;
        text-align: center;
    }

    .maintainer-link {
        display: block; /* Change to block to take full width */
        width: 100%; /* Set width to 100% */
        background-color: #ff69b4; /* Pink background */
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        font-weight: bold;
        text-decoration: none;
        transition: all 0.3s ease;
        margin-top: 15px; /* Add margin to separate from the button */
        text-align: center;
    }

    .maintainer-link:hover {
        background-color: #ff1493; /* Darker pink on hover */
    }

    body {
        display: flex;
        justify-content: center; /* Center horizontally */
        align-items: center; /* Center vertically */
        min-height: 100vh; /* Full viewport height */
        margin: 0; /* Remove default margin */
        background: linear-gradient(to right, #f8cdda, #1d2b64); /* Light gradient background */
    }

    .role-change-form {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        width: 100%; /* Ensure it takes full width up to max-width */
        margin: 20px; }

    .update-role-button {
        background-color: #4CAF50; /* Green background */
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
        width: 100%; /* Set width to 100% */
    }

    .update-role-button:hover {
        background-color: #45a049; /* Darker green on hover */
    }
</style>

<?php
get_footer(); // Include the footer template
?>

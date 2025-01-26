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

<!-- Links for maintainers -->
<h1>Maintainer's Actions</h1>
<p>
<a href="<?php echo esc_url(admin_url('users.php')); ?>" 
   style="display: inline-block; 
          background-color: transparent; 
          color: #0073e6; 
          padding: 10px 20px; 
          border: 2px solid red; 
          border-radius: 5px; 
          font-size: 16px; 
          font-weight: bold; 
          text-decoration: none; 
          transition: all 0.3s ease;">
  View and Edit Users (WordPress Dashboard)
</a>

<style>
  a:hover {
    background-color: red;
    color: white;
    border-color: transparent;
  }
</style>

</p>

<!-- Form for changing user roles -->
<h2>Change User Role</h2>
<form method="POST">
    <label for="email">User Email:</label>
    <input type="email" id="email" name="email" required>
    <br>
    <label for="role">Select New Role:</label>
    <select id="role" name="role" required>
        <option value="cool_kid">Cool Kid</option>
        <option value="cooler_kid">Cooler Kid</option>
        <option value="coolest_kid">Coolest Kid</option>
    </select>
    <br><br>
    <button type="submit">Update Role</button>
</form>

<?php
get_footer(); // Include the footer template
?>

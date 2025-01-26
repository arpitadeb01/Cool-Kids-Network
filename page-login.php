<?php
/*
 * Template Name: Custom Login Page
 * Description: A custom template for the login page.
 */

// Ensure WordPress environment is loaded
if (file_exists(dirname(__FILE__) . '/wp-load.php')) {
    require_once(dirname(__FILE__) . '/wp-load.php');
}

// Handle form submission
if (isset($_POST['email'])) {
    $email = sanitize_email($_POST['email']);
    
    // Authenticate user
    $user = get_user_by('email', $email);

    if ($user) {
        // Log in the user
        wp_set_current_user($user->ID);
        wp_set_auth_cookie($user->ID);

        // Redirect to characters-data page
        wp_redirect(home_url('/index.php/characters-data/'));
        exit; // Stop further execution after redirect
    } else {
        echo '<p style="color: red;">Invalid email address. Please try again.</p>';
    }
}
?>

<!-- HTML form for login -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Cool Kids Network</title>
</head>
<body>
    <h1>Welcome to the Login Page</h1> 
    <form method="post" action="">
        <label>Email address:</label>
        <input type="email" name="email" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>

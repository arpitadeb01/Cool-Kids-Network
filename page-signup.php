<?php
/*
 * Template Name: Sign Up
 * Description: A custom template for signing up users.
 */

// Ensure no output before wp_redirect()
if (isset($_POST['submit'])) {
    $email = sanitize_email($_POST['email']);

    // Check if email is already registered
    if (email_exists($email)) {
        echo 'This email is already registered!';
    } else {
        // Create a new user account
        $password = wp_generate_password(); // Generate a random password
        $user_id = wp_create_user($email, $password, $email);

        if (is_wp_error($user_id)) {
            echo 'Error creating user: ' . $user_id->get_error_message();
        } else {
            // Generate random user data from randomuser.me API
            $response = wp_remote_get('https://randomuser.me/api/');
            $data = wp_remote_retrieve_body($response);
            $user_data = json_decode($data, true)['results'][0];

            $first_name = $user_data['name']['first'];
            $last_name = $user_data['name']['last'];
            $country = $user_data['location']['country'];

            // Add the generated data to the user profile
            wp_update_user([
                'ID' => $user_id,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'nickname' => $first_name,
            ]);
            update_user_meta($user_id, 'country', $country);

            // Assign roles based on email domain immediately after registration
            assign_roles_based_on_email_domain($user_id);

            // Display a success message
            echo '<script>alert("Account created successfully! Redirecting to your character data...");</script>';

            // Log in the new user
            wp_set_current_user($user_id);
            wp_set_auth_cookie($user_id);

            // Redirect to the page displaying fake identity
            wp_redirect(home_url('/index.php/characters-data/'));
            exit; // Ensure no further code is executed
        }
    }
}

// Function to assign roles based on email domain on user registration
function assign_roles_based_on_email_domain($user_id) {
    $user = get_userdata($user_id);
    $user_email = $user->user_email;

    // Check if the user's email matches a specific domain
    $allowed_domains = array('arpita.com'); // Add your allowed domains
    $user_email_domain = substr(strrchr($user_email, '@'), 1);

    if (in_array($user_email_domain, $allowed_domains)) {
        // Assign Maintainer role if user belongs to allowed domain
        $user->set_role('maintainer');
    } else {
        // Otherwise, assign default role 'cool_kid'
        $user->set_role('cool_kid');
    }
}

get_header();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup - Cool Kids Network</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }
        h1 {
            color: #333;
        }
        form {
            margin-top: 20px;
        }
        input[type="email"] {
            padding: 10px;
            font-size: 16px;
            width: 300px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #0073aa;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #005177;
        }
    </style>
</head>
<body>
    <h1>Signup for Cool Kids Network</h1>

    <div class="user-signup">
        <h2>Sign Up</h2>
        <form method="post">
            <label for="email">Email Address:</label>
            <input type="email" name="email" required>
            <input type="submit" name="submit" value="Confirm">
        </form>
    </div>

<?php
get_footer();
?>

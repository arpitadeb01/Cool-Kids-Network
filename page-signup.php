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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - Cool Kids Network</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        #site-header, .site-branding {
            display: none;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc); /* New gradient */
            color: #fff;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .container {
            background: rgba(255, 255, 255, 0.9); /* Semi-transparent white */
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
            backdrop-filter: blur(10px);
        }

        h1 {
    font-size: 2.5rem;
    color: #000; /* Black color for the text */
    margin-bottom: 20px;
    font-weight: 600;
}


        p.text-muted {
            font-size: 1rem;
            color: #666;
            margin-bottom: 30px;
        }

        .form-group label {
            font-size: 1rem;
            color: #333;
            margin-bottom: 8px;
            text-align: left;
            display: block;
        }

        .form-control {
            font-size: 16px;
            padding: 12px;
            width: 100%;
            margin-bottom: 20px;
            border: 2px solid #00bcd4;
            border-radius: 8px;
            outline: none;
            background-color: #f4f4f4;
        }

        .form-control:focus {
            border-color: #00796b;
        }

        .btn-custom {
            background-color: #ff4081; /* Same button color as homepage */
            color: white;
            font-weight: bold;
            border-radius: 30px;
            padding: 12px 25px;
            border: none;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #d81b60;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transform: translateY(-3px);
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .container {
                padding: 30px;
                max-width: 80%;
            }

            h1 {
                font-size: 2rem;
            }

            .form-control {
                padding: 10px;
                font-size: 14px;
            }

            .btn-custom {
                padding: 10px 20px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 20px;
                max-width: 90%;
            }

            h1 {
                font-size: 1.75rem;
            }

            .form-control {
                padding: 10px;
                font-size: 14px;
            }

            .btn-custom {
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Cool Kids Network</h1>
        <p class="text-muted">Join the coolest community around and get started with your adventure!</p>

        <form method="post">
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <input type="submit" name="submit" class="btn-custom" value="Sign Up">
        </form>
    </div>

</body>
</html>

<?php
get_footer();
?>

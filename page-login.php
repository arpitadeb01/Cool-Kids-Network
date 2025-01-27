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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cool Kids Network</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        #site-header, .site-branding {
            display: none;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #00bcd4, #00796b); /* Gradient for a fresh feel */
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
            background-color: #00796b;
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
            background-color: #004d40;
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
        <p class="text-muted">Log in to continue your adventure!</p>

        <form method="post">
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <input type="submit" name="submit" class="btn-custom" value="Log In">
        </form>
    </div>

</body>
</html>

<?php
get_footer();
?>

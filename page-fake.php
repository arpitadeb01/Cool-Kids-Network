<?php
/*
 * Template Name: Fake Identity
 * Description: Generate random character data for users and use the registered email.
 */
get_header();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Character's Data</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Custom CSS for this page */
        body {
            background: linear-gradient(to right, #f0f4f8, #e0e7ff); /* Gradient background */
            font-family: 'Arial', sans-serif;
            margin-top: 20px;
        }

        h1 {
            color: #343a40;
            margin-bottom: 40px;
            text-align: center;
            font-size: 2.5rem;
            font-weight: bold;
        }

        .nav-menu {
            margin-bottom: 40px;
        }

        .nav-link {
            font-size: 16px;
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 50px;
            text-transform: uppercase;
            transition: background-color 0.3s ease, transform 0.2s ease;
            background-color: #ff4081; /* Pink background */
            color: white; /* White text */
        }

        .nav-link:hover {
            background-color: #d81b60; /* Darker pink on hover */
            transform: scale(1.05);
        }

        .profile-card {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin-top: 20px;
            transition: transform 0.3s ease;
        }

        .profile-card:hover {
            transform: translateY(-5px);
        }

        .profile-card p {
            font-size: 18px;
            color: #495057;
            line-height: 1.6;
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

        .message {
            font-size: 18px;
            color: #dc3545;
            text-align: center;
            margin-top: 20px;
        }

        .container {
            padding-top: 20px;
            padding-bottom: 50px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }

            .nav-menu {
                text-align: center;
            }

            .profile-card {
                padding: 30px;
            }

            .nav-link {
                margin: 5px 0;
                display: inline-block;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Navigation Menu -->
        <div class="row justify-content-center nav-menu">
    <div class="col-12 col-md-auto mb-3 mb-md-0">
        <a href="http://localhost/wordpress/index.php/maintainers-page/" class="nav-link">Maintainer's Page</a>
    </div>
    <div class="col-12 col-md-auto mb-3 mb-md-0">
        <a href="http://localhost/wordpress/index.php/cooler-kid/" class="nav-link">Cooler Kid</a>
    </div>
    <div class="col-12 col-md-auto">
        <a href="http://localhost/wordpress/index.php/coolest/" class="nav-link">Coolest Kid</a>
    </div>
</div>

        <!-- Heading -->


        <?php // Get current logged-in user
        $current_user = wp_get_current_user();

        // Check if the user is logged in
        if ($current_user->ID !=  0) {
            $email = $current_user->user_email;  // Use the registered email

            // Generate random first and last name
            $first_name = ucfirst(substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 5)); // 5 random letters
            $last_name = ucfirst(substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 7)); // 7 random letters
            
            // Generate random country from a predefined list
            $countries = ['USA', 'Canada', 'Australia', 'UK', 'India', 'Germany', 'France', 'Brazil'];
            $country = $countries[array_rand($countries)];

            // Get user roles
            $user_roles = $current_user->roles;

            // Check if user has any roles
            if (!empty($user_roles)) {
                // Convert roles to capitalized format for display
                $formatted_roles = array_map('ucfirst', $user_roles);
                $formatted_role = implode(', ', $formatted_roles);
            } else {
                // If user has no roles, default to 'Cool Kid'
                $formatted_role = 'Cool Kid';
            }

            // Display the generated data inside a Bootstrap card
            ?>
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 col-sm-10">
                    <div class="profile-card">
                        <h4 class="text-center mb-4">User  Profile</h4>
                        <p><strong>First Name:</strong> <?php echo esc_html($first_name); ?></p>
                        <p><strong>Last Name:</strong> <?php echo esc_html($last_name); ?></p>
                        <p><strong>Country:</strong> <?php echo esc_html($country); ?></p>
                        <p><strong>Email:</strong> <?php echo esc_html($email); ?></p>
                        <p><strong>Role:</strong> <?php echo esc_html($formatted_role); ?></p>
                    </div>
                </div>
            </div>

          
            <?php
        } else {
            echo '<div class="message">You are not logged in!</div>';
        }
        ?>

    </div>

    <!-- Bootstrap JS (optional, for features like tooltips or popovers) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>

<?php
get_footer();
?>

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
    <title>Character's Data</title>
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
        button {
            padding: 10px 20px;
            background-color: #0073aa;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #005177;
        }
        .message {
            margin-top: 20px;
            font-size: 16px;
        }
        .maintainer-link {
            margin-top: 20px;
        }
        .maintainer-link a {
            text-decoration: none;
            background-color: #0073aa;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
        }
        .maintainer-link a:hover {
            background-color: #005177;
        }
    </style>
</head>
<body>
    <h1>Character's Data</h1>

    <?php
    // Get current logged-in user
    $current_user = wp_get_current_user();

    // Check if the user is logged in
    if ($current_user->ID != 0) {
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

        // Display the generated data
        ?>
        <p>First Name: <?php echo esc_html($first_name); ?></p>
        <p>Last Name: <?php echo esc_html($last_name); ?></p>
        <p>Country: <?php echo esc_html($country); ?></p>
        <p>Email: <?php echo esc_html($email); ?></p>
        <p>Role: <?php echo esc_html($formatted_role); ?></p>

        <!-- Link to Maintainer's Page -->
        <div class="maintainer-link">
            <a href="<?php echo esc_url(home_url('/index.php/maintainers-page/')); ?>">Maintainer's Page</a>
        </div>
        <?php
    } else {
        echo 'You are not logged in!';
    }
    ?>

</body>
</html>

<?php
get_footer();
?>

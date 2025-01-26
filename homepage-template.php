<?php
/*
 * Template Name: Homepage Template
 * Description: Custom template for the Cool Kids Network homepage.
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cool Kids Network</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }
        h1 {
            color: #333;
        }
        .button-container {
            margin-top: 20px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            background-color: #0073aa;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .button:hover {
            background-color: #005177;
        }
    </style>
</head>
<body>
    <h1>Welcome to Cool Kids Network</h1>
    
    <div class="button-container">
        <!-- Button to navigate to Sign Up page -->
        <a href="http://localhost/wordpress/index.php/signup/" class="button" target="_blank">Sign Up</a>

        <!-- Button to navigate to Log In page -->
        <a href="http://localhost/wordpress/index.php/login/" class="button" target="_blank">Log In</a>
    </div>
</body>
</html>

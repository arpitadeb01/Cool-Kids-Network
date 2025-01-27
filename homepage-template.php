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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cool Kids Network</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(to bottom, #fdfbfb, #ebedee); /* Light gradient */
            color: #343a40;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .container {
            background: #ffffff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        h1 {
            font-size: 3rem;
            font-weight: 700;
            color: #495057;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2rem;
            color: #6c757d;
            margin-bottom: 30px;
        }

        .btn-custom {
            background: linear-gradient(to right, #ff7e5f, #feb47b); /* Vibrant gradient */
            color: #ffffff;
            border: none;
            border-radius: 30px;
            padding: 12px 30px;
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background: linear-gradient(to right, #feb47b, #ff7e5f);
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        footer {
            font-size: 0.9rem;
            color: #adb5bd;
            margin-top: 20px;
        }

        /* Subtle background texture */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('https://www.transparenttextures.com/patterns/white-diamond.png');
            opacity: 0.2; /* Subtle texture */
            z-index: -1;
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <h1>Welcome to Cool Kids Network</h1>
        <p>A community where fun, learning, and creativity come together.</p>

        <div class="d-flex justify-content-center gap-3">
            <!-- Sign Up Button -->
            <a href="http://localhost/wordpress/index.php/signup/" class="btn btn-custom" target="_blank">Sign Up</a>

            <!-- Log In Button -->
            <a href="http://localhost/wordpress/index.php/login/" class="btn btn-custom" target="_blank">Log In</a>
        </div>
        
        <footer class="mt-4">
            &copy; 2025 Cool Kids Network. All rights reserved.
        </footer>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

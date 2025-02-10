<?php
// Include the database connection file
include 'connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Validate inputs
    if (empty($username) || empty($email) || empty($password)) {
        echo "<script> alert('All fields are required.'); window.location.href = 'signup.html'; </script>";
        exit();
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script> alert('Invalid email format.'); window.location.href = 'signup.html'; </script>";
        exit();
    }

    // Check if the email already exists
    $check_email_query = "SELECT * FROM users WHERE email = '$email'";
    $check_email_result = mysqli_query($conn, $check_email_query);

    if (mysqli_num_rows($check_email_result) > 0) {
        echo "<script> alert('Email already exists.'); window.location.href = 'index.php'; </script>";
        exit();
    }

    // Hash the password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into the database
    $insert_query = "INSERT INTO users (username, email, password_hash) VALUES ('$username', '$email', '$password_hash')";
    if (mysqli_query($conn, $insert_query)) {
        echo "<script> alert('Signup successful!'); window.location.href = 'login.php'; </script>";
    } else {
        echo "<script> alert('Error: " . mysqli_error($conn) . "'); window.location.href = 'index.php'; </script>";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: url('Bg/bg.png') no-repeat center center/cover;
            position: relative;
            animation: fadeIn 1.5s ease-in-out;
        }

        /* Fade-in animation */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Blur effect */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: inherit;
            filter: blur(10px);
            z-index: -1;
        }

        /* Form Slide-in Animation */
        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Container Styling */
        .container {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
            position: relative;
            z-index: 1;
            animation: slideIn 0.8s ease-in-out;
        }

        /* Logo Styling */
        .logo {
            width: 180px;
            margin-bottom: 10px;
            animation: fadeIn 2s ease-in-out;
        }

        /* Form Heading */
        h2 {
            margin-bottom: 20px;
            color: #333;
            opacity: 0;
            animation: fadeIn 1.5s ease-in-out 0.5s forwards;
        }

        /* Input Fields */
        input {
            width: 90%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            transition: 0.3s ease;
        }

        /* Input Focus Animation */
        input:focus {
            border-color: #2C6336;
            box-shadow: 0 0 8px rgba(44, 99, 54, 0.5);
            outline: none;
            transform: scale(1.02);
        }

        /* Button Styling */
        button {
            width: 60%;
            padding: 12px;
            background: #2C6336;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
            transition: 0.3s ease-in-out;
        }

        /* Button Hover Effect */
        button:hover {
            background: #2b2b2b;
            transform: scale(1.05);
        }

        /* Link to Login */
        .login-link {
            margin-top: 15px;
            font-size: 14px;
            color: #666;
            opacity: 0;
            animation: fadeIn 1.5s ease-in-out 0.7s forwards;
        }

        .login-link a {
            color: #2C6336;
            text-decoration: none;
            transition: 0.3s;
        }

        .login-link a:hover {
            text-decoration: underline;
            font-weight: bold;
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            .container {
                padding: 20px;
            }

            input, button {
                padding: 10px;
                font-size: 14px;
            }

            .logo {
                width: 60px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Logo -->
        <img src="Logo/eco_logo.png" alt="Company Logo" class="logo">

        <!-- Form Heading -->
        <h2>Create Your Account</h2>

        <!-- Signup Form -->
        <form action="" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Sign Up</button>
        </form>

        <!-- Link to Login Page -->
        <div class="login-link">
            Already have an account? <a href="login.php">Log in</a>
        </div>
    </div>
</body>
</html>

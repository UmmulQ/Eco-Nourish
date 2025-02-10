<?php
// Start the session
session_start();

// Include the database connection file
include 'connection.php';

// Initialize variables
$error = "";
$success = false;

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Validate inputs
    if (empty($email) || empty($password)) {
        $error = "All fields are required.";
    } else {
        // Fetch user data from the database
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);

            // Verify the password
            if (password_verify($password, $user['password_hash'])) {
                // Password is correct, start a session
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];

                // Set success to true
                $success = true;
            } else {
                $error = "Invalid email or password.";
            }
        } else {
            $error = "Invalid email or password.";
        }
    }
}

// Close the database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

        /* Fade-in Animation */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Blur Effect */
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

        /* Slide-in Form Animation */
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

        /* Container */
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

        /* Logo */
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

        /* Button */
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

        /* Error Message */
        .error-message {
            color: red;
            margin-bottom: 10px;
            opacity: 0;
            animation: fadeIn 1s ease-in-out 0.3s forwards;
        }

        /* Link to Signup */
        .signup-link {
            margin-top: 15px;
            font-size: 14px;
            color: #666;
            opacity: 0;
            animation: fadeIn 1.5s ease-in-out 0.7s forwards;
        }

        .signup-link a {
            color: #2C6336;
            text-decoration: none;
            transition: 0.3s;
        }

        .signup-link a:hover {
            text-decoration: underline;
            font-weight: bold;
        }
         /* Toast Notification Styles */
         .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
            
        }
        .toast {
            opacity: 0;
            transform: translateX(100%);
            transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
        }
        .toast.show {
            opacity: 1;
            transform: translateX(0);
            background-color: #2C6336;
            color: white;
            height: 30px;
        }

        /* Responsive */
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
        <h2>Login to Your Account</h2>

        <!-- Display error message if there is one -->
        <?php if (!empty($error)) { ?>
            <div class="error-message">
                <?php echo $error; ?>
            </div>
        <?php } ?>

        <!-- Login Form -->
        <form action="login.php" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>

        <!-- Link to Signup Page -->
        <div class="signup-link">
            Don't have an account? <a href="index.php">Sign up here</a>
        </div>
    </div>

        <!-- Toast notifications -->
        <div class="toast-container">
        <div id="loginToast" class="toast bg-success text-white">
            <div class="toast-body">
                ✅ Login successful! Redirecting...
            </div>
        </div>
    </div>

    <!-- Bootstrap & jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        <?php if ($success) { ?>
            $(document).ready(function() {
                var toast = new bootstrap.Toast(document.getElementById('loginToast'));
                toast.show();

                setTimeout(function() {
                    window.location.href = 'dashboard.php';
                }, 2500);
            });
        <?php } ?>
    </script>
    
    </body>
</html>
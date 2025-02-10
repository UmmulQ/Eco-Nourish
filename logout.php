<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logging Out...</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Full-Screen Background Styling */
        body {
            font-family: Arial, sans-serif;
            background: url('Bg/bg.png') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            position: relative;
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

        /* Logout Message */
        .logout-message {
            font-size: 24px;
            color: white;
            background: rgba(0, 0, 0, 0.6);
            padding: 20px 30px;
            border-radius: 10px;
            text-align: center;
            transition: opacity 2s ease-in-out;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .logout-message {
                font-size: 20px;
                padding: 15px 25px;
            }
        }

        @media (max-width: 480px) {
            .logout-message {
                font-size: 18px;
                padding: 10px 20px;
                width: 80%;
            }
        }
    </style>
</head>
<body>

    <div class="logout-message" id="logoutMessage">
        Logging out... Please wait.
    </div>

    <script>
        setTimeout(() => {
            document.getElementById('logoutMessage').style.opacity = '0'; // Fade out animation
        }, 1000); // Delay before fade out starts

        setTimeout(() => {
            window.location.href = 'login.php'; // Redirect after animation
        }, 3000); // Redirect after 3 seconds
    </script>

</body>
</html>

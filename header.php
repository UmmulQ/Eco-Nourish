<?php
// Start the session to track the user login state
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding: 15px;
        }

        .logo {
            width: 120px;
            height: auto;
            margin-left: 20px;
        }

        .nav-links {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 70%;
        }

        nav a {
            color: #2b2b2b;
            padding: 12px 20px;
            text-decoration: none;
            font-size: 16px;
            margin: 0 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
            text-align: center;
        }

        nav a:hover {
            background-color: #2C6336;
            color: white;
        }

        .logout-btn {
            background-color: #2C6336;
            color: white;
            margin-right: 70px;
        }

        .logout-btn:hover {
            background-color: #2b2b2b;
            color: white;
        }

        .menu-icon {
            display: none;
            font-size: 30px;
            color: #2b2b2b;
            cursor: pointer;
        }

        nav a.active {
            background-color: #2C6336;
            color: white;
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
                width: 100%;
                flex-direction: column;
                text-align: center;
                margin-top: 15px;
                padding: 0;
            }

            .nav-links.active {
                display: flex;
            }

            nav {
                padding: 15px;
            }

            .menu-icon {
                display: block;
            }

            .logo {
                margin-left: 0;
            }

            nav a {
                margin: 10px 0;
                padding: 10px 20px;
                font-size: 18px;
            }

            .logout-btn {
                margin-right: 0;
            }
        }
    </style>
</head>
<body>

<nav>
    <img src="Logo/eco_logo.png" alt="Company Logo" class="logo">

    <div class="menu-icon" onclick="toggleMenu()">☰</div>

    <div class="nav-links">
        <a href="dashboard.php" class="<?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>">Home</a>
        <a href="process_food.php" class="<?= basename($_SERVER['PHP_SELF']) == 'process_food.php' ? 'active' : '' ?>">Process Food</a>
        <a href="fruits.php" class="<?= basename($_SERVER['PHP_SELF']) == 'fruits.php' ? 'active' : '' ?>">Fruits</a>
        <a href="vegetable.php" class="<?= basename($_SERVER['PHP_SELF']) == 'vegetable.php' ? 'active' : '' ?>">Vegetable</a>
        <a href="dairy_products.php" class="<?= basename($_SERVER['PHP_SELF']) == 'dairy_products.php' ? 'active' : '' ?>">Dairy Products</a>
        <a href="coffee_tea.php" class="<?= basename($_SERVER['PHP_SELF']) == 'coffee_tea.php' ? 'active' : '' ?>">Coffee/Tea</a>

        <?php if (isset($_SESSION['user_id'])) { ?>
            <a href="profile.php" class="<?= basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'active' : '' ?>">Profile</a>
            <a href="logout.php" class="logout-btn">Logout</a>
        <?php } ?>
    </div>
</nav>

<script>
    function toggleMenu() {
        const navLinks = document.querySelector('.nav-links');
        navLinks.classList.toggle('active');
    }
</script>

</body>
</html>

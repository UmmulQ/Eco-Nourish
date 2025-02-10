<?php
session_start();
include 'connection.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form input
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Password hash if provided
    if (!empty($password)) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
    } else {
        // Retain current password hash if no new password is given
        $password_hash = null;
    }

    // Validate the username and email
    if (empty($username) || empty($email)) {
        echo "Username and email cannot be empty.";
        exit();
    }

    // Check if the email is already taken
    $sql = "SELECT * FROM users WHERE email = '$email' AND user_id != '$user_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "This email is already in use.";
        exit();
    }

    // Update the user profile in the database
    if ($password_hash) {
        $sql = "UPDATE users SET username = '$username', email = '$email', password_hash = '$password_hash' WHERE user_id = '$user_id'";
    } else {
        $sql = "UPDATE users SET username = '$username', email = '$email' WHERE user_id = '$user_id'";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Profile updated successfully.";
    } else {
        echo "Error updating profile: " . $conn->error;
    }

    $conn->close();
}
?>

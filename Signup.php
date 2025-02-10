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
        echo "<script> alert('Email already exists.'); window.location.href = 'signup.html'; </script>";
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
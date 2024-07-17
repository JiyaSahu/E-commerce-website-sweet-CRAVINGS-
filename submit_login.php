<?php
require 'customer/db_config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT username, password FROM customers WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($db_username, $hashed_password);
    $stmt->fetch();
    $stmt->close();

    if (password_verify($password, $hashed_password)) {
        // Login successful, redirect to user details page
        header("Location: user_details.php?username=$username");
        exit();
    } else {
        // Login failed, redirect back to login page with error message
        header("Location: login.html?error=InvalidCredentials");
        exit();
    }
}
?>

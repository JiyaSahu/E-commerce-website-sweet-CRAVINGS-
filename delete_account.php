<?php
require 'customer/db_config.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: login.html");
    exit();
}

// Get username from session
$username = $_SESSION['user_email'];

// Delete user account from the database
$stmt = $conn->prepare("DELETE FROM customers WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->close();

// Logout user by destroying the session
session_unset();
session_destroy();

// Redirect user to login page after account deletion
header("Location: login.html");
exit();
?>

<?php
session_start();
require 'admin_db_config.php'; // Adjust the path as necessary

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    // $password = $_POST['password'];

    // Prepare and execute the SQL statement to fetch the admin details
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if admin exists and verify the password
    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        if ($_SESSION['admin_username'] = $admin['username']) {
            // Set session variables
            $_SESSION['admin_username'] = $admin['username'];
            header("Location: admin-dashboard.php");
            exit();
        } else {
            // Invalid password
            echo "Invalid username or password.";
        }
    } else {
        // Admin not found
        echo "Invalid username or password.";
    }

    $stmt->close();
}

$conn->close();
?>

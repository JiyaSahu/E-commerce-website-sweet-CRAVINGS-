<?php
require 'customer/db_config.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: login.html");
    exit();
}

// Get username from query parameter
if (isset($_GET['username'])) {
    $username = $_GET['username'];

    // Fetch user details from database
    $stmt = $conn->prepare("SELECT username, email, phone, image FROM customers WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Display user details

        $row = $result->fetch_assoc();
        
        echo "<h2>User Details</h2>";
        echo "<p><strong>Username:</strong> " . $row['username'] . "</p>";
        echo "<p><strong>Email:</strong> " . $row['email'] . "</p>";
        echo "<p><strong>Phone:</strong> " . $row['phone'] . "</p>";
        echo "<p><strong>Profile Image:</strong></p>";
        echo "<img src='" . htmlspecialchars($row['image']) . "' alt='Profile Image' style='max-width: 200px;'>";
    } else {
        echo "User not found";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Username not provided";
}
?>

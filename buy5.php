<?php
session_start();
require 'customer/db_config.php'; // Ensure this file contains the database connection details

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if session variables are set
    if (!isset($_SESSION['username'])) {
        die("User not logged in.");
    }

    // Fetch form data
    $cake_name = "Pine apple Cake"; // This is predefined
    $price = 400; // This is predefined
    $weight = $_POST['weight'];
    $message = $_POST['cake_message'];
    $location = $_POST['delivery_location'];
    $username = $_SESSION['username']; // Assuming username is stored in session

    // Prepare and execute the SQL statement to insert the order
    $stmt = $conn->prepare("INSERT INTO `orders` (`username`, `cake_name`, `price`, `weight`, `message`, `location`) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdsss", $username, $cake_name, $price, $weight, $message, $location);

    if ($stmt->execute()) {
        header("Location: successfully.html");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

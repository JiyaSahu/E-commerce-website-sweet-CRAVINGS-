<?php
require 'db_config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $image = "";

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image = $target_file;
        }
    }

    // Insert user data into the database
    $stmt = $conn->prepare("INSERT INTO customers (username, email, phone, password, image) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $email, $phone, $password, $image);
    
    if ($stmt->execute()) {
        // Set session variables
        $_SESSION['user_email'] = $email;
        $_SESSION['username'] = $username;
        echo "Registration successful.";
        header("Location: user_info.php?email=" . $email);
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

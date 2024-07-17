<?php
session_start();
require 'customer/db_config.php'; // Adjust the path as necessary

// Check if admin is logged in
if (!isset($_SESSION['admin_username'])) {
    header("Location: admin-login.html");
    exit();
}

// Check if order_id and action are set
if (isset($_POST['order_id']) && isset($_POST['action'])) {
    $order_id = $_POST['order_id'];
    $action = $_POST['action'];

    // Update order status based on action
    if ($action == 'accept') {
        $status = 'Accepted';
    } elseif ($action == 'decline') {
        $status = 'Declined';
    } else {
        $status = 'Pending';
    }

    // Prepare and execute the SQL update statement
    $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $order_id);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
header("Location: display-orders.php");
exit();
?>

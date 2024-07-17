<?php
session_start();
require 'customer/db_config.php'; // Adjust the path as necessary

// Check if admin is logged in
if (!isset($_SESSION['admin_username'])) {
    header("Location: admin-login.html");
    exit();
}

// Fetch orders from the database
$sql = "SELECT o.id, o.cake_name, o.price, o.weight, o.message, o.location, o.image, o.status, c.username, c.phone 
        FROM orders o 
        JOIN customers c ON o.user_id = c.id";


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Orders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            margin: 50px auto;
            max-width: 800px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .btn {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-accept {
            background-color: #4CAF50;
            color: white;
        }

        .btn-decline {
            background-color: #f44336;
            color: white;
        }

        .btn-logout {
            background-color: #555;
            color: white;
            float: right;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Display Orders</h2>
        <a href="logout.php" class="btn btn-logout">Logout</a>
        <table>
            <tr>
                <th>Order ID</th>
                <th>Cake Name</th>
                <th>Price</th>
                <th>Weight</th>
                <th>Message</th>
                <th>Location</th>
                <th>Image</th>
                <th>Status</th>
                <th>Username</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
            <?php if ($result->num_rows > 0) : ?>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['cake_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['price']); ?></td>
                        <td><?php echo htmlspecialchars($row['weight']); ?></td>
                        <td><?php echo htmlspecialchars($row['message']); ?></td>
                        <td><?php echo htmlspecialchars($row['location']); ?></td>
                        <td><img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Cake Image" style="width: 100px;"></td>
                        <td><?php echo htmlspecialchars($row['status']); ?></td>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                        <td>
                            <form action="update-order.php" method="post" style="display:inline;">
                                <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="action" value="accept">
                                <button type="submit" class="btn btn-accept">Accept</button>
                            </form>
                            <form action="update-order.php" method="post" style="display:inline;">
                                <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="action" value="decline">
                                <button type="submit" class="btn btn-decline">Decline</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else : ?>
                <tr>
                    <td colspan="11">No orders found</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>

</html>

<?php
$conn->close();
?>

<?php
session_start();
require 'admin_db_config.php'; // Assuming this file contains the database connection details

// Check if the user is logged in
if (!isset($_SESSION['admin_username'])) {
    header("Location: admin-login.php");
    exit();
}

// Fetch orders data from the database
$stmt = $conn->prepare("SELECT * FROM orders");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: sans-serif;
        }



        body {
            background-image: url('admin/assets/about02.jpg');
            background-position: center;
            background-size: cover;
            height: 100%;
            width: 100%;

            /* background-color: #80808042; */
            background-image: linear-gradient(#ff00fca3, #00e7ff4f, #ff004957);
        }

        html {
            scroll-behavior: smooth;
        }

        @media (max-width: 768px) {
            .container {
                /* width: 100%; */

                box-shadow: 5px 10px 5px #808080;
                height: 100%;
                background-image: linear-gradient(#ff00fca3, #00e7ff4f, #ff004957);
                display: flex;
                flex-direction: column;
            }

            .box {
                display: grid;
                grid: 150px / auto auto auto;
                /* background-color: rgba(0, 0, 0, 0.55); */
                /* width: 439px; */
                /* margin: auto -12px; */

            }




        }

        @media (max-width: 1200px) {
            .container {
                /* width: 100%; */
                height: 100%;
                background-image: linear-gradient(#ff00fca3, #00e7ff4f, #ff004957);
            }

            .box {
                display: flex;
                flex-direction: column;

                /* margin-left: -350px; */
            }




        }

        .container {
            display: flex;
            flex-direction: column;
            /* justify-content: center; */
            align-items: center;
            gap: 20px;
            border: 2px solid red;
            margin: 60px 170px;
            background-color: whitesmoke;
            box-shadow: 5px 5px 10px 5px #808080;
            padding: 40px 0px;
            height: 600px;
        }

        .container h2 {
            font-size: 45px;

        }

        .container h3 {
            font-size: 36px;
        }

        .box {
            /* border: 2px solid green; */
            display: flex;
            margin: 10px 15px;
            gap: 20px;
            background-image: linear-gradient(#ff00fc0f, #9100ff4f, #48ff002b);
            box-shadow: 5px 5px 10px 5px #808080;
        }
    </style>
</head>

<body>
    <div class="container">


        <h2>Welcome, <?php echo $_SESSION['admin_username']; ?></h2>
        <!-- <a href="logout.php">Logout</a> -->
        <h3><u>Orders</u></h3>

        <div class="box">


            <?php

            if ($result !== null) {
                // Check if there are orders
                if ($result->num_rows > 0) {
                    // Output orders data
                    while ($row = $result->fetch_assoc()) {
                        echo "Order ID: " . $row['id'] . "<br>";
                        echo "Username: " . $row['username'] . "<br>";
                        echo "Cake Name: " . $row['cake_name'] . "<br>";
                        echo "Price: " . $row['price'] . "<br>";
                        echo "Weight: " . $row['weight'] . "<br>";
                        echo "Message: " . $row['message'] . "<br>";
                        echo "Location: " . $row['location'] . "<br>";
                        // echo "Order Status: " . $row['order_status'] . "<br>";
                        echo "<hr>";
                    }
                } else {
                    echo "No orders found.";
                }
            } else {
                echo "Error fetching orders data.";
            }
            ?>
        </div>
    </div>

</body>

</html>

<?php
$stmt->close();
$conn->close();
?>
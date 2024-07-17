<?php
require 'db_config.php';
session_start();

if (isset($_GET['email'])) {
    $email = $_GET['email'];

    // Retrieve user data from the database
    $stmt = $conn->prepare("SELECT username, email, phone, image FROM customers WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($username, $email, $phone, $image);
    $stmt->fetch();
    $stmt->close();
    $conn->close();
} else {
    echo "No user specified.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: sans-serif;
        }



        body {
            background-image: url('customer/assets/about01.jpg');
            background-position: center;
            background-size: cover;


            /* background-color: #80808042; */
            background-image: linear-gradient(#ff00fca3, #00e7ff4f, #ff004957);
        }

        html {
            scroll-behavior: smooth;
        }

        @media (max-width: 768px) {
            .container {
                display: flex;
                flex-direction: column;
            }

            .container img {
                width: 100%;
            }


        }

        @media (max-width: 1200px) {
            .container {
                display: flex;
                flex-direction: column;
            }

            .container img {
                width: 100%;
            }


        }

        .container {
            /* border: 2px solid black; */
            display: flex;
            justify-content: space-around;
            align-items: center;
            position: relative;
            margin: 60px 170px;
            background-color: whitesmoke;
            box-shadow: 5px 5px 10px 5px #808080;
            padding: 40px 0px;
            height: 600px;
        }

        .box {
            /* border: 2px solid red; */
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 20px;
        }

        .box h2 {
            text-align: center;
            font-size: 40px;
            font-weight: 500;
            font-family: sans-serif;
        }

        .box p {
            font-size: 24px;
            font-style: italic;
        }

        .box strong {
            font-size: 20px;
        }
    </style>


</head>

<body>
    <div class="container">
        <div class="img-box">
            <?php if ($image) : ?>
                <p><strong>Profile Image:</strong></p>
                <img src="<?php echo htmlspecialchars($image); ?>" alt="Profile Image" style="max-width: 200px;">
            <?php endif; ?>
        </div>
        <div class="box">


            <h2>User Information</h2>
            <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
            <p><strong>Phone:</strong> <?php echo htmlspecialchars($phone); ?></p>
        </div>

        <button class="btn">
            <a href=""></a>

        </button>
    </div>

</body>

</html>
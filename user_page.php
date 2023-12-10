<?php
    session_start();
    if (!isset($_SESSION['logged_in'])) {
        header('LOCATION: login.php');
        die();
    }
    $servername = "hermes.waketech.edu";
    $username = "jdiveris";
    $dbname = "test";
    $mysql_password = "csc124";

    $conn = mysqli_connect($servername, $username, $mysql_password, $dbname);
    if ($conn->connect_error) {
        die("\nConnection failed: " . mysqli_connect_error());
    }
    $user_id = $_SESSION["user_id"];
    $sql = "UPDATE orders SET active = 'FALSE' WHERE end_date < CURDATE() AND user_id = '$user_id';";
    mysqli_query($conn, $sql);
    $sql = "SELECT order_id, subscription_id, end_date, active FROM orders WHERE user_id = '$user_id' ORDER BY order_id DESC LIMIT 1;";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_array(MYSQLI_NUM);
    $order_id = $row[0];
    $subscription_id = $row[1];
    $end_date = date('M d, Y', strtotime($row[2]));
    $active = $row[3];
    $subscription_desc = [
        1 => "Standard - 1 Month Subscription",
        2 => "Standard - 6 Month Subscription",
        3 => "Standard - 1 Year Subscription",
        4 => "Plus - 1 Month Subscription",
        5 => "Plus - 6 Month Subscription",
        6 => "Plus - 1 Year Subscription",
        7 => "Premium - 1 Month Subscription",
        8 => "Premium - 6 Month Subscription",
        9 => "Premium - 1 Year Subscription"
    ];
    $sql = "SELECT last_name, first_name, email, phone_num FROM users WHERE user_id = '$user_id';";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_array(MYSQLI_NUM);

    $last_name = $row[0];
    $first_name = $row[1];
    $email = $row[2];
    $phone_num = $row[3];
    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        /* moved to style.css
        body {
            background-color: lightblue;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: lightblue;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .user-info,
        .subscription-info {
            margin-top: 20px;
        }

        .user-info p,
        .subscription-info p {
            margin: 5px 0;
        }

        .subscription-info {
            background-color: #fff;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        nav {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 15px;
        }

        nav a {
            text-decoration: none;
            color: white;
            font-weight: bold;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: #ffcc00;
        }*/
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="logout.php">Logout</a></li>
            <li><a href="about.html" target="_blank">About RetroStream</a></li>
        </ul>
    </nav>
    <div class="container">
        <h2>User Information</h2>
        <div class="user-info">
            <?php
                echo "<p><strong>Name:</strong> $first_name $last_name</p>";
                echo "<p><strong>Email:</strong> $email</p>";
                echo "<p><strong>Phone Number:</strong> $phone_num</p>";
                echo "<p><strong>User ID:</strong> $user_id</p>";
            ?>
        </div>
        <div class="subscription-info">
            <?php
                if ($active == "TRUE") {
                    echo "<p><strong>Subscription:</strong> {$subscription_desc[$subscription_id]}</p>";
                    echo "<p><strong>Status:</strong> ACTIVE Until $end_date </p>";
                } elseif ($active == "FALSE") {
                    echo "<p><strong>Subscription:</strong> {$subscription_desc[$subscription_id]}</p>";
                    echo "<p><strong>Status:</strong> INACTIVE Since $end_date </p>";
                }
            ?>
        </div>
        <a href="subscription_management.php">Manage Subscriptions</a>
    </div>
    <footer>
        <p>This page was created by .... </p>
    </footer>
</body>
</html>

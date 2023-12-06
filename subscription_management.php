<!DOCTYPE html>
<!---Author: John Diveris
    Date: 2023-12-05
    File: subscription_management.php
    Purpose: Update and Manage Subscription Options
    Updated: 2023-12-06
--->
<html>
<head>
    <title>Manage Subscription</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <nav>
        <a href="user_page.php">Back to Your Profile</a>
    </nav>
    <h1>Current Subscription :</h1>
    <br>
<?php

    session_start();
    $user_id = $_SESSION["user_id"];
    $servername = "hermes.waketech.edu";
    $username = "jdiveris";
    $dbname = "test";
    $mysql_password = "csc124";

    $conn = mysqli_connect($servername, $username, $mysql_password, $dbname);
    if ($conn->connect_error){
        die("\nConnection failed: " . mysqli_connect_error());
    }

    $sql = "UPDATE orders SET active = 'FALSE' WHERE end_date < CURDATE() AND user_id = '$user_id;";
    mysqli_query($conn, $sql);

    $sql = "SELECT order_id, subscription_id, end_date, active FROM orders WHERE user_id = '$user_id' ORDER BY end_date DESC LIMIT 1;";
    $result = mysqli_query($conn, $sql);
    
    $row = mysqli_fetch_array($result);
    $order_id = $row[0];
    $subscription_id = $row[1];
    $end_date = $row[2];
    $active = $row[3];
    
    $end_date = date('M d, Y', (strtotime($end_date)));

    if ($subscription_id == 1){
        $subscription_desc = "Standard - 1 Month Subscription";
    }elseif ($subscription_id == 2){
        $subscription_desc = "Standard - 6 Month Subscripton";
    }elseif ($subscription_id == 3){
        $subscription_desc = "Standard - 1 Year Subscription";
    }elseif ($subscription_id == 4){
        $subscription_desc = "Plus - 1 Month Subscription";
    }elseif ($subscription_id == 5){
        $subscription_desc = "Plus - 6 Month Subscripton";
    }elseif ($subscription_id == 6){
        $subscription_desc = "Plus - 1 Year Subscription";
    }elseif ($subscription_id == 7){
        $subscription_desc = "Premium - 1 Month Subscription";
    }elseif ($subscription_id == 8){
        $subscription_desc = "Premium - 6 Month Subscripton";
    }elseif ($subscription_id == 9){
        $subscription_desc = "Premium - 1 Year Subscription";
    }

    if ($active == "TRUE"){
        echo "<p><b>$subscription_desc</b> | Status : ACTIVE Until $end_date </p>";
    }elseif ($active == "FALSE"){
        echo "<p><b>$subscription_desc</b> | Status : INACTIVE Since $end_date </p>";
    }
    
    ?>
    <br>
    <h1>Update Your Subscription :</h1>
    <br>
    <form action="update_confirm.php" method="post">
        <div class="pick_sub">
            <div>
                <input type="radio" name="subscription" id="standard" value="standard" required>
                <label for="standard">
                    <span>Standard Subscription :</span>
                    <ul>
                        <li>Unlimited Streams From Main Catalogue</li>
                        <li>With Ads</li>
                    </ul>
                    <label for="standard_term">Term :</label>
                    <select name="standard_term" id="standard_term">
                        <option value="0">-- None --</option>
                        <option value="1">1 Month - $9.99 a Month</option>
                        <option value="6">6 Months - $7.99 a Month</option>
                        <option value="12">12 Months - $5.99 a Month</option>
                    </select>
                </label>
            </div>
            <div>
                <input type="radio" name="subscription" id="plus" value="plus">
                <label for="plus">
                    <span>Plus Subscription :</span>
                    <ul>
                        <li>Unlimited Streams From Main Catalogue</li>
                        <li>Exclusive Access To Plus Catalogue</li>
                        <li>With Ads</li>  
                    </ul>
                    <label for="plus_term">Term :</label>
                    <select name="plus_term" id="plus_term">
                        <option value="0">-- None --</option>
                        <option value="1">1 Month - $12.99 a Month</option>
                        <option value="6">6 Months - $10.99 a Month</option>
                        <option value="12">12 Months - $8.99 a Month</option>
                    </select>
                </label>
            </div>
            <div>
                <input type="radio" name="subscription" id="premium" value="premium">
                <label for="premium">
                    <span>Premium Subscription :</span>
                    <ul>
                        <li>Unlimited Streams From Main Catalogue</li>
                        <li>Exclusive Access To Plus Catalogue</li>
                        <li>Watch Offline via Downloads</li>
                        <li>No Ads</li>  
                    </ul>
                    <label for="premium_term">Term :</label>
                    <select name="premium_term" id="premium_term">
                        <option value="0">-- None --</option>
                        <option value="1">1 Month - $15.99 a Month</option>
                        <option value="6">6 Months - $13.99 a Month</option>
                        <option value="12">12 Months - $11.99 a Month</option>
                    </select>
                </label>
            </div>
        </div>
        <br>
        <br>
        <div>
            <button type="submit"> Update </button>
        </div>
    </form>
</body>
</html>
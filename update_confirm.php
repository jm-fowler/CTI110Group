<!DOCTYPE html>
<!---Author: John Diveris
    Date: 2023-12-06
    File: update_confirm.php
    Purpose: Confirm and Update Subscription Data
    Updated: 2023-12-06
--->
<html>
<head>
    <title>Confirmation</title>
    <link rel="stylesheet" href="style.css"/>
</head>

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

    $user_sub = $_POST['subscription'];
    $today_date = date_create();
    $user_sub_start = date_format($today_date,"Y-m-d");
    $user_sub_end = $today_date;
    $error = 0;

    if ($user_sub == "standard"){
        $user_sub_term = $_POST['standard_term'];
        if ($user_sub_term == 1){
            $user_sub_id = 1;
            $interval = date_interval_create_from_date_string('1 Month');
            $user_sub_end = date_add($today_date, $interval);
            $user_sub_end = date_format($user_sub_end,"Y-m-d");
        }
        if ($user_sub_term == 6){
            $user_sub_id = 2;
            $interval = date_interval_create_from_date_string('6 Months');
            $user_sub_end = date_add($today_date, $interval);
            $user_sub_end = date_format($user_sub_end,"Y-m-d");
        }
        if ($user_sub_term == 12){
            $user_sub_id = 3;
            $interval = date_interval_create_from_date_string('12 Months');
            $user_sub_end = date_add($today_date, $interval);
            $user_sub_end = date_format($user_sub_end,"Y-m-d");
        }
    } elseif ($user_sub == "plus") {
        $user_sub_term = $_POST['plus_term'];
        if ($user_sub_term == 1){
            $user_sub_id = 4;
            $interval = date_interval_create_from_date_string('1 Month');
            $user_sub_end = date_add($today_date, $interval);
            $user_sub_end = date_format($user_sub_end,"Y-m-d");
        }
        if ($user_sub_term == 6){
            $user_sub_id = 5;
            $interval = date_interval_create_from_date_string('6 Months');
            $user_sub_end = date_add($today_date, $interval);
            $user_sub_end = date_format($user_sub_end,"Y-m-d");
        }
        if ($user_sub_term == 12){
            $user_sub_id = 6;
        }
    } elseif ($user_sub == "premium") {
        $user_sub_term = $_POST['premium_term'];
        if ($user_sub_term == 1){
            $user_sub_id = 7;
            $interval = date_interval_create_from_date_string('1 Month');
            $user_sub_end = date_add($today_date, $interval);
            $user_sub_end = date_format($user_sub_end,"Y-m-d");
        }
        if ($user_sub_term == 6){
            $user_sub_id = 8;
            $interval = date_interval_create_from_date_string('6 Months');
            $user_sub_end = date_add($today_date, $interval);
            $user_sub_end = date_format($user_sub_end,"Y-m-d");
        }
        if ($user_sub_term == 12){
            $user_sub_id = 9;
            $interval = date_interval_create_from_date_string('12 Months');
            $user_sub_end = date_add($today_date, $interval);
            $user_sub_end = date_format($user_sub_end,"Y-m-d");
        }
    }

    if ($user_sub_term == 0){
        $error = 1;
    } 

    if ($error == 0){
        $sql = "INSERT INTO orders (user_id, subscription_id, start_date, end_date, active)
        VALUES ('$user_id','$user_sub_id','$user_sub_start','$user_sub_end', 'TRUE');";
        mysqli_query($conn,$sql);

        $sql = "SELECT order_id, subscription_id, end_date FROM orders WHERE user_id = '$user_id' ORDER BY end_date DESC LIMIT 1;";
        $result = mysqli_query($conn, $sql);
        
        $row = mysqli_fetch_array($result);
        $order_id = $row[0];
        $subscription_id = $row[1];
        $end_date = $row[2];
        
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
    }
?>

<body>
    <nav>
        <a href="user_page.php">Back to Your Profile</a>
    </nav>
    <?php

        if ($error == 0){
            echo "<h1 align=\"center\">Thank You! Your Profile has been Updated</h1><ul align=\"center\" style=\"list-style-type:none;\"><li>$subscription_desc</li><li>Ends on ... $end_date</li></ul>";
        }elseif ($error == 1){
            echo "<h1 align=\"center\">Oops...</h1><<ul align=\"center\" style=\"list-style-type:none;\"><li class=\"error\" style=\"color:red\">Please Select A Corresponding Subscription Term</li></ul>";
            echo "<br><br><div align=\"center\"><a href=\"subscription_management.php\">Try Again</a></div>";
        }else {
            echo "<h1 align=\"center\">Oops...</h1>";
            echo "<br><br><div align=\"center\"><a href=\"subscription_management.php\">Try Again</a></div>";
        }

    ?>

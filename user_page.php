<<<<<<< HEAD
<?php
    if ($_SESSION["logged_in"] = false || $_SESSION["user_id"] = "") {


    }

<!DOCTYPE html>
<html>
    <head>
        <title>Login Page</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>
      <h2><center>Stand-in page for testing</center></h2>
    </body>
    <footer>
        <p>This page was created by .... </p>
    </footer>
</html>

=======
<!DOCTYPE html>
<html>
    <head>
        <title>User Page</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    
    <?php

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

        $sql = "SELECT last_name, first_name, email, phone_num FROM users WHERE user_id = '$user_id';";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);

        $last_name = $row[0];
        $first_name = $row[1];
        $email = $row[2];
        $phone_num = $row[3];
    
    ?>
    <body>
        <?php

            echo "<p>$first_name</p>";
            echo "<p>$last_name</p>";
            echo "<p>$email</p>";
            echo "<p>$phone_num</p>";

        ?>

        <h2><center>Stand-in page for testing</center></h2>
        <br><br>
        
        <?php

            
            if ($active == "TRUE"){
                echo "<p><b>$subscription_desc</b> | Status : ACTIVE Until $end_date </p>";
            }elseif ($active == "FALSE"){
                echo "<p><b>$subscription_desc</b> | Status : INACTIVE Since $end_date </p>";
            }
            

        ?>
       
        <a href="subscription_management.php">Manage Subscriptions</a>

    </body>
    <footer>
        <p>This page was created by .... </p>
    </footer>
</html>
>>>>>>> main

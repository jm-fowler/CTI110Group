<!DOCTYPE html>
<!---Author: Justin Fowler
    Date: 2023-11-22
    File: login.php
    Purpose: login page
--->
<html>
    <head>
        <title>Login Page</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>
      <h2><center>Login</center></h2>
      <form action="login.php" method="post">
        <label for="user_email">Email</label>
        <input type="email" id="user_email" name="user_email"><br>
        <label for="user_password">Password</label>
        <input type="password" id="user_password" name="user_password"><br>
        <label for="SUBMIT">Submit</label>
        <input type="submit" id="SUBMIT">
        <?php
            $user_email = $_POST['user_email'];
            $user_password = $_POST['user_password'];

            if(empty(trim($POST["user_email"]))){
                echo "\nPlease enter your email";
            } else{trim($user_email);
            }

            if(empty(trim($user_password))){
                echo "\nPlease enter your password";
            } else{trim($user_password);
            }

            $servername = "hermes.waketech.edu";
            $username = "jdiveris";
            $dbname = "jdiveris";
            $password = "csc124";

            $conn = mysqli_connect($servername, $username, $password, $dbname); 
            if ($conn->connect_error) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "SELECT user_id email password FROM users where email = $email;";
            if (mysqli_num_rows($result) <= 0){
                echo "\nError: Username not found";
            }
            $result = mysqli_query($conn, $sql);

            if(strcmp($password, $user_password)){
                header("location user_creation.html");
            } else{
                <br>
                echo "\nError: Incorrect password";
            }
        ?>
    </body>
    <footer>
        <p>This page was created by .... </p>
    </footer>
</html>

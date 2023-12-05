<?php
    function find_user_by_user_email(string $user_email)
    {
        $sql = 'SELECT email, password
                FROM users
                WHERE email=:email';

        $statement = db()->prepare($sql);
        $statement->bindValue(':email', $user_email, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }
?>

<!DOCTYPE html>
/* Author: Justin Fowler
    Date: 2023-11-22
    File: login.php
    Purpose: login page
*/
<html>
    <head>
        <title>Login Page</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>

    <?php
        ini_set('display_errors', 1);

        # $user_email = "";
        # $user_password = "";
        $errors = [];

        if ($errors) {
            redirect_with('login.php', ['errors' => $errors]






        /*$_SESSSION['user_email'] = $_POST['user_email'];
        $_SESSSION['user_password'] = $_POST['user_password'];
        $_SESSSION[''] = $_POST[''];*/

        # debugging
        $email = '',0);
        $password = 'password';
        # end debugging

        # some debugging messages
        /*echo "\n";
        echo $_SESSSION['user_email'];
        echo "\n";
        echo $_SESSSION['user_password'];*/
        # end of debugging messages

        /*if(empty(trim($POST["user_email"]))){
            echo "\nPlease enter your email";
        } else{trim($user_email);
        }

        if(empty(trim($user_password))){
            echo "\nPlease enter your password";
        } else{trim($user_password);
        }*/
        mysqli_stmt_bind_result ($GLOBALS[''], $_SESSION[''], $_SESSION[''],
        $servername = 'hermes.waketech.edu';
        $mysql_username = 'jdiveris';
        $dbname = 'test';
        $mysql_password = 'csc124';

        $conn = mysqli_connect($servername, $mysql_username, $mysql_password, $dbname);
        if ($conn->connect_error) {
            die("\nConnection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT user_id, email, password FROM users WHERE email = $user_email";
        if (mysqli_num_rows($result) <= 0){
            echo "\nError: Username not found";
        }

        $result = mysqli_query($conn, $sql);
        mysqli_stmt_bind_result($result, $id, $email, $password);
        
        # some debugging messages
        echo "\n";
        echo $result;
        echo "\n";
        echo $id;
        echo "\n";
        echo $email;
        echo "\n";
        echo $password;
        # end debugging messages

        mysqli_stmt_store_result($result);

        if(strcmp($password, $_SESSION['$user_password']) == 0){
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $id;
            header("location: user_page.html");
        } else{
            echo "\nError: Incorrect password";
        }

        # debugging messages
        echo "\n";
        echo $_SESSION["loggedin"];
        echo "\n";
        echo $_SESSION["user_id"];
        echo "\n";
        echo $_SESSION["password"];
        # end debugging messages

    ?>
      <h2><center>Login</center></h2>
      <form action="login.php" method="post">
        <label for="user_email">Email</label>
        <input type="email" id="user_email" name="user_email"><br>
        <label for="user_password">Password</label>
        <input type="password" id="user_password" name="user_password"><br>
        <label for="SUBMIT">Submit</label>
        <input type="submit" id="SUBMIT">
    <p>Don't have an account
    <a href="user_creation.html"> Create a new account</a></p>
    </body>
    <footer>
        <p>This page was created by .... </p>
    </footer>
</html>

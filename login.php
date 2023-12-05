<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta charset="UTF-8"
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
<main>
    <form action="login.php" method="post">
        <h1><center>Login</center></h1>
        <div>
            <label for="email">Email: </label>
            <input type="email" name="email" id="email">
        </div>
        <div>
            <label for="password">Password: </label>
            <input type="password" name="password" id="password">
        </div>
        <section>
            <button type="submit">Login</button>
            <a href="user_creation.html">Create New User</a>
        </section>
    </form>
<?php

    $inputs = [];
    $errors = [];
    $user_email = [];
    $user_password = [];

    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    $servername = "hermes.waketech.edu";
    $username = "jdiveris";
    $dbname = "test";
    $mysql_password = "csc124";

    $conn = mysqli_connect($servername, $username, $mysql_password, $dbname);
    if ($conn->connect_error){
        die("\nConnection failed: " . mysqli_connect_error());
    }

    $sql = 'SELECT email password
            FROM users
            WHERE email=:email';

    mysqli_stmt_bind_param(':email', $email);
    return $statement->fetch(PDO::FETCH_ASSOC);

    $sql = "SELECT email FROM users where email = '$user_email';";
    $result = mysqli_query($conn, $sql);


    if ($errors) {

        redirect_with('login.php', ['errors'=> $errors, 'inputs' => $inputs]);
    }
?>

</main>
</body>
</html>



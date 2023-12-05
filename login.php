<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta charset="UTF-8">
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

    $errors = [];

    $user_email = $_POST['email'];
    $user_password = $_POST['password'];

    $servername = "hermes.waketech.edu";
    $username = "jdiveris";
    $dbname = "test";
    $mysql_password = "csc124";

    $conn = mysqli_connect($servername, $username, $mysql_password, $dbname);
    if ($conn->connect_error){
        die("\nConnection failed: " . mysqli_connect_error());
    } else {
        echo "Connected successfully"; 
    }

    $query = "SELECT email, password FROM users WHERE email=?"; 
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $user_email);
    $stmt->execute(); 
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($user_password == $row["password"]) {
                echo "Login successful"; 
            } else {
                echo "Incorrect password";
            }
        }
    } else {
        echo "Email not found";
        # $errors = "emailnotfound";
    }
    $stmt->close();
    $conn->close();

    /* if ($errors) {
        redirect_with('login.php', ['errors'=> $errors, 'inputs' => $inputs]);
    }*/
?>

</main>
</body>
</html>



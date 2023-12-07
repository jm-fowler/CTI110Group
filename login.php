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
        <h1>Login</h1>
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
        </section>
    </form>
    <br>
    <p>Don't have a user account?
    <a href="user_creation.html">Create a New User</a></p>
<?php
    session_start();
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

    $query = "SELECT user_id, email, password FROM users WHERE email=?"; 
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $user_email);
    $stmt->execute(); 
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($user_password == $row["password"]) {
                echo "Login successful"; 
                $_SESSION["logged_in"] = true;
                $_SESSION["user_id"] = $row["user_id"];
                header("Location: ./user_page.php");
                exit();
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
        header("Location: ./login.php");
        redirect_with('login.php', ['errors'=> $errors, 'inputs' => $inputs]);
        exit();
    }*/
?>

</main>
</body>
</html>



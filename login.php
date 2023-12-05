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
    function find_user_by_email(string $email) {

        $sql = 'SELECT email password
                FROM users
                WHERE email=:email';

        $statement =db()->prepare($sql);
        $statement->bindValue(':email', $email, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }


    $inputs = [];
    $errors = [];

    if ($errors) {

        redirect_with('login.php', ['errors'=> $errors, 'inputs' => $inputs]);
    }
?>

</main>
</body>
</html>



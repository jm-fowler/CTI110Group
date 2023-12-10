<?php
    session_start();
    if(!isset($_SESSION['logged_in'])) {
        header('LOCATION:login.php');
        die();
    }
?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Logout</title>
</head>
<body>
<main>
    <form action="logout.php" method="post">
        <h1>Login</h1>
        <div>
            <p>Are you sure you want to logout</p>
            <label for="logout">Yes</label>
            <input type="radio" name="logout" id="logout">
            <br>
            <label for="stay">No</label>
            <input type="radio" name="stay" id="stay">
        </div>
        <section>
            <button type="submit">Submit</button>
        </section>
    </form>
</main>
<?php
    $logout = $_POST['logout'];
    $stay = $_POST['stay'];

    if($logout == true){
        $logged_in = false;
        session_destroy();
        header("LOCATION: ./home.html");
        die();
    }
    if($stay == true){
        header("LOCATION: ./home.php");
        die();
    }
?>
</body>
</html>

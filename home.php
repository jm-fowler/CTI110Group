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
    <title>Login</title>
</head>
<body>
<main>
  <nav>
    <ul>
      <li><a href="user_page.php">User Page</a>
      <li><a href="logout.php">Logout</a>
      <li><a href="about.html" target="_blank">About RetroStream</a>
    </ul>
  </nav>
  <body>
    <center><img src="Meopta_Admira_8F_5.crop.resize.jpg"></center>
    <h1>Welcome to RetroStream</h1>
    <center><h2>Where Old Film is Reborn</h2></center>
    <h3>Watch Next:</h3>
    <figure>
      <video controls>
        <source src="First_flights_in_aviation_history.ogv" type="video/ogg">
      <figcaption><p>A newsreel from 1945 that shows some of the early history of flight.</p></figcaption>
    </figure>
    <figure>
      <video width="400" controls>
        <source src="Jumeaux_Davidson_1902c_Colour_Film.ogg" type="video/ogg">
      <figcaption><p>One of the first color films</p></figcaption>
    </figure>
  </body>
</main>
</body>
</html>

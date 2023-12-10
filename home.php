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
    <title>Home</title>
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
    <center><img src="Meopta_Admira_8F_5.crop.resize.jpg" alt="RetroStream Logo"></center>
    <h1>Welcome to RetroStream</h1>
    <center><h2>Where Old Film is Reborn</h2></center>
    <h3>Watch Next:</h3>
    <figure>
      <hr>
      <h3>First_flights_in_aviation_history.ogv<h3>
      <p>A newsreel from 1945 that shows some of the early history of flight.</p>
      <video controls>
        <source src="First_flights_in_aviation_history.ogv" type="video/ogg">
      <br>
    </figure>
    <figure>
      <hr>
      <h3>Jumeaux_Davidson_1902c_Colour_Film.ogg<h3>
      <p>One of the first color films</p>
      <video width="400" controls>
        <source src="Jumeaux_Davidson_1902c_Colour_Film.ogg" type="video/ogg">
      <br>
    </figure
  </body>
</main>
</body>
</html>

<!DOCTYPE html>
<!---Author: John Diveris
    Date: 2023-11-29
    File: user_creation.php
    Purpose: Add User to Database & Select Subscription
    Updated: 2023-12-05
        - Better error message functionality added
--->
 <html>
    <head>
        <title>User Creation</title>
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <?php
            
            $user_first_name = $_POST['first_name'];
            $user_last_name = $_POST['last_name'];
            $user_phone_num = $_POST['phone_num'];
            $user_email = $_POST['email'];
            $user_password = $_POST['password'];
            $user_sub = $_POST['subscription'];
            $today_date = date_create();
            $user_sub_start = date_format($today_date,"Y-m-d");
            $user_sub_end = $today_date;
            $error = 0;

            $servername = "hermes.waketech.edu";
            $username = "jdiveris";
            $dbname = "test";
            $mysql_password = "csc124";

            $conn = mysqli_connect($servername, $username, $mysql_password, $dbname);
            if ($conn->connect_error){
                die("\nConnection failed: " . mysqli_connect_error());
            }

            $sql = "SELECT email FROM users WHERE email = '$user_email';";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) <= 0){
                $sql = "INSERT INTO users (last_name, first_name, email, phone_num, password)
                VALUES ('$user_last_name', '$user_first_name', '$user_email', '$user_phone_num', '$user_password')";
                mysqli_query($conn,$sql);
            } else{
                $error = 1;
            }
            
            if ($user_sub == "standard"){
                $user_sub_term = $_POST['standard_term'];
                if ($user_sub_term == 1){
                    $user_sub_id = 1;
                    $interval = date_interval_create_from_date_string('1 Month');
                    $user_sub_end = date_add($today_date, $interval);
                    $user_sub_end = date_format($user_sub_end,"Y-m-d");
                }
                if ($user_sub_term == 6){
                    $user_sub_id = 2;
                    $interval = date_interval_create_from_date_string('6 Months');
                    $user_sub_end = date_add($today_date, $interval);
                    $user_sub_end = date_format($user_sub_end,"Y-m-d");
                }
                if ($user_sub_term == 12){
                    $user_sub_id = 3;
                    $interval = date_interval_create_from_date_string('12 Months');
                    $user_sub_end = date_add($today_date, $interval);
                    $user_sub_end = date_format($user_sub_end,"Y-m-d");
                }
            } elseif ($user_sub == "plus") {
                $user_sub_term = $_POST['plus_term'];
                if ($user_sub_term == 1){
                    $user_sub_id = 4;
                    $interval = date_interval_create_from_date_string('1 Month');
                    $user_sub_end = date_add($today_date, $interval);
                    $user_sub_end = date_format($user_sub_end,"Y-m-d");
                }
                if ($user_sub_term == 6){
                    $user_sub_id = 5;
                    $interval = date_interval_create_from_date_string('6 Months');
                    $user_sub_end = date_add($today_date, $interval);
                    $user_sub_end = date_format($user_sub_end,"Y-m-d");
                }
                if ($user_sub_term == 12){
                    $user_sub_id = 6;
                }
            } elseif ($user_sub == "premium") {
                $user_sub_term = $_POST['premium_term'];
                if ($user_sub_term == 1){
                    $user_sub_id = 7;
                    $interval = date_interval_create_from_date_string('1 Month');
                    $user_sub_end = date_add($today_date, $interval);
                    $user_sub_end = date_format($user_sub_end,"Y-m-d");
                }
                if ($user_sub_term == 6){
                    $user_sub_id = 8;
                    $interval = date_interval_create_from_date_string('6 Months');
                    $user_sub_end = date_add($today_date, $interval);
                    $user_sub_end = date_format($user_sub_end,"Y-m-d");
                }
                if ($user_sub_term == 12){
                    $user_sub_id = 9;
                    $interval = date_interval_create_from_date_string('12 Months');
                    $user_sub_end = date_add($today_date, $interval);
                    $user_sub_end = date_format($user_sub_end,"Y-m-d");
                }
            }

            if ($user_sub_term == 0){
                $error = 2;
            } 
            
            $sql = "SELECT user_id FROM users where email = '$user_email';";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            $user_id = $row[0];

            $sql = "INSERT INTO orders (user_id, subscription_id, start_date, end_date, active)
            VALUES ('$user_id','$user_sub_id','$user_sub_start','$user_sub_end', 'TRUE');";
            mysqli_query($conn,$sql);

            if ($error == 0){
                header("location: login.html");
            }

        ?>
        <nav>
            <a href="login.html">Back to Login</a><br><br>
        </nav>
        <h1 align="center">Create a Profile</h1>
        <figure>
            <img src="user.jpg" width="300">
        </figure>
        <br>

        <?php

            if ($error != 0){
                echo "<h1><span class=\"error\" style=\"color:red\">Oops...</span></h1><br><ul style=\"list-style-type:none;\">";
                if ($error == 1){
                    echo "<li><span class=\"error\" style=\"color:red\"> This Email/Username is Already in Use</span><br></li></ul>";
                }
                if ($error == 2){
                    echo "<li><span class=\"error\" style=\"color:red\"> Please Select a Subscription Term</span><br></li></ul>";
                }
            }

        ?>
        <br>
        <form action="user_creation.php" method="post">
            <div class="user_info">
                <h2>User Information:</h2>
                <label for="first_name">First Name :</label><br>
                <input type="text" id="first_name" name="first_name" placeholder="First Name" required pattern="^[a-zA-Z \-]+$">
                <br>
                <label for="last_name">Last Name :</label><br>
                <input type="text" id="last_name" name="last_name" placeholder="Last Name" required pattern="^[a-zA-Z \-]+$">
                <br>
                <label for="phone_num">Phone Number :</label><br>
                <input type="text" id="phone_num" name="phone_num" placeholder="1234567890" required pattern="^[0-9]{10}$">
                <br>
                <label for="email">Email | Username :</label><br>
                <input type="email" id="email" name="email" placeholder="myname@email.com" required>
                <br>
                <label for="password">Set Password :</label><br>
                <input type="password" id="password" name="password" required pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,18}$"><br>
                <div>
                    <p>Password Must Contain:</p>
                    <ul>
                        <li>A minimum of 8 characters, no more than 18.</li>
                        <li>At least one letter.</li>
                        <li>At least one number.</li>
                        <li>At least one special character: <em>@ $ ! % * # ? &</em></li>
                    </ul>
                </div>
            </div>
            <div>
                <h2>Pick a Subscription:</h2>
                <br>
                <div class="sub_options">
                    <div class="pick_sub">
                        <input type="radio" name="subscription" id="standard" value="standard" required>
                        <label for="standard">
                            <span>Standard Subscription :</span>
                            <ul>
                                <li>Unlimited Streams From Main Catalogue</li>
                                <li>With Ads</li>
                            </ul>
                        </label>
                    </div>
                
                    <div class="pick_sub">
                        <input type="radio" name="subscription" id="plus" value="plus">
                        <label for="plus">
                            <span>Plus Subscription :</span>
                            <ul>
                                <li>Unlimited Streams From Main Catalogue</li>
                                <li>Exclusive Access To Plus Catalogue</li>
                                <li>With Ads</li>  
                            </ul>
                        </label>
                    </div>
                    
                    <div class="pick_sub">
                        <input type="radio" name="subscription" id="premium" value="premium">
                        <label for="premium">
                            <span>Premium Subscription :</span>
                            <ul>
                                <li>Unlimited Streams From Main Catalogue</li>
                                <li>Exclusive Access To Plus Catalogue</li>
                                <li>Watch Offline via Downloads</li>
                                <li>No Ads</li>  
                            </ul>
                        </label>
                    </div>
                    <div class="term_options">
                        <div class="pick_term">
                            <label for="standard_term" class="pick_term">Term :</label>
                            <div>
                                <select name="standard_term" id="standard_term">
                                    <option value="0">-- None --</option>
                                    <option value="1">1 Month - $9.99 a Month</option>
                                    <option value="6">6 Months - $7.99 a Month</option>
                                    <option value="12">12 Months - $5.99 a Month</option>
                                </select>
                            </div>
                        </div>
                        <div class="pick_term">
                            <label for="plus_term" class="pick_term">Term :</label>
                            <div>
                                <select name="plus_term" id="plus_term">
                                    <option value="0">-- None --</option>
                                    <option value="1">1 Month - $12.99 a Month</option>
                                    <option value="6">6 Months - $10.99 a Month</option>
                                    <option value="12">12 Months - $8.99 a Month</option>
                                </select>
                            </div>
                        </div>
                        <div class="pick_term">
                            <label for="premium_term" class="pick_term">Term :</label>
                            <div>
                                <select name="premium_term" id="premium_term">
                                    <option value="0">-- None --</option>
                                    <option value="1">1 Month - $15.99 a Month</option>
                                    <option value="6">6 Months - $13.99 a Month</option>
                                    <option value="12">12 Months - $11.99 a Month</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <div>
                <button type="submit"> Create User </button>
            </div>
        </form>
    </body>
 </html>
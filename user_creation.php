<!DOCTYPE html>
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
            $user_sub_term = $_POST['term'];

            $servername = "hermes.waketech.edu";
            $username = "jdiveris";
            $dbname = "test";
            $mysql_password = "csc124";

            $conn = mysqli_connect($servername, $username, $mysql_password, $dbname);
            if ($conn->connect_error){
                die("\nConnection failed: " . mysqli_connect_error());
            }

            $sql = "SELECT user_id email password FROM users where email = $user_email;";
            
            if (mysqli_num_rows($result) <= 0){
                $sql = "INSERT INTO users (last_name, first_name, email, phone_num, password)
                VALUES ($user_last_name, $user_first_name, $user_email, $user_phone_num, $user_password)";
                header("location: login.html");    
            } else{
                echo "\nEmail/Username Already in use";
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
            <div class="pick_sub">
                <h2>Pick a Subscription:</h2>
                <br>
                <div>
                    <input type="radio" name="subscription" id="standard" value="standard" required>
                    <label for="standard">
                        <span>Standard Subscription :</span>
                        <ul>
                            <li>Unlimited Streams From Main Catalogue</li>
                            <li>With Ads</li>
                        </ul>
                        <label for="standard_term">Term :</label>
                        <select name="term" id="standard_term">
                            <option value="0">-- None --</option>
                            <option value="1">1 Month - $9.99 a Month</option>
                            <option value="6">6 Months - $7.99 a Month</option>
                            <option value="12">12 Months - $5.99 a Month</option>
                        </select>
                    </label>
                </div>
                <div>
                    <input type="radio" name="subscription" id="plus" value="plus">
                    <label for="plus">
                        <span>Plus Subscription :</span>
                        <ul>
                          <li>Unlimited Streams From Main Catalogue</li>
                          <li>Exclusive Access To Plus Catalogue</li>
                          <li>With Ads</li>  
                        </ul>
                        <label for="plus_term">Term :</label>
                        <select name="term" id="plus_term">
                            <option value="0">-- None --</option>
                            <option value="1">1 Month - $12.99 a Month</option>
                            <option value="6">6 Months - $10.99 a Month</option>
                            <option value="12">12 Months - $8.99 a Month</option>
                        </select>
                    </label>
                </div>
                <div>
                    <input type="radio" name="subscription" id="premium" value="premium">
                    <label for="premium">
                        <span>Premium Subscription :</span>
                        <ul>
                          <li>Unlimited Streams From Main Catalogue</li>
                          <li>Exclusive Access To Plus Catalogue</li>
                          <li>Watch Offline via Downloads</li>
                          <li>No Ads</li>  
                        </ul>
                        <label for="premium_term">Term :</label>
                        <select name="term" id="premium_term">
                            <option value="0">-- None --</option>
                            <option value="1">1 Month - $15.99 a Month</option>
                            <option value="6">6 Months - $13.99 a Month</option>
                            <option value="12">12 Months - $11.99 a Month</option>
                        </select>
                    </label>
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
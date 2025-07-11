<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime Wars</title>
    <link rel="stylesheet" href="style/register.css">
    <link rel="icon" href="assets/logo.png">
</head>
<body>
    <header>
        <div class="nav-bar">
            <p class="webName"><img src="assets/logo.png" class="logo"><span></span>Anime Wars</p>
            <a class="homebtn" href="index.php">Home</a>
            <a class="loginbtn" href="login.php">Login</a>
        </div>
    </header>
    <main>
        <img src="assets/brook.webp" class="bg">
        <div class="register-container">
            <form action="register.php" method="POST">
                <h2>Register</h2>
                <hr>
                <input class="email" type="text" name="username" placeholder=" " required >
                <label class="emailLabel" for="username">Username</label><br>
                <input class="pass" type="password" name="password" placeholder=" " required>
                <label class="passLabel" for="password">Password</label><br>
                <input class="register" type="submit" value="Register">  
            </form>
            <button class="signupButton">Already a member? <span><a href="login.php">Login</a></span></button>
        </div>
    </main>
</body>
</html>

<?php
    $servername = "localhost";
    $username_db = "root";
    $password = "";
    $db_name = "accountdb";

    $conn = mysqli_connect($servername, $username_db, $password, $db_name);

    if(!$conn) {
        die("Connection Failed: ".mysqli_connect_error());
    } 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username=mysqli_real_escape_string($conn, $_POST['username']);
        $password=mysqli_real_escape_string($conn, $_POST['password']);

        $hashedpass = password_hash($password, PASSWORD_DEFAULT);

        $bool = true;

        $query = mysqli_query($conn, "SELECT * FROM user_tbl");

        while($row = mysqli_fetch_array($query)) {
            $table_users = $row['username'];

            if($username == $table_users){
                $bool = false;
                print '<script>alert("Username is not available!");</script>';

                print '<script> window.location.assign("register.php");</scipt>';
            }
        }

        if($bool) {
            mysqli_query($conn, "INSERT INTO user_tbl (username, password) VALUES('$username', '$hashedpass')");
            print '<script>alert("Successfully Registered!");</script>';
            Print '<script>window.location.assign("register.php");</script>';
        }
    }?>
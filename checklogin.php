<?php

    session_start();

    $servername = "localhost";
    $username_db = "root";
    $password = "";
    $db_name = "accountdb";

    $conn = mysqli_connect($servername, $username_db, $password, $db_name);

    if(!$conn) {
        die("Connection Failed: ".mysqli_connect_error());
    }  

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
    
        $query = mysqli_query($conn, "SELECT * FROM user_tbl WHERE username='$username'");
        $exist = mysqli_num_rows($query);
    
        if ($exist > 0) {
            $row = mysqli_fetch_assoc($query);
            $table_id = $row['id'];
            $table_password = $row['password']; 
            $correct = password_verify($password, $table_password);
            if ($correct) {
                $_SESSION['user'] = $username;
                $_SESSION['userID'] = $table_id;
                header("Location: home.php");
                exit();
            } else {
                echo '<script>alert("Incorrect Password!");</script>';
                echo '<script>window.location.assign("login.php");</script>';

            }
        } else {
            echo '<script>alert("Incorrect Username!");</script>';
            echo '<script>window.location.assign("login.php");</script>';
        }
    }
    
?>

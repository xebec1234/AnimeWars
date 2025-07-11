<?php
    session_start();
    if($_SESSION['user']){

    } else {
        header("location:index.php");
    }

    if($_SERVER['REQUEST_METHOD'] == "GET") {
        $servername = "localhost";
        $username_db = "root";
        $password_db = "";
        $db_name = "accountdb";

        $conn = mysqli_connect($servername, $username_db, $password_db, $db_name);
       
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $id = $_GET['id'];
        mysqli_query($conn, "DELETE FROM list_tbl WHERE id='$id'");
        header("location:home.php");
    }
?>
<?php
    session_start();
    
    if (!isset($_SESSION['user']) || !isset($_SESSION['userID'])) {
        header("location:index.php");
        exit();
    }
    
    $userid = $_SESSION['userID'];

    $servername = "localhost";
    $username_db = "root";
    $password = "";
    $db_name = "accountdb";

    $conn = mysqli_connect($servername, $username_db, $password, $db_name);

    if(!$conn) {
        die("Connection Failed: ".mysqli_connect_error());
    }   

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $context = mysqli_real_escape_string($conn, $_POST['context']);
        $details = mysqli_real_escape_string($conn, $_POST['details']);
        $time = strftime("%X");
        $date = strftime("%B %d, %Y");
        $decision = "no";

        foreach($_POST['public'] as $each_check) {
            if($each_check != null) {
                $decision = 'yes';
            }
        }

        mysqli_query($conn, "INSERT INTO list_tbl(userID, details, context, date_posted, time_posted, public) VALUES('$userid','$details', '$context', '$date','$time', '$decision')");
        header("location:home.php");

    } else {
        header("location:home.php");
    }
?>
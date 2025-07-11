<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime Wars</title>
    <link rel="stylesheet" href="style/edit.css">
    <link rel="icon" href="assets/logo.png">
</head>
<?php
    session_start();
    if (!isset($_SESSION['user']) || !isset($_SESSION['userID'])) {
        echo "Session not set properly.";
        header("location: login.php");
        exit();
    } 

    $user = $_SESSION['user'];
    $userid = $_SESSION['userID'];
    $id_exists = false;
?>
<body>
<header>
        <div class="nav-bar">
            <p class="webName"><img src="assets/logo.png" class="logo"><span></span>Anime Wars</p>
            <p class="user-name"><?php Print "$user"?></p> 
            <a class="homebtn" href="home.php">Home</a>
            <a class="logoutbtn" href="logout.php">logout</a>
        </div>
    </header>
    <div class="content-container">
        <h2 align = "center">Currently Selected</h2>
        <table>
            <tr>
                <th>Id</th>
                <th>Topic</th>
                <th>Text-Posted</th>
                <th>Post Time</th>
                <th>Edit Time</th>
                <th>Public Post</th>
            </tr>
                <?php
                    if(!empty($_GET['id'])) {
                        $id = $_GET['id'];
                        $_SESSION['id'] = $id;
                        $id_exists = true;

                        $servername = "localhost";
                        $username_db = "root";
                        $password_db = "";
                        $db_name = "accountdb";
                    
                        $conn = mysqli_connect($servername, $username_db, $password_db, $db_name);
                    
                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }

                        $query = mysqli_query($conn,"SELECT * FROM list_tbl WHERE id='$id'"); // SQL Query
                        $count = mysqli_num_rows($query);
                        if($count > 0) {
                            while($row = mysqli_fetch_array($query)) {
                                Print "<tr>";
                                    Print "<td>". $row['id'] . "</td>";
                                    Print "<td>". $row['details'] . "</td>";
                                    print "<td>".$row['context']."</td>";
                                    Print "<td>". $row['date_posted']. " - ".$row['time_posted']."</td>";
                                    Print "<td>". $row['date_edited']. " - ".$row['time_edited']. "</td>";
                                    Print "<td>". $row['public']. "</td>";
                                Print "</tr>";
                            }
                        } else {
                            $id_exists = false;
                        }
                    }
                ?>
        </table><br>
    </div>
    <?php
        if($id_exists) {
            print '<form action="edit.php" method="POST">
                Enter new context: <input type = "text" name = "context"/><br>
                public post? <input type="checkbox" name="public[]" value="yes"/><br>
                <input type="submit" value=Update List"/>
                </form>';
        } else {
            print '<h2 align="center">There is no data to be edited</h2>';
        }
    ?>
</body>
</html>

<?php
    if($_SERVER['REQUEST_METHOD'] == "POST") {
            $servername = "localhost";
            $username_db = "root";
            $password = "";
            $db_name = "accountdb";
        
            $conn = mysqli_connect($servername, $username_db, $password, $db_name);
        
            if(!$conn) {
                die("Connection Failed: ".mysqli_connect_error());
            }   

            $details = mysqli_real_escape_string($conn, $_POST['details']);
            $public = "no";
            $id = $_SESSION['id'];
            $time = strftime("%X");
            $date = strftime("%B %d, %Y");

            foreach($_POST['public'] as $list) {
                if($list != null) {
                    $public = 'yes';
                }
            }

        mysqli_query($conn, "UPDATE list_tbl SET details='$details', public='$public', date_edited='$date', time_edited='$time' WHERE id='$id'");
        header("location:home.php");
    }
?>
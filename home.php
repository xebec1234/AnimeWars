<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime Wars</title>
    <link rel="stylesheet" href="style/home.css">
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
?>
<body>
    <header>
        <div class="nav-bar">
            <p class="webName"><img src="assets/logo.png" class="logo"><span></span>Anime Wars</p>
            <p class="user-name"><?php Print "$user"?></p> 
            <a class="logoutbtn" href="logout.php">logout</a>
        </div>
    </header>
    <main>
        <div class="post-container">
            <form action="add.php" method="POST">
                <input class="post-text" type="text" name="context" placeholder="What's on your mind <?php Print "$user"?>?" required> <br/>
                <input class="topic-text" type="text" name="details" placeholder="Topic" required> <br/>
                Public post? <input type="checkbox" name="public[]" value="yes"> <br/>
                <input class="submit-post" type="submit" value="Add to list">
            </form>
        </div>
        <div class="content-container">
            <h2 align = "center">My list</h2>
            <table>
                <tr>
                    <th>Id</th>
                    <th>Topic</th>
                    <th>Text-Posted</th>
                    <th>Post Time</th>
                    <th>Edit Time</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>Public Post</th>
                </tr>
                    <?php
                        $servername = "localhost";
                        $username_db = "root";
                        $password = "";
                        $db_name = "accountdb";
                    
                        $conn = mysqli_connect($servername, $username_db, $password, $db_name);
                    
                        if(!$conn) {
                            die("Connection Failed: ".mysqli_connect_error());
                        }   

                        $query = mysqli_query($conn, "SELECT * FROM list_tbl WHERE userID='$userid'");
                        while($row = mysqli_fetch_array($query)) {
                            print "<tr>";
                                print "<td>".$row['id']."</td>";
                                print "<td>".$row['details']."</td>";
                                print "<td>".$row['context']."</td>";
                                print "<td>".$row['date_posted']. "-".$row['time_posted']."</td>";
                                print "<td>".$row['date_posted']. "-".$row['time_posted']."</td>";
                                print '<td><a href="edit.php?id=' . $row["id"] . '">Edit</a></td>';
                                print "<td><a href='#' onclick='myFunction(".$row['id'].")'>delete</a></td>";
                                print "<td>".$row['public']."</td>";
                            print "</tr>";
                        }
                    ?>
            </table>
            <script>
                function myFunction(id) {
                    var r = confirm("Are you sure you want to delete this record?");
                    if (r == true) {
                        window.location.assign("delete.php?id=" + id);
                    }
                }
            </script>
        </div>
    </main>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime Wars</title>
    <link rel="stylesheet" href="style/index.css">
    <link rel="icon" href="assets/logo.png">
</head>
<style>
    table, th, td {
        border: 1px solid black;
        text-align: center;
    }
    table {
        width: 100%;
        boder-collapse: collapse;
    }
</style>
<body>
    <header>
        <div class="nav-bar">
            <p class="webName"><img src="assets/logo.png" class="logo"><span></span>Anime Wars</p>
            <a class="loginbtn" href="login.php">Login</a>
            <a class="regbtn" href="register.php">Register</a>
        </div>
    </header>
    <main>
        <img src="assets/brook.webp" class="bg">
        <h2 align = "center">My list</h2>
        <div class="post-container">
        <?php
            $servername = "localhost";
            $username_db = "root";
            $password_db = "";
            $db_name = "accountdb";

            $conn = mysqli_connect($servername, $username_db, $password_db, $db_name);

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $query = mysqli_query($conn, "SELECT list_tbl.*, user_tbl.username
                FROM list_tbl
                JOIN user_tbl ON list_tbl.userID = user_tbl.id
                WHERE list_tbl.public = 'yes'
            ");

            while ($row = mysqli_fetch_array($query)) {
                echo '<div class="post">';
                    echo '<div class="post-header">';
                        echo '<span class="username">' . $row['username'] . '</span>';
                        echo '<span class="date-posted">' . $row['date_posted'] . ' at ' . $row['time_posted'] . '</span>';
                    echo '</div>';
                    echo '<div class="post-footer">';
                        echo 'Edited: ' . $row['date_edited'] . ' at ' . $row['time_edited'];
                    echo '</div>';
                    echo '<div class="post-body">';
                        echo '<span class = "topic"> Topic: '.$row['details'].'</span><br>';
                        echo $row['context'];
                    echo '</div>';
                echo '</div>';
            }
        ?>
        </div>
    </main>
</body>
</html> 
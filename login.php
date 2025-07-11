<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime Wars</title>
    <link rel="stylesheet" href="style/login.css">
    <link rel="icon" href="assets/logo.png">
</head>
<body>
    <header>
        <div class="nav-bar">
            <p class="webName"><img src="assets/logo.png" class="logo"><span></span>Anime Wars</p>
            <a class="homebtn" href="index.php">Home</a>
            <a class="regbtn" href="register.php">Register</a>
        </div>
    </header>
    <main>
        <img src="assets/brook.webp" class="bg">
        <div class="login-container">
            <form action="checklogin.php" method="POST">
                <h2>Login</h2>
                <hr>
                <input class="email" type="text" name="username" placeholder=" " required >
                <label class="emailLabel" for="username">Username</label><br>
                <input class="pass" type="password" name="password" placeholder=" " required>
                <label class="passLabel" for="password">Password</label><br>
                <input class="Login" type="submit" value="Login">  
            </form>
            <button class="signupButton">Not a member? <span><a href="register.php"> Sign up</a></span></button>
        </div>
    </main>
</body>
</html>

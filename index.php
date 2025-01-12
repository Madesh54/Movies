<?php
session_start();

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Path to the password file
    $passwordFile = 'app/data/password/password.json';

    // Check if the password file exists
    if (!file_exists($passwordFile)) {
        $error = "Password not found. Please contact the administrator.";
    } else {
        // Read the password data from the file
        $passwordData = json_decode(file_get_contents($passwordFile), true);

        // Validate the user input
        $password = trim($_POST['password']);

        // Check if the password matches
        if ($password === $passwordData['password']) {
            // Check if the password has expired
            $expiryTime = new DateTime($passwordData['expiry_time']);
            $currentTime = new DateTime();

            if ($currentTime < $expiryTime) {
                // Set session and redirect to dashboard
                $_SESSION['user'] = $password;
                header('Location: dashboard.php');
                exit;
            } else {
                $error = "Your password has expired. Please contact the administrator.";
            }
        } else {
            $error = "Invalid password. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
        body {
            width: 100%;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #ecf0f3;
        }
        .wrapper {
            width: 380px;
            padding: 40px 30px 50px;
            background: #ecf0f3;
            box-shadow: 13px 13px 20px #cbced1, -13px -13px 20px #ffffff;
            border-radius: 40px;
        }
        .wrapper .title {
            padding-top: 24px;
            font-size: 24px;
            letter-spacing: 0.5px;
            text-align: center;
        }
        .wrapper form {
            margin: 20px 0;
        }
        .field {
            width: 100%;
            margin-bottom: 30px;
        }
        .field .input-area {
            height: 50px;
            width: 100%;
            position: relative;
            border-radius: 25px;
            box-shadow: inset 8px 8px 8px #cbced1, inset -8px -8px 8px #fff;
        }
        .field .input-area input {
            width: 100%;
            height: 100%;
            background: none;
            border: none;
            outline: none;
            padding: 0 20px;
            font-size: 18px;
        }
        button[type="submit"] {
            width: 100%;
            height: 50px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button[type="submit"]:hover {
            background-color: #45a049;
        }
        .error {
            color: #dc3545;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h1 class="title">Login</h1>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST">
            <div class="field">
                <div class="input-area">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
            </div>
            <button type="submit">Login</button>
        </form>
   
        <div class="link">
            <p><a href="https://telegram.me/bharathmoviesss">Get Password</a></p>
        </div>
    </div>
            <div class="container">
<input type="checkbox" id="btn-mas">
<div class="redes">
<a href="#" class="fab fa-facebook-f"></a>
<a href="#" class="fab fa-instagram"></a>
<a href="#" class="fab fa-twitter"></a>
<a href="#" class="fab fa-pinterest"></a>
</div>
<div class="btn-mas">
<label for="btn-mas" class="icon-mas2"><b>+</b></label>
</div>
</div>
<style>
*{
margin: 0;
padding: 0;
box-sizing: border-box;}
#btn-mas{
display: none;}
.container{
position: fixed;
bottom: 20px;
right: 20px;}
.redes a, .icon-mas2{
display: block;
text-decoration: none;
background: black;
color: #fff;
width: 55px;
height: 55px;
line-height: 55px;
text-align: center;
border-radius: 50%;
box-shadow: 0px 1px 10px rgba(0,0,0,0.4);
transition: all 500ms ease;}
.redes a:hover{
background: #fff;
color: #cc2b2b;}
.redes a{
margin-bottom: -15px;
opacity: 0;
visibility: hidden;}
#btn-mas:checked~ .redes a{
margin-bottom: 10px;
opacity: 1;
visibility: visible;}
.icon-mas2{
cursor: pointer;
background: black;
font-size: 23px;}
#btn-mas:checked ~ .btn-mas .icon-mas2{
transform: rotate(137deg);
font-size: 25px;}
</style>
</body>
</html>

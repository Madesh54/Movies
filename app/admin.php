<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $admin = json_decode(file_get_contents('data/admin_credentials.json'), true);
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($admin['username'] == $username && $admin['password'] == $password) {
        $_SESSION['admin'] = $username;
        header('Location: admin_panel.php');
        exit;
    } else {
        $error = "Invalid credentials.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form validation with Shake Effect | S-Tech04</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body>
  <div class="wrapper">
    <div class="logo"></div>
    <div class="title">Admin Login</div>
    <form method="POST">
      <div class="field email">
        <div class="input-area">
          <input type="text" name="username" placeholder="Username" required>
          <i class="icon fas fa-envelope"></i>
          <i class="error error-icon fas fa-exclamation-circle"></i>
        </div>
        <div class="error error-txt"><?php if (isset($error)) echo $error; ?></div>
      </div>
      <div class="field password">
        <div class="input-area">
          <input type="password" name="password" placeholder="Enter password" required>
          <i class="icon fas fa-lock"></i>
          <i class="error error-icon fas fa-exclamation-circle"></i>
        </div>
        <div class="error error-txt"><?php if (isset($error)) echo $error; ?></div>
      </div>
      <input type="submit" value="Login">
    </form>
    
  </div>
        <style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}
body
{
  width: 1005;
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  background: #ecf0f3;
}
.wrapper
{
  width: 380px;
  padding: 40px 30px 50px 30px;
  background: #ecf0f3;
  box-shadow: 13px 13px 20px #cbced1,
  -13px -13px 20px #ffffff;
  border-radius: 40px;
}
.wrapper .logo
{
  width: 100px;
  height: 100px;
  background: url(./logo.png);
  background-size: cover;
  border-radius: 50%;
  box-shadow: 0 0 2px #5f5f5f,
  0 0 0 5px #ecf0f3,
  8px 8px 15px #a7aaaf;
  margin: 0 auto;
}
.wrapper .title
{
  padding-top: 24px;
  font-size: 24px;
  letter-spacing: 0.5px;
  text-align: center;
}
.wrapper form
{
  margin: 20px 0;
  margin-bottom: 0;
}
.wrapper form .field
{
  width: 100%;
  margin-bottom: 30px;
}
form .field.shake
{
  animation: shake 0.3s ease-in-out;
}

@keyframes shake
{
  0%, 100%
  {
    margin-left: 0px;
  }
  20%, 80%
  {
    margin-left: -12px;
  }
  40%, 60%
  {
    margin-left: 12px;
  }
}
.field .input-area
{
  height: 50px;
  width: 100%;
  position: relative;
  border-radius: 25px;
  box-shadow: inset 8px 8px 8px #cbced1,
  inset -8px -8px 8px #fff;
}
.field .input-area input
{
  width: 100%;
  height: 100%;
  background: none;
  border-radius: 5px;
  border: none;
  outline: none;
  caret-color: #24cfaa;
  padding: 0px 40px;
  font-size: 18px;
}
.input-area i
{
  position: absolute;
  top: 50%;
  pointer-events: none;
  font-size: 18px;
  transform: translateY(-50%);
}
.input-area i.icon
{
  left: 15px;
  color: #bfbfbf;
  transition: color 0.2s ease;
}
.input-area .error-icon
{
  right: 15px;
  color: #dc3545;
}
.input-area input:focus ~ .icon,
form .field.valid .icon
{
  color: #24cfaa;
}
form .field.shake input:focus ~ .icon,
form .field.error input:focus ~ .icon
{
  color: #bfbfbf;
}

input::placeholder
{
  color: #bfbfbf;
  font-size: 17px;
}

.field .error-txt
{
  color: #dc3545;
  margin-top: 5px;
  margin-left: 15px;
}

form .field .error
{
  display: none;
}
form .field.shake .error,
form .field.error .error
{
  display: block;
}

form input[type="submit"]
{
  width: 100%;
  height: 60px;
  text-align: center;
  color: #fff;
  background: #24cfaa;
  border-radius: 30px;
  outline: none;
  border: none;
  font-size: 20px;
  cursor: pointer;
  box-shadow: 3px 3px 8px #d1d1d1,
  -3px -3px 8px #ffffff;
}
form input[type="submit"]:hover
{
  background: #18bb98;
}

.wrapper .link
{
  padding-top: 20px;
  text-align: center;
}
.link a
{
  text-decoration: none;
  color: #949393;
  font-size: 15px;
}
.link a:hover
{
  text-decoration: underline;
}
  </style>
</body>
</html>

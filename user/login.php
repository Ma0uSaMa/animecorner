<!DOCTYPE html>
<html>
<head>
  <title>Login Form</title>
  <link rel="stylesheet" type="text/css" href="/animecorner/css/login.css">
</head>
<body>
<div class="login-container" id="loginContainer">
  <h2>Login Form</h2>
  <button class="close-btn" onclick="closeLogin()">&times;</button>

  <?php 
  $errors = isset($_SESSION["login_errors"]) ? $_SESSION["login_errors"] : [];
  unset($_SESSION["login_errors"]); 
  ?>
  <form id="loginForm" action="/animecorner/user/auth/users_dbfetch.php" method="POST" onsubmit="submitForm(event)">
    <?php if (!empty($errors)) { ?>
    <div class="error" id="loginError">
      <?php foreach ($errors as $error) {
        echo $error . "<br>";
      } ?>
    </div>
    <?php } ?> 

    <div class="success" id="loginSuccess" style="display: none;"></div>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <button type="submit">Login</button>
  </form>
  <p>Don't have an account? <a href="#" onclick="openRegister(event)" class="register">Register</a></p>
</div>
<script src="/animecorner/js/login.js"></script>
</body>
</html>
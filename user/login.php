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
  <?php if (isset($_GET['error'])): ?>
      <div class="error">
        <?php echo $_GET['error']; ?>
      </div>
    <?php endif; ?>
  <form id="loginForm" action="/animecorner/user/auth/users_dbfetch.php" method="POST">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <button type="submit">Login</button>
  </form>
  <p>Don't have an account? <a href="#" onclick="openRegister(event)">Register</a></p>
</div>
<script src="/animecorner/js/login.js"></script>
</body>
</html>

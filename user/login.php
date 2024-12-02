<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .login-container {
      max-width: 400px;
      margin: 50px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }
    .form-header {
      text-align: center;
      margin-bottom: 20px;
    }
    .btn-close-custom {
      position: absolute;
      top: 10px;
      right: 10px;
    }
    .form-footer {
      text-align: center;
      margin-top: 15px;
    }
    .error, .success {
      font-size: 0.9rem;
    }
    .error {
      color: #dc3545;
    }
    .success {
      color: #198754;
    }
  </style>
</head>
<body class="bg-light">

<div class="container">
  <div class="login-container position-relative">
    <button type="button" class="btn-close btn-close-custom" onclick="closeLogin()" aria-label="Close"></button>

    <div class="form-header">
      <h2 class="text-primary">Login</h2>
    </div>

    <?php 
    $errors = isset($_SESSION["login_errors"]) ? $_SESSION["login_errors"] : [];
    unset($_SESSION["login_errors"]); 
    ?>

    <form id="loginForm" action="/animecorner/user/auth/users_dbfetch.php" method="POST" onsubmit="submitForm(event)">
      <?php if (!empty($errors)) { ?>
      <div class="alert alert-danger error" id="loginError">
        <?php foreach ($errors as $error) {
          echo $error . "<br>";
        } ?>
      </div>
      <?php } ?> 

      <div class="alert alert-success success d-none" id="loginSuccess"></div>

      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-primary">Login</button>
      </div>
    </form>

    <div class="form-footer">
      <p>Don't have an account? <a href="#" onclick="openRegister(event)" class="text-primary fw-bold">Register</a></p>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="/animecorner/js/login.js"></script>
</body>
</html>

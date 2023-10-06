<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="/animecorner/css/register.css">
</head>
<body>
<div class="register-container" id="registerContainer">
  <h2>Sign Up</h2>
  <button class="close-btn" onclick="closeRegister()">&times;</button>

  

  <form id="registerForm" action="/animecorner/user/auth/users_dbinsert.php" method="POST" onsubmit="submitForm(event)">
    <?php if (!empty($errors)) { ?>
      <div class="error" id="registrationError">
        <?php foreach ($errors as $error) {
          echo $error . "<br>";
        } ?>
      </div>
    <?php } ?>

    <div class="inputbox">
        <input type="text" name="firstname" required>
        <label for="">Firstname</label>
        <input type="text" name="lastname" required>
        <label for="">Lastname</label>
    </div>
    <div class="inputbox">
        <input type="email" name="email" required>
        <label for="">Email</label>
    </div>
    <div class="inputbox">
        <input type="password" name="password"  required>
        <label for="">Password</label>
    </div>
    <div class="inputbox">
        <input type="password" name="confirmpassword"  required>
        <label for="">Confirm Password</label>
    </div>
    <div class="dob-inputbox">
      <label for="dob">Date of Birth</label>
      <select name="day" required>
        <option value="" selected disabled>Select day</option>
        <?php
          for ($i = 1; $i <= 31; $i++) {
            echo "<option value='$i'>$i</option>";
          }
        ?>
      </select>
      <select name="month" required>
        <option value="" selected disabled>Select month</option>
        <option value="January">Jan</option>
        <option value="February">Feb</option>
        <option value="March">Mar</option>
        <option value="April">Apr</option>
        <option value="May">May</option>
        <option value="June">Jun</option>
        <option value="July">Jul</option>
        <option value="August">Aug</option>
        <option value="September">Sep</option>
        <option value="October">Oct</option>
        <option value="November">Nov</option>
        <option value="December">Dec</option>
      </select>
      <select name="year" required>
        <option value="" selected disabled>Select year</option>
        <?php
          $currentYear = date("Y");
          for ($i = $currentYear; $i >= 1900; $i--) {
            echo "<option value='$i'>$i</option>";
          }
        ?>
      </select>
      <input type="hidden" name="dob" id="dobInput">
    </div>
    <div class="inputbox">
      <label for="">Gender</label>
      <select name="gender" required>
        <option value="" selected disabled>Select your gender</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="other">Other</option>
      </select>
    </div>
    <button type="submit">Register</button>
  </form>
  <p>Already have an account? <a href="#" onclick="openLogin(event)">Login</a></p>
</div>
<script src="/animecorner/js/dob.js"></script>
<script src="/animecorner/js/register.js"></script>
</body>
</html>

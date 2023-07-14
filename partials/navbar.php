<nav>
  <div class="toggle" id="menu-toggle">
    <span></span>
    <span></span>
    <span></span>
  </div>
  <div class="logo">
    <h4>Animecorner</h4>
  </div>
  <div class="search">
    <li class="search-box">
      <i class='bx bx-search icon'></i>
      <input type="search" placeholder="Search...">
    </li>
  </div>
  <ul class="nav-links">
    <li>
      <a href="#">Home</a>
    </li>
    <li>
      <a href="#">About</a>
    </li>
    <li>
      <a href="#">Product</a>
    </li>
    <li>
      <a href="#">Project</a>
    </li>
  </ul>
  <div>
    <button class="login">
      <h5>Login</h5>
    </button>
  </div>
</nav>
<div class="popup" id="loginContainer">
  <div class="popup-inner">
    <?php include __DIR__ . '/../user/login.php'; ?>
  </div>
</div>
<div class="popup" id="registerContainer">
  <div class="popup-inner">
    <?php include __DIR__ . '/../user/register.php'; ?>
  </div>
</div>

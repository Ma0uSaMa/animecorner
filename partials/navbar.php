<nav>
  <div class="logo">
    <h4>Animecorner</h4>
  </div>
  <!-- <div class="search">
    <li class="search-box">
      <i class='bx bx-search icon'></i>
      <input type="search" placeholder="Search...">
    </li>
    <!-- <span>Welcome, <?php echo htmlspecialchars($_SESSION['user_firstname']); ?></span> -->
  </div>
  <ul class="nav-links">
    <li>
      <a href="#">Home</a>
    </li>
    <li>
      <a href="pages/trending_anime.php">Trending Anime</a>
    </li>
    <li>
      <a href="#">About</a>
    </li>
  </ul>
  <div class="user-details">
    <?php
  if (isset($_SESSION['user_id'])) {
    require_once('includes/db_connection.php');

    // Fetch the user's first name from the database
    $query = "SELECT firstname FROM users_credentials WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $stmt->bind_result($firstname);
    $stmt->fetch();
    $stmt->close();

    // Display the user's first name and the "Logout" button
    echo '<span>Welcome, ' . htmlspecialchars($firstname) . '</span>';
    echo '<a href="user/logout.php" class="logout">Logout</a>';
  } else {
    // If 'user_id' is not set, it means no user is logged in
    echo '<button class="login"><h5>Login</h5></button>';
  }
  ?>
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

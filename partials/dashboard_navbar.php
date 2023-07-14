<!-- dashboard_navbar.php -->

<div class="dashboard-navbar">
  <div class="title">
    <h1>Animecorner</h1>
  </div>
  <div class="admin-details">
    <span>Welcome, <?php echo htmlspecialchars($_SESSION['admin_username']); ?></span>
    <a href="../../admin/logout.php">Logout</a>
  </div>
</div>

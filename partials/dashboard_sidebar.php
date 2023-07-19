<?php
// Check if the admin is logged in
if (isset($_SESSION['admin_username'])) {
    // Database connection
    require_once '../../includes/db_connection.php';

    // Retrieve the role of the logged-in admin from the session
    $admin_role = $_SESSION['admin_role'];

    // Display the role
    $role_text = ($admin_role) ? $admin_role : 'Role not found';

    // Rest of your code
?>
<nav class = "sidebar close">
	<header>
		<div class="image-text">
			<span class="image">
				<img src="../../images/logo-image.png" alt="">
			</span>
			<div class="text header-text">
				<span class="name">Dashboard</span>
				<span class="profession"><?php echo $role_text; ?></span>
			</div>
		</div>
		<div class="toggle" id="menu-toggle">
    		<span></span>
    		<span></span>
    		<span></span>
  		</div>
	</header>

	<div class="menu-bar">
		<div class="menu">
			<!-- <li class="search-box">
						<i class='bx bx-search icon'></i>
						<input type="search" placeholder="Search...">
				</li> -->
			<ul class="menu-links">
				<li class="nav-link">
					<a href="dashboard.php?page=registered_users" class="nav-link">
    				<i class='bx bxs-user icon'></i>
    				<span class="text nav-text">Registered Users</span>
				</a>	
				</li>
				<li class="nav-link">
					<a href="dashboard.php?page=publish_anime" class="nav-link">
    				<i class='bx bxs-user icon'></i>
    				<span class="text nav-text">Publish Anime</span>
				</a>
				</li>
				<li class="nav-link">
					<a href="dashboard.php?page=anime_details" class="nav-link">
    				<i class='bx bxs-user icon'></i>
    				<span class="text nav-text">Anime Details</span>
				</a>
				</li>
			</ul>
		</div>
		<div class="bottom-content">
			<li class="mode">
				<div class="moon-sun">
						<i class='bx bx-moon icon moon'></i>
						<i class='bx bx-sun icon sun'></i>
				</div>
				<span class="mode-text text">Dark Mode</span>

				<div class="toggle-switch">
					<span class="switch"></span>
				</div>
			</li>
		</div>
	</div>

</nav>
<script src="../../js/dashboard_sidebar_toggle.js"></script>
<?php
} else {
    header("Location: ../admin_login.php");
    exit();
}
?>
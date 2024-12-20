<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Animecorner - Homepage</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-REe+ZutY6h4kHd91q8MrzzvAzF4yV1gO8aO3I4EhUuP9QPOQ6Tz1Iw0tb1xL8aW4k8glr3PMEMzGl4Y8IUK7KA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" type="text/css" href="/animecorner/css/navbar.css">
  <link rel="icon" type="image/png" href="images/logo-image.png">
  <link rel="stylesheet" type="text/css" href="/animecorner/css/toast.css">
</head>
<body>
  <?php include __DIR__ . '/partials/navbar.php'; ?>
  <script src="/animecorner/js/overlay.js"></script>
  <script src="/animecorner/js/search.js"></script>
  <?php include __DIR__ . '/pages/trending_anime.php'; ?>
  <?php include __DIR__ . '/pages/high_low_anime.php'; ?>
  <?php include __DIR__ . '/pages/anime_details.php'; ?>
  <?php include __DIR__ . '/pages/recommendations.php'; ?>
  
  <div class="overlay"></div>
</body>
</html>

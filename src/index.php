<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <title>FastFood Home</title>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>

  <h1>🍔 Welcome to FastFood Restaurant</h1>
  <img src="images/logo.png" alt="Restaurant Logo" style="width:200px;">

  <?php if (isset($_SESSION['user_id'])): ?>
    <p><a href="pages/menu.php">View Menu</a></p>
    <p><a href="pages/cart.php">View Cart</a></p>
    <p><a href="pages/logout.php">Logout</a></p>
  <?php else: ?>
    <p><a href="pages/register.php">Register</a></p>
    <p><a href="pages/login.php">Login</a></p>
  <?php endif; ?>

</body>
</html>

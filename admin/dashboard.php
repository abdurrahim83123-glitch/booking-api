<?php
session_start();
if(!isset($_SESSION['admin'])) header("Location: login.php");
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<link rel="stylesheet" href="/service-booking/assets/css/style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="sidebar">
  <h2>Service Admin</h2>
  <a href="dashboard.php">Dashboard</a>
  <a href="services.php">Services</a>
  <a href="bookings.php">Bookings</a>
  <a href="logout.php">Logout</a>
</div>

<div class="main-content">
  <h1>Welcome, Admin</h1>
  <div class="cards">
    <div class="card">
      <h3>Total Services</h3>
      <p>2</p>
    </div>
    <div class="card">
      <h3>Total Bookings</h3>
      <p>10</p>
    </div>
    <div class="card">
      <h3>Pending Bookings</h3>
      <p>3</p>
    </div>
  </div>
</div>

</body>
</html>

<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location:index.php");
    exit;
}

include '../config/db.php';

// Handle Add Service form
if(isset($_POST['add_service'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $conn->query("INSERT INTO services (name, price, status) VALUES ('$name','$price',1)");
    header("Location: services.php");
    exit;
}

// Handle Edit Service form
if(isset($_POST['edit_service'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $status = $_POST['status'];
    $conn->query("UPDATE services SET name='$name', price='$price', status='$status' WHERE id=$id");
    header("Location: services.php");
    exit;
}

// Fetch all services
$services = $conn->query("SELECT * FROM services ORDER BY id DESC");

?>

<!DOCTYPE html>
<html>
<head>
<title>Services - Admin</title>
<link rel="stylesheet" href="/service-booking/assets/css/style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
/* Simple table styling */
table{width:100%;border-collapse:collapse;background:#fff;box-shadow:0 8px 20px rgba(0,0,0,0.08);}
th, td{padding:12px;text-align:center;border-bottom:1px solid #eee;}
th{background:#fc8019;color:#fff;}
input, select, button{padding:10px;margin:5px 0;border-radius:8px;border:1px solid #ddd;}
button{background:#0a6cff;color:#fff;border:none;cursor:pointer;}
button:hover{background:#084fb8;}
</style>
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
<h1>Services</h1>

<!-- Add Service Form -->
<h3>Add New Service</h3>
<form method="post">
<input type="text" name="name" placeholder="Service Name" required>
<input type="number" name="price" placeholder="Price" required>
<button type="submit" name="add_service">Add Service</button>
</form>

<!-- Existing Services Table -->
<h3>All Services</h3>
<table>
<tr>
<th>ID</th><th>Name</th><th>Price</th><th>Status</th><th>Action</th>
</tr>
<?php while($s=$services->fetch_assoc()): ?>
<tr>
<td><?= $s['id'] ?></td>
<td><?= $s['name'] ?></td>
<td>₹<?= $s['price'] ?></td>
<td><?= $s['status']==1 ? 'Active':'Inactive' ?></td>
<td>
<form method="post" style="display:inline-block;">
<input type="hidden" name="id" value="<?= $s['id'] ?>">
<input type="text" name="name" value="<?= $s['name'] ?>" required>
<input type="number" name="price" value="<?= $s['price'] ?>" required>
<select name="status">
<option value="1" <?= $s['status']==1?'selected':'' ?>>Active</option>
<option value="0" <?= $s['status']==0?'selected':'' ?>>Inactive</option>
</select>
<button type="submit" name="edit_service">Update</button>
</form>
</td>
</tr>
<?php endwhile; ?>
</table>

</div>
</body>
</html>

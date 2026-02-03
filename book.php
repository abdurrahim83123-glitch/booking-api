<?php
include 'config/db.php';
session_start();

$id = $_GET['id'];
$service = $conn->query("SELECT * FROM services WHERE id=$id")->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Book Service</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px; }
.container { max-width: 400px; margin: auto; background: #fff; padding: 20px; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
h2 { text-align: center; color: #111; margin-bottom: 20px; }
input, button { width: 100%; padding: 12px; margin-bottom: 12px; border-radius: 8px; border: 1px solid #ccc; font-size: 16px; }
button { background: #0a6cff; color: #fff; border: none; cursor: pointer; }
button:hover { background: #0954b3; }
</style>
</head>
<body>
<div class="container">
    <h2><?= htmlspecialchars($service['name']) ?></h2>
    <form method="post" action="send_email_otp.php">
        <input type="hidden" name="service_id" value="<?= $id ?>">

        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <input type="text" name="mobile" placeholder="Mobile" required>
        <input type="date" name="date" required>
        <input type="time" name="time" required>

        <button type="submit">Send OTP</button>
    </form>
</div>
</body>
</html>

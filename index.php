<?php
include 'config/db.php';
$services = $conn->query("SELECT * FROM services WHERE status=1");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Service Booking</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- HERO -->
<div class="hero">
    <h1>Fast & Trusted Home Services</h1>
    <p>Plumbing • Electrical • Cleaning • Repairs</p>
    <a href="#services">Book Now</a>
</div>

<!-- SERVICES -->
<h2 id="services">Book a Service</h2>

<div class="services">
<?php while($s = $services->fetch_assoc()): ?>

    <?php
    // image safe handling
    $image = (!empty($s['image']) && file_exists("assets/images/".$s['image']))
             ? $s['image']
             : 'default.png';
    ?>

    <div class="card">
        <img src="assets/images/<?= $image ?>" alt="<?= htmlspecialchars($s['name']) ?>">
        <h3><?= htmlspecialchars($s['name']) ?></h3>
        <p>₹<?= $s['price'] ?></p>
        <a href="book.php?id=<?= $s['id'] ?>">BOOK NOW</a>
    </div>

<?php endwhile; ?>
</div>

<!-- WHY -->
<div class="why">
    <h2>Why Choose Us</h2>
    <div class="why-grid">
        <div>✔ Verified Experts</div>
        <div>✔ Best Prices</div>
        <div>✔ Fast Service</div>
        <div>✔ 24/7 Support</div>
    </div>
</div>

<footer>
    © <?= date('Y') ?> Service Booking App
</footer>

</body>
</html>

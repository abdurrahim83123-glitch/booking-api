<?php
session_start();
include 'config/db.php';

$user_otp = $_POST['otp'];

if(!isset($_SESSION['booking'])){
    die("Session expired. Please try again.");
}

$booking = $_SESSION['booking'];

if($user_otp != $booking['otp']){
    die("❌ Invalid OTP");
}

// Save booking
$stmt = $conn->prepare(
"INSERT INTO bookings(service_id,name,email,mobile,date,time,status,otp,otp_verified)
 VALUES (?,?,?,?,?,?, 'confirmed',?,1)"
);
$stmt->bind_param(
"issssss",
$booking['service_id'],
$booking['name'],
$booking['email'],
$booking['mobile'],
$booking['date'],
$booking['time'],
$booking['otp']
);

if($stmt->execute()){
    unset($_SESSION['booking']);
    header("Location: success.php");
}else{
    echo "Booking failed. Try again.";
}
?>

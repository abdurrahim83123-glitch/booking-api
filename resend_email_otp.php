<?php
session_start();
include 'config/db.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

if(!isset($_SESSION['booking'])){
    die("❌ Booking info not found.");
}

$booking_id = $_SESSION['booking']['id'];
$email = $_SESSION['booking']['email'];

// Generate new OTP
$otp = rand(100000, 999999);
$_SESSION['booking']['otp'] = $otp;

// Update DB
$stmt = $conn->prepare("UPDATE bookings SET otp=? WHERE id=?");
$stmt->bind_param("si",$otp, $booking_id);
$stmt->execute();
$stmt->close();

// Send new OTP
$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'abdurrahim83123@gmail.com';
    $mail->Password = 'lpdx dcha qkwz ergm';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('abdurrahim83123@gmail.com','Service Booking');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = 'Your Booking OTP';
    $mail->Body = "Your new OTP is: <b>$otp</b>";
    $mail->send();

    header("Location: send_email_otp.php");
}catch(Exception $e){
    die("❌ OTP resend failed: {$mail->ErrorInfo}");
}
?>

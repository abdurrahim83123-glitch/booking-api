<?php
// --------------------------------------------
// send_email_otp.php
// Sends OTP to email and returns JSON
// --------------------------------------------

header('Content-Type: application/json');
session_start();

// Disable notices/warnings (optional for production)
error_reporting(E_ALL & ~E_NOTICE);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

try {

    // Check email input
    $email = $_POST['email'] ?? '';
    if (!$email) {
        throw new Exception("Email is required");
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Invalid email format");
    }

    // Generate 6-digit OTP
    $otp = rand(100000, 999999);

    // Store in session
    $_SESSION['email_otp'] = $otp;
    $_SESSION['email'] = $email;

    // Send email
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'abdurrahim83123@gmail.com';  // Your Gmail
    $mail->Password   = 'lpdx dcha qkwz ergm';        // App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('abdurrahim83123@gmail.com', 'Service Booking');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Your Booking OTP';
    $mail->Body    = "<p>Your OTP for booking is: <b>$otp</b></p>";

    if (!$mail->send()) {
        throw new Exception("Email could not be sent: " . $mail->ErrorInfo);
    }

    // Success response
    echo json_encode([
        'status' => 'success',
        'message' => 'OTP sent to your email'
    ]);

} catch (Exception $e) {
    // Catch any errors and return JSON
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
exit; // Important: stop PHP after JSON output

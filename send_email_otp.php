<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if (!isset($_POST['email']) || empty($_POST['email'])) {
    die("❌ No booking data received. Please submit the booking form first.");
}

// Get POST data
$service_id = $_POST['service_id'];
$name       = $_POST['name'];
$email      = $_POST['email'];
$mobile     = $_POST['mobile'];
$date       = $_POST['date'];
$time       = $_POST['time'];

// Generate OTP
$otp = rand(100000, 999999);

// Store in session
$_SESSION['booking'] = [
    'service_id' => $service_id,
    'name'       => $name,
    'email'      => $email,
    'mobile'     => $mobile,
    'date'       => $date,
    'time'       => $time,
    'otp'        => $otp
];

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'abdurrahim83123@gmail.com';
    $mail->Password   = 'lpdxdchaqkwzergm';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('abdurrahim83123@gmail.com', 'Service Booking');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Your Booking OTP';
    $mail->Body    = "Hello <b>$name</b>,<br>Your OTP for booking <b>Service ID: $service_id</b> is: <b>$otp</b>";

    $mail->send();

    // ✅ Output HTML page with CSS
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Verify OTP</title>
        <link rel="stylesheet" href="assets/css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            /* Optional: quick inline CSS if you want minor adjustments */
            .otp-container {
                max-width: 400px;
                margin: 50px auto;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 10px;
                background: #f8f8f8;
                text-align: center;
            }
            .otp-container input {
                width: 80%;
                padding: 10px;
                margin: 10px 0;
                font-size: 16px;
            }
            .otp-container button {
                padding: 10px 20px;
                font-size: 16px;
                background: #4CAF50;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }
            .otp-container button:hover {
                background: #45a049;
            }
        </style>
    </head>
    <body>
        <div class="otp-container">
            <p>✅ OTP sent to <b><?= $email ?></b></p>
            <form method="post" action="verify_email_otp.php">
                <input name="otp" placeholder="Enter OTP" required><br>
                <button type="submit">Verify OTP</button>
            </form>
        </div>
    </body>
    </html>
    <?php

} catch (Exception $e) {
    echo "❌ Mailer Error: {$mail->ErrorInfo}";
}

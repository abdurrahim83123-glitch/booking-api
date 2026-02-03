<?php
header('Content-Type: application/json');
session_start();

$email = $_POST['email'] ?? '';
$otp = $_POST['otp'] ?? '';

if(!$email || !$otp){
    echo json_encode(['status'=>'error','message'=>'Email and OTP required']);
    exit;
}

if(isset($_SESSION['email_otp']) && $_SESSION['email_otp'] == $otp && $_SESSION['email'] == $email){
    echo json_encode(['status'=>'success','message'=>'OTP verified']);
} else {
    echo json_encode(['status'=>'error','message'=>'Invalid OTP']);
}
?>

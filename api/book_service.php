<?php
header('Content-Type: application/json');
include '../config/db.php';

$name = $_POST['name'] ?? '';
$mobile = $_POST['mobile'] ?? '';
$service_id = $_POST['service_id'] ?? '';

if(!$name || !$mobile || !$service_id){
    echo json_encode(['status'=>'error','message'=>'All fields are required']);
    exit;
}

// Insert booking
$stmt = $conn->prepare("INSERT INTO bookings(service_id, name, mobile, date, time, status) VALUES (?, ?, ?, CURDATE(), CURTIME(), 'pending')");
$stmt->bind_param("iss", $service_id, $name, $mobile);
if($stmt->execute()){
    echo json_encode(['status'=>'success','message'=>'Booking confirmed!']);
}else{
    echo json_encode(['status'=>'error','message'=>'Booking failed']);
}
$stmt->close();
$conn->close();
?>

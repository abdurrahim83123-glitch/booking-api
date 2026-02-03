<?php
header('Content-Type: application/json');
include '../config/db.php';

$sql = "SELECT 
            b.id,
            b.service_id,
            s.name AS service_name,
            b.name,
            b.mobile,
            b.date,
            b.time,
            b.status
        FROM bookings b
        JOIN services s ON b.service_id = s.id
        ORDER BY b.id DESC";

$result = $conn->query($sql);

$bookings = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }
}

echo json_encode($bookings);
?>

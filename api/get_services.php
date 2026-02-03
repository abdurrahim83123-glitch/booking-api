<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");

include __DIR__ . "/../config/db.php";

$sql = "SELECT id, name AS title, price, status FROM services WHERE status=1";
$result = $conn->query($sql);

$services = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $services[] = $row;
    }
}

echo json_encode([
    "success" => true,
    "services" => $services
]);

$conn->close();

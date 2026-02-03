<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location:index.php");
    exit;
}

// Include DB
include '../config/db.php';

// Get parameters
$id = $_GET['id'];
$status = $_GET['status'];

// Update booking status
$conn->query("UPDATE bookings SET status='$status' WHERE id=$id");

// Redirect back to bookings page
header("Location: bookings.php");
exit;
?>

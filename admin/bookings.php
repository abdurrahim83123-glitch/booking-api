<?php
session_start();

// Session check
if(!isset($_SESSION['admin'])){
    header("Location:index.php");
    exit;
}

// Include database connection
include '../config/db.php';

// Fetch bookings with service name
$allBookings = $conn->query("
    SELECT b.*, s.name AS service_name
    FROM bookings b
    JOIN services s ON b.service_id = s.id
    ORDER BY b.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bookings - Admin Panel</title>
    <link rel="stylesheet" href="/service-booking/assets/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Extra Table Styling */
        table{
            width:100%;
            border-collapse:collapse;
            background:#fff;
            border-radius:12px;
            overflow:hidden;
            box-shadow:0 8px 20px rgba(0,0,0,0.08);
        }
        th, td{
            padding:12px;
            text-align:center;
            border-bottom:1px solid #eee;
        }
        th{
            background:#fc8019;
            color:#fff;
        }
        a{
            color:#0a6cff;
            text-decoration:none;
            font-weight:600;
        }
        a:hover{
            text-decoration:underline;
        }
        /* Responsive */
        @media(max-width:768px){
            table, th, td{
                font-size:14px;
            }
        }
    </style>
</head>
<body>
<div class="sidebar">
    <h2>Service Admin</h2>
    <a href="dashboard.php">Dashboard</a>
    <a href="services.php">Services</a>
    <a href="bookings.php">Bookings</a>
    <a href="logout.php">Logout</a>
</div>

<div class="main-content">
    <h1>Bookings</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Service</th>
            <th>Name</th>
            <th>Mobile</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php
        while($b = $allBookings->fetch_assoc()){
            echo "<tr>
            <td>{$b['id']}</td>
            <td>{$b['service_name']}</td>
            <td>{$b['name']}</td>
            <td>{$b['mobile']}</td>
            <td>{$b['date']}</td>
            <td>{$b['time']}</td>
            <td>{$b['status']}</td>
            <td>
                <a href='change_status.php?id={$b['id']}&status=Completed'>Complete</a>
            </td>
            </tr>";
        }
        ?>
    </table>
</div>
</body>
</html>

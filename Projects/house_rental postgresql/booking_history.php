<?php
include('config.php');
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'tenant') {
    header("Location: Home_Page.php");
    exit();
}

$tenant_id = $_SESSION['user_id'];

$query = "SELECT b.id, p.title, b.status, b.payment_status 
          FROM bookings b 
          JOIN properties p ON b.property_id = p.id 
          WHERE b.tenant_id = $1";

$result = pg_query_params($conn, $query, array($tenant_id));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking History</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>My Booking History</h2>
<table>
    <thead>
        <tr>
            <th>Property</th>
            <th>Booking Status</th>
            <th>Payment Status</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = pg_fetch_assoc($result)) { ?>
            <tr>
                <td><?= htmlspecialchars($row['title']) ?></td>
                <td><?= htmlspecialchars($row['status']) ?></td>
                <td><?= htmlspecialchars($row['payment_status']) ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

</body>
</html>

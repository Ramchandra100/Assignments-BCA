<?php
session_start();
include 'config.php';

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "tenant") {
    die("Unauthorized Access");
}

$tenant_id = $_SESSION["user_id"];


$query = "SELECT b.*, p.title, p.price, py.status AS payment_status 
          FROM bookings b 
          JOIN properties p ON b.property_id = p.id 
          LEFT JOIN payments py ON b.property_id = py.property_id 
          WHERE b.tenant_id = $1";
$result = pg_query_params($conn, $query, [$tenant_id]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Status</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Payment Status</h1>
        <nav class="nav-links">
            <a href="tenant_dashboard.php" class="btn">🏠 Dashboard</a>
            <a href="logout.php" class="btn">🚪 Logout</a>
        </nav>
    </header>

    <div class="container">
        <h2>My Payments</h2>
        <table>
            <tr>
                <th>Property</th>
                <th>Amount</th>
                <th>Payment Status</th>
            </tr>
            <?php while ($booking = pg_fetch_assoc($result)): ?>
                <tr>
                    <td><?= htmlspecialchars($booking['title']) ?></td>
                    <td>₹<?= $booking['price'] ?></td>
                    <td class="<?= $booking['payment_status'] === 'Paid' ? 'status-paid' : 'status-unpaid' ?>">
                        <?= $booking['payment_status'] ? $booking['payment_status'] : 'Not Paid' ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <footer>
        <p>&copy; 2025 House Rental System. All rights reserved.</p>
    </footer>
</body>
</html>

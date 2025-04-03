<?php
session_start();
include 'config.php';


if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "tenant") {
    die("Unauthorized Access");
}

$tenant_id = $_SESSION["user_id"];


$query = "SELECT b.id, p.title, p.location, p.price, b.status, b.payment_status 
          FROM bookings b 
          JOIN properties p ON b.property_id = p.id 
          WHERE b.tenant_id = $1";
$stmt = pg_prepare($conn, "fetch_bookings", $query);
$result = pg_execute($conn, "fetch_bookings", array($tenant_id));

$bookings = [];
while ($row = pg_fetch_assoc($result)) {
    $bookings[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Dashboard</title>
    <!-- <link rel="stylesheet" href="css/tenant_dashboard.css"> -->
     <style>
       
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color:rgb(87, 162, 236);
    color: #fff;
    display: flex;
}


.sidebar {
    width: 250px;
    height: 100vh;
    background: #2c3e50;
    padding-top: 20px;
    position: fixed;
    top: 0;
    left: 0;
}

.sidebar h2 {
    color: white;
    text-align: center;
    margin-bottom: 20px;
}

.sidebar ul {
    list-style: none;
    padding: 0;
}

.sidebar ul li {
    padding: 15px;
    text-align: center;
}

.sidebar ul li a {
    text-decoration: none;
    color: white;
    display: block;
    font-weight: bold;
    transition: 0.3s;
}

.sidebar ul li a:hover,
.sidebar ul li.active a {
    background-color: #e74c3c;
    border-radius: 5px;
}


.main-content {
    margin-left: 270px;
    padding: 20px;
    flex: 1;
}

h1 {
    color: #fff;
    text-align: center;
}


.booking-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
    background: #34495e;
    border-radius: 10px;
}

.booking-table th,
.booking-table td {
    padding: 15px;
    text-align: center;
    border-bottom: 1px solid #ddd;
    color: white;
}

.booking-table th {
    background-color: #2980b9;
}

.booking-table tr:hover {
    background-color: #1abc9c;
}


.pending {
    color: orange;
    font-weight: bold;
}

.confirmed {
    color: green;
    font-weight: bold;
}

.cancelled {
    color: red;
    font-weight: bold;
}


.unpaid {
    color: red;
    font-weight: bold;
}

.paid {
    color: green;
    font-weight: bold;
}


.no-bookings {
    text-align: center;
    font-size: 18px;
    margin-top: 20px;
    background: #e74c3c;
    padding: 10px;
    border-radius: 5px;
}

     </style>
</head>
<body>

    
    <div class="sidebar">
        <h2>🏠 Tenant Dashboard</h2>
        <ul>
            <li class="active"><a href="tenant_dashboard.php">📌 My Bookings</a></li>
            <li><a href="property_list.php">🏡 View Properties</a></li>
            <li><a href="message.php">💬message</a></li>
            <li><a href="user_profile.php">👤 Profile</a></li>
            <li><a href="Home_Page.php">logout</a></li>
            
        </ul>
    </div>

    <div class="main-content">
        <h1>My Bookings</h1>

        <?php if (count($bookings) > 0): ?>
            <table class="booking-table">
                <thead>
                    <tr>
                        <th>Property</th>
                        <th>Location</th>
                        <th>Price (₹)</th>
                        <th>Status</th>
                        <th>Payment</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookings as $booking): ?>
                        <tr>
                            <td><?= htmlspecialchars($booking["title"]) ?></td>
                            <td><?= htmlspecialchars($booking["location"]) ?></td>
                            <td><?= number_format($booking["price"], 2) ?></td>
                            <td class="<?= strtolower($booking["status"]) ?>">
                                <?= ucfirst($booking["status"]) ?>
                            </td>
                            <td class="<?= strtolower($booking["payment_status"]) ?>">
                                <?= ucfirst($booking["payment_status"]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-bookings">You have no bookings yet.</p>
        <?php endif; ?>
    </div>

</body>
</html>

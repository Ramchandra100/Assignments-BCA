<?php
session_start();
include 'config.php';

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "tenant") {
    die("Unauthorized Access");
}

$tenant_id = $_SESSION["user_id"];
$booking_id = $_GET["booking_id"] ?? null;

if (!$booking_id) {
    die("Invalid Booking Selection");
}


$query = "SELECT p.title, py.amount, py.payment_method, py.transaction_id, py.payment_date
          FROM payments py
          JOIN bookings b ON py.booking_id = b.id
          JOIN properties p ON b.property_id = p.id
          WHERE py.booking_id = $1 AND py.tenant_id = $2";

$stmt = pg_prepare($conn, "fetch_payment", $query);
$result = pg_execute($conn, "fetch_payment", array($booking_id, $tenant_id));
$payment = pg_fetch_assoc($result);

if (!$payment) {
    die("Payment Record Not Found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt</title>
    <link rel="stylesheet" href="css/payment_receipt.css">
    <style>
      
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color:skyblue;
    color: #333;
    padding: 20px;
}

h2 {
    font-size: 32px;
    color: #4CAF50;
    margin-bottom: 20px;
    text-align: center;
}


.receipt-container {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 30px;
    max-width: 600px;
    margin: 0 auto;
    text-align: center;
}


.receipt-container p {
    font-size: 18px;
    line-height: 1.6;
    margin: 10px 0;
}


.receipt-container strong {
    color: #333;
    font-weight: 600;
}


.receipt-container p:nth-child(2) strong {
    color: #FF5722;
    font-size: 22px;
}


.btn {
    display: inline-block;
    padding: 12px 30px;
    background-color: #4CAF50;
    color: #fff;
    font-size: 16px;
    font-weight: bold;
    text-decoration: none;
    border-radius: 6px;
    margin-top: 20px;
    transition: background-color 0.3s;
}

.btn:hover {
    background-color: #45a049;
}


@media (max-width: 768px) {
    .receipt-container {
        padding: 20px;
    }

    h2 {
        font-size: 28px;
    }

    .btn {
        padding: 10px 25px;
        font-size: 14px;
    }
}

    </style>
</head>
<body>

    <div class="receipt-container">
        <h2>Payment Receipt</h2>
        <p>Property: <strong><?= htmlspecialchars($payment["title"]) ?></strong></p>
        <p>Amount: <strong>₹<?= htmlspecialchars($payment["amount"]) ?></strong></p>
        <p>Payment Method: <strong><?= htmlspecialchars($payment["payment_method"]) ?></strong></p>
        <p>Transaction ID: <strong><?= htmlspecialchars($payment["transaction_id"]) ?></strong></p>
        <p>Payment Date: <strong><?= htmlspecialchars($payment["payment_date"]) ?></strong></p>

        <a href="tenant_dashboard.php" class="btn">Back to Dashboard</a>
    </div>

</body>
</html>

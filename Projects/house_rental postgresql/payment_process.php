<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid Request");
}

$tenant_id = $_SESSION["user_id"] ?? null;
$booking_id = $_POST["booking_id"] ?? null;
$amount = $_POST["amount"] ?? null;
$payment_method = $_POST["payment_method"] ?? null;
$transaction_id = uniqid("TXN");

if (!$tenant_id || !$booking_id || !$amount || !$payment_method) {
    die("Invalid Payment Data");
}


$query = "INSERT INTO payments (booking_id, tenant_id, amount, payment_method, payment_status, transaction_id) 
          VALUES ($1, $2, $3, $4, 'paid', $5)";

$stmt = pg_prepare($conn, "insert_payment", $query);
$result = pg_execute($conn, "insert_payment", array($booking_id, $tenant_id, $amount, $payment_method, $transaction_id));

if ($result) {
    
    pg_query($conn, "UPDATE bookings SET payment_status = 'paid', status = 'confirmed' WHERE id = $booking_id");

    header("Location: payment_receipt.php?booking_id=" . urlencode($booking_id));
    exit();
} else {
    die("Payment Failed. Please Try Again.");
}
?>

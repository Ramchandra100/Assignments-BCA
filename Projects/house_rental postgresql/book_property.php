<?php
session_start();
include 'config.php';


if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "tenant") {
    die("Unauthorized Access");
}

$tenant_id = $_SESSION["user_id"];


if (!isset($_GET['property_id']) || empty($_GET['property_id']) || !is_numeric($_GET['property_id'])) {
    die("Invalid Booking Selection");
}

$property_id = $_GET['property_id'];


$query = "SELECT * FROM properties WHERE id = $1 AND availability = 'available'";
$stmt = pg_prepare($conn, "check_property", $query);
$result = pg_execute($conn, "check_property", array($property_id));

if (pg_num_rows($result) == 0) {
    die("Invalid Booking Selection");
}


$insert_query = "INSERT INTO bookings (tenant_id, property_id, status, payment_status) VALUES ($1, $2, 'pending', 'unpaid') RETURNING id";
$stmt = pg_prepare($conn, "insert_booking", $insert_query);
$insert_result = pg_execute($conn, "insert_booking", array($tenant_id, $property_id));

if ($insert_result) {
    $booking_id = pg_fetch_result($insert_result, 0, "id");
    header("Location: payment.php?booking_id=" . urlencode($booking_id));
    exit;
} else {
    die("Booking Failed. Try Again.");
}
?>

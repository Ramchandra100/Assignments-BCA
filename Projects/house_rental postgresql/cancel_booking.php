<?php
session_start();
include 'config.php';


if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "tenant") {
    die(json_encode(["success" => false, "message" => "Unauthorized Access"]));
}

$tenant_id = $_SESSION["user_id"];
$booking_id = $_POST["booking_id"] ?? null;

if (!$booking_id) {
    die(json_encode(["success" => false, "message" => "Invalid booking ID"]));
}


$query = "UPDATE bookings SET status = 'cancelled' WHERE id = $1 AND tenant_id = $2 AND status = 'pending'";
$result = pg_query_params($conn, $query, array($booking_id, $tenant_id));

if ($result && pg_affected_rows($result) > 0) {
    echo json_encode(["success" => true, "message" => "Booking cancelled successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Cannot cancel this booking"]);
}
?>

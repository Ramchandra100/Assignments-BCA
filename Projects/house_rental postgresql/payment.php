<?php
session_start();
include 'config.php';


if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "tenant") {
    die("Unauthorized Access");
}

$tenant_id = $_SESSION["user_id"];

$booking_id = $_GET['booking_id'] ?? null;
if (!$booking_id) {
    die("Invalid Booking Selection");
}


$query = "SELECT b.id AS booking_id, p.title, p.price 
          FROM bookings b
          JOIN properties p ON b.property_id = p.id
          WHERE b.id = $1 AND b.tenant_id = $2";

$stmt = pg_prepare($conn, "fetch_booking", $query);
$result = pg_execute($conn, "fetch_booking", array($booking_id, $tenant_id));
$booking = pg_fetch_assoc($result);

if (!$booking) {
    die("Invalid Booking Selection");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment | House Rental</title>
    <link rel="stylesheet" href="css/payment.css"> 
    <style>
        body {
            background-image: url('images/payment4.jpg!sw800');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
    <script>
        function toggleCardDetails() {
            let paymentMethod = document.getElementById("payment_method").value;
            let cardDetails = document.getElementById("card_details");
            cardDetails.style.display = (paymentMethod === "upi") ? "none" : "block";
        }
    </script>
</head>
<body>

    <div class="payment-container">
        <h2>Make a Secure Payment</h2>
        <p>Property: <strong><?= htmlspecialchars($booking["title"]) ?></strong></p>
        <p>Amount: <strong>₹<?= htmlspecialchars($booking["price"]) ?></strong></p>

        <form action="payment_process.php" method="POST">
            <input type="hidden" name="booking_id" value="<?= htmlspecialchars($booking['booking_id']) ?>">
            <input type="hidden" name="amount" value="<?= htmlspecialchars($booking['price']) ?>">

            <label for="payment_method">Select Payment Method:</label>
            <select name="payment_method" id="payment_method" required onchange="toggleCardDetails()">
                <option value="credit_card">Credit Card</option>
                <option value="debit_card">Debit Card</option>
                <option value="upi">UPI</option>
            </select>

            <div id="card_details">
                <input type="text" name="card_number" placeholder="Card Number" maxlength="16">
                <input type="text" name="expiry_date" placeholder="Expiry Date (MM/YY)" pattern="(0[1-9]|1[0-2])\/\d{2}" title="Format: MM/YY">
                <input type="text" name="cvv" placeholder="CVV" maxlength="3">
            </div>

            <button type="submit" class="btn">Pay Now</button>
        </form>

        <a href="tenant_dashboard.php" class="btn back-btn">Back</a>
    </div>

</body>
</html>

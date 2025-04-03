<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    $stmt = $conn->prepare("INSERT INTO user_locations (user_id, latitude, longitude) 
                            VALUES (?, ?, ?) 
                            ON DUPLICATE KEY UPDATE latitude=?, longitude=?");
    $stmt->bind_param("idddi", $_SESSION['user_id'], $latitude, $longitude, $latitude, $longitude);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error updating location: " . $conn->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Location</title>
    <script>
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                let lat = position.coords.latitude;
                let lng = position.coords.longitude;
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;
                document.getElementById('locationForm').submit();
            });
        } else {
            alert("Geolocation is not supported by this browser.");
            window.location.href = "dashboard.php";
        }
    </script>
</head>
<body onload="submitLocation()">
    <form id="locationForm" action="update_location.php" method="POST">
        <input type="hidden" id="latitude" name="latitude">
        <input type="hidden" id="longitude" name="longitude">
    </form>
</body>
</html>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

// Check if the database connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user's coordinates from the database
$sql = "SELECT latitude, longitude FROM users WHERE id=?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

if (!$stmt->bind_param("i", $_SESSION['user_id'])) {
    die("Error binding parameters: " . $stmt->error);
}

if (!$stmt->execute()) {
    die("Error executing statement: " . $stmt->error);
}

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $latitude = $user['latitude'];
    $longitude = $user['longitude'];
} else {
    $latitude = 0;
    $longitude = 0;
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAx2DAxyFp1syoG1XljS7bGTOSlQU-2pCY&callback=initMap" async defer></script>
</head>
<body>
<nav>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="map.php">Live Location Tracking</a></li>
            <li><a href="edit_location.php">Modify Location in Database</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <div class="container">
        <h2>This Account Belongs To, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h2>
        <p>Mobile Number: <?php echo htmlspecialchars($_SESSION['email']); ?></p>
        <h2>Track Live Location Of, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h2>
       
        
        <!-- Section to display current location on map -->
        <div id="map" style="width: 100%; height: 400px;"></div>
    </div>

    <script>
        // Initialize and add the map
        function initMap() {
            // The location of the user
            var userLocation = { lat: <?php echo $latitude; ?>, lng: <?php echo $longitude; ?> };
            // The map, centered at the user location
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: userLocation
            });
            // The marker, positioned at the user location
            var marker = new google.maps.Marker({
                position: userLocation,
                map: map
            });
        }
    </script>
</body>
</html>
<?php
// Database Connection
$host = "localhost";
$dbname = "food_management_system";
$user = "postgres";
$password = "root";

try {
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $contact = $_POST["contact"];
    $address = $_POST["address"];
    
    // Prepare SQL statement to avoid SQL injection
    $stmt = $conn->prepare("INSERT INTO food_requests (name, contact, address) VALUES (:name, :contact, :address)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':contact', $contact);
    $stmt->bindParam(':address', $address);
    
    if ($stmt->execute()) {
        echo "<script>alert('Your food request has been submitted!'); window.location.href = 'find_donation.php';</script>";
    } else {
        echo "<script>alert('Error submitting request. Please try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Request Food | Food Management System</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <script defer src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: url('f4.jpg') no-repeat center center/cover;
            margin: 0;
            color: white;
            text-align: center;
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            justify-content: center;
        }
        .form-container {
            background: rgba(0, 0, 0, 0.8);
            padding: 20px;
            border-radius: 10px;
            width: 50%;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }
        button {
            background: #38ef7d;
            color: white;
            cursor: pointer;
        }
        #map {
            height: 300px;
            margin-top: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Food Management System</h1>
        <nav>
            <a href="about_us.php">About Us</a> |
            <a href="contact_us.php">Contact Us</a> |
            <a href="notifications.php">Notifications</a>
        </nav>
    </header>
    <div class="container">
        <div class="form-container">
            <h2>Request Food</h2>
            <form method="POST">
                <input type="text" name="name" placeholder="Full Name" required>
                <input type="tel" name="contact" placeholder="Contact Number" required>
                <input type="text" name="address" id="address" placeholder="Your Address" required>
                <button type="button" id="detectLocation">Detect My Location</button>
                <button type="submit">Submit Request</button>
            </form>
            <div id="map"></div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var map = L.map('map').setView([20.5937, 78.9629], 5);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            document.getElementById("detectLocation").addEventListener("click", function() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        var lat = position.coords.latitude;
                        var lng = position.coords.longitude;
                        map.setView([lat, lng], 14);
                        L.marker([lat, lng]).addTo(map).bindPopup("You are here!").openPopup();
                        document.getElementById("address").value = "Lat: " + lat.toFixed(4) + ", Lng: " + lng.toFixed(4);
                    });
                } else {
                    alert("Geolocation is not supported by your browser.");
                }
            });
        });
    </script>
</body>
</html>
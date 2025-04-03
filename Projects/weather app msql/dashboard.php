<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user details
$user = $conn->query("SELECT * FROM users WHERE username = '{$_SESSION['username']}'")->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="weather-container">
        <h1>Weather App</h1>
        <p>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</p>
        <input type="text" id="location" placeholder="Enter city name" />
        <button onclick="getWeather()">Get Weather</button>

        <div id="weather-info">
            <!-- Weather details will be shown here -->
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
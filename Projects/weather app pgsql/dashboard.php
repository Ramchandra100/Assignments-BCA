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
$username = "postgres"; // Default PostgreSQL username
$password = "root"; // Replace with your PostgreSQL password
$dbname = "testdb";

$conn = pg_connect("host=$servername dbname=$dbname user=$username password=$password");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

// Fetch user details
$sql = "SELECT * FROM users WHERE username = '{$_SESSION['username']}'";
$result = pg_query($conn, $sql);

if ($result) {
    $user = pg_fetch_assoc($result);
} else {
    die("Query failed: " . pg_last_error($conn));
}

pg_close($conn);
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
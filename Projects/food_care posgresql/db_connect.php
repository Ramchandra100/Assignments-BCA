<?php
$host = "localhost";
$dbname = "food_management_system";
$user = "postgres"; // Update with your PostgreSQL username
$password = "root"; // Update with your PostgreSQL password

try {
    // Create a new PDO instance for PostgreSQL
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch(PDOException $e) {
    // Handle connection errors
    die("Connection failed: " . $e->getMessage());
}

// Export the connection for use in other scripts
$exportedConn = $conn;
?>
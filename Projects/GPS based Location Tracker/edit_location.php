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

    // Prepare the SQL statement
    $sql = "UPDATE users SET latitude=?, longitude=? WHERE id=?";
    $stmt = $conn->prepare($sql);

    // Check if the prepare method was successful
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters
    if (!$stmt->bind_param("ddi", $latitude, $longitude, $_SESSION['user_id'])) {
        die("Error binding parameters: " . $stmt->error);
    }

    // Execute the statement
    if ($stmt->execute()) {
        echo "Location updated successfully!";
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error updating location: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Location</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 300px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            color: #555;
        }
        input[type="text"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            padding: 10px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #111;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #333;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php include 'navbar.html'; ?>
    <div class="container">
        <h2>Edit Your Location</h2>
        <form action="edit_location.php" method="POST">
            <label>Latitude:</label>
            <input type="text" name="latitude" required>
            <label>Longitude:</label>
            <input type="text" name="longitude" required>
            <button type="submit">Update Location</button>
        </form>
        <a href="dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
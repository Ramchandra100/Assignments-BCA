<?php
include 'db_connect.php'; // Ensure this file contains the correct PostgreSQL connection details

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $food_name = $_POST['food_name'];
    $quantity = $_POST['quantity'];
    $expiration_date = $_POST['expiration_date'];
    $location = $_POST['location'];
    $donor_name = $_POST['donor_name'];
    $contact = $_POST['contact'];
    $status = 'Pending';
    
    // Use prepared statements to prevent SQL injection
    $sql = "INSERT INTO food_donations (food_name, quantity, expiration_date, location, donor_name, contact, status) 
            VALUES (:food_name, :quantity, :expiration_date, :location, :donor_name, :contact, :status)";
    
    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':food_name', $food_name);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':expiration_date', $expiration_date);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':donor_name', $donor_name);
        $stmt->bindParam(':contact', $contact);
        $stmt->bindParam(':status', $status);
        $stmt->execute();
        
        echo "<script>alert('Food donation submitted successfully!'); window.location.href= 'available_food.php';</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Donate Food | Food Management System</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #11998e, #38ef7d);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        .container h2 {
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        label {
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background: #11998e;
            color: white;
            padding: 10px;
            border: none;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover {
            background: #38ef7d;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Donate Food</h2>
        <form method="POST">
            <div class="form-group">
                <label>Food Name</label>
                <input type="text" name="food_name" required>
            </div>
            <div class="form-group">
                <label>Quantity</label>
                <input type="text" name="quantity" required>
            </div>
            <div class="form-group">
                <label>Expiration Date</label>
                <input type="date" name="expiration_date" required>
            </div>
            <div class="form-group">
                <label>Location</label>
                <input type="text" name="location" required>
            </div>
            <div class="form-group">
                <label>Donor Name</label>
                <input type="text" name="donor_name" required>
            </div>
            <div class="form-group">
                <label>Contact</label>
                <input type="text" name="contact" required>
            </div>
            <button type="submit">Submit Donation</button>
        </form>
    </div>
</body>
</html>
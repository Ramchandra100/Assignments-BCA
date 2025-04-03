<?php
session_start();

include 'db_connect.php'; // Make sure this file contains the correct PostgreSQL connection details

// Handle Admin Login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT email, password FROM admins WHERE email = :email";
    
    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($admin && $admin['password'] === $password) { // Directly compare passwords
            $_SESSION["admin"] = $admin['email'];
            echo "<script>alert('Welcome, Admin!'); window.location.href='admin_dashboard.php';</script>";
        } else {
            echo "<script>alert('Invalid email or password!');</script>";
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login | Food Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to right, #11998e, #38ef7d);
        }
        .login-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }
        .login-container h2 {
            margin-bottom: 20px;
            color: #11998e;
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        .form-group label {
            font-weight: 600;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-btn {
            width: 100%;
            padding: 10px;
            background: #11998e;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s ease-in-out;
        }
        .form-btn:hover {
            background: #0c7b74;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Enter admin email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Enter admin password" required>
            </div>
            <button type="submit" name="login" class="form-btn">Login</button>
        </form>
    </div>
</body>
</html>
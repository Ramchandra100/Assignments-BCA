<?php
session_start();

include 'db_connect.php'; // Ensure this file contains the correct PostgreSQL connection details

$message = "";

// Handle Registration
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $password = $_POST["password"]; // Store plain text password

    // Prepare SQL statement to avoid SQL injection
    $checkEmail = $conn->prepare("SELECT id FROM beneficiaries WHERE email = :email");
    $checkEmail->bindParam(':email', $email);
    $checkEmail->execute();
    $result = $checkEmail->get_result();

    if ($result->num_rows > 0) {
        $message = "Email already registered!";
    } else {
        $insertStmt = $conn->prepare("INSERT INTO beneficiaries (name, email, phone, address, password) VALUES (:name, :email, :phone, :address, :password)");
        $insertStmt->bindParam(':name', $name);
        $insertStmt->bindParam(':email', $email);
        $insertStmt->bindParam(':phone', $phone);
        $insertStmt->bindParam(':address', $address);
        $insertStmt->bindParam(':password', $password);
        if ($insertStmt->execute()) {
            $message = "Registration successful! You can now log in.";
        } else {
            $message = "Error: " . $insertStmt->error;
        }
    }
}

// Handle Login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $selectStmt = $conn->prepare("SELECT id, password FROM beneficiaries WHERE email = :email");
    $selectStmt->bindParam(':email', $email);
    $selectStmt->execute();
    $result = $selectStmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if ($row["password"] === $password) { // Directly compare passwords
            session_start();
            $_SESSION["beneficiary_id"] = $row["id"];
            header("Location: req_food.php");
            exit();
        } else {
            $message = "Invalid password!";
        }
    } else {
        $message = "Email not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Beneficiary Login | Food Waste Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #11998e, #38ef7d);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }
        input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #11998e;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover {
            background: #38ef7d;
        }
        .tabs {
            display: flex;
            justify-content: center;
        }
        .tab {
            padding: 10px;
            cursor: pointer;
            margin: 5px;
            border-bottom: 3px solid transparent;
        }
        .active {
            border-bottom: 3px solid #11998e;
        }
        .forgot-password {
            color: #11998e;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Food Waste Management</h2>
        <div class="tabs">
            <div id="signinTab" class="tab active" onclick="showForm('signin')">Sign In</div>
            <div id="signupTab" class="tab" onclick="showForm('signup')">Sign Up</div>
        </div>
        <p class="message"><?php if(isset($message)) echo $message; ?></p>
        
        <!-- Sign-In Form -->
        <form id="signinForm" method="POST" style="display: block;">
            <input type="email" name="email" placeholder="Enter your email" required>
            <input type="password" name="password" placeholder="Enter your password" required>
            <p class="forgot-password">Forgot Password?</p>
            <button type="submit" name="login">Login</button>
        </form>

        <!-- Sign-Up Form -->
        <form id="signupForm" method="POST" style="display: none;">
            <input type="text" name="name" placeholder="Enter your full name" required>
            <input type="email" name="email" placeholder="Enter your email" required>
            <input type="tel" name="phone" placeholder="Enter your phone number" required>
            <input type="text" name="address" placeholder="Enter your address" required>
            <input type="password" name="password" placeholder="Create a password" required>
            <button type="submit" name="register">Register</button>
        </form>
    </div>

    <script>
        function showForm(form) {
            document.getElementById("signinForm").style.display = form === "signin" ? "block" : "none";
            document.getElementById("signupForm").style.display = form === "signup" ? "block" : "none";
            document.getElementById("signinTab").classList.toggle("active", form === "signin");
            document.getElementById("signupTab").classList.toggle("active", form === "signup");
        }
    </script>
</body>
</html>
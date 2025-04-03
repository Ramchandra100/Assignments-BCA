<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Encrypt password
    $role = $_POST["role"];

    
    $checkEmailQuery = "SELECT id FROM users WHERE email = $1";
    $checkEmail = pg_prepare($conn, "check_email", $checkEmailQuery);
    $checkEmailResult = pg_execute($conn, "check_email", array($email));

    if (pg_num_rows($checkEmailResult) > 0) {
        echo "Email already exists. Please use another email.";
    } else {
       
        $insertQuery = "INSERT INTO users (name, email, password, role) VALUES ($1, $2, $3, $4)";
        $stmt = pg_prepare($conn, "insert_user", $insertQuery);
        $result = pg_execute($conn, "insert_user", array($name, $email, $password, $role));

        if ($result) {
            echo "Signup successful! You can now <a href='login.php'>login</a>.";
        } else {
            echo "Error: " . pg_last_error($conn);
        }
    }
    header("Location: login.php");  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup | House Rental System</title>
    <link rel="stylesheet" href="css/signup.css">
</head>
<body style="background: url('images/b1.jpg') no-repeat center center/cover;">
    <div class="signup-container">
        <h2>Sign Up</h2>
        <form id="signupForm" method="POST">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="role">Select Role:</label>
            <select id="role" name="role">
                <option value="tenant">Tenant</option>
                <option value="landlord">Landlord</option>
            </select>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="contact">Contact Number:</label>
            <input type="number" id="contact" name="contact_number" required>
            
            <button type="submit">Sign Up</button>
        </form>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</body>
</html>

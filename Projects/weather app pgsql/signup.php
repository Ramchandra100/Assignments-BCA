<?php
// Database connection
$servername = "localhost";
$username = "postgres"; // Default PostgreSQL username
$password = "root"; // Replace with your PostgreSQL password
$dbname = "testdb";

$conn = pg_connect("host=$servername dbname=$dbname user=$username password=$password");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

// Handle signup
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
        $username = pg_escape_string($_POST['username']);
        $email = pg_escape_string($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        if (pg_query($conn, $sql)) {
            echo "<script>alert('Signup successful!'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Error: " . pg_last_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('Please fill in all required fields!');</script>";
    }
}

pg_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 300px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #555;
        }
        .already-have-account {
            text-align: center;
            margin-top: 20px;
        }
        .already-have-account a {
            color: #333;
            text-decoration: none;
        }
        .already-have-account a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Signup</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit">Signup</button>
            </div>
        </form>
        <div class="already-have-account">
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>
</body>
</html>
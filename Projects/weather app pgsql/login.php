<?php
// Start the session
session_start();

// Database connection
$servername = "localhost";
$username = "postgres"; // Default PostgreSQL username
$password = "root"; // Replace with your PostgreSQL password
$dbname = "testdb";

$conn = pg_connect("host=$servername dbname=$dbname user=$username password=$password");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

// Handle login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = pg_escape_string($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = pg_query($conn, $sql);

    if (pg_num_rows($result) > 0) {
        $user = pg_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            // Redirect to dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<script>alert('Invalid password!');</script>";
        }
    } else {
        echo "<script>alert('User not found!');</script>";
    }
}

pg_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        .no-account {
            text-align: center;
            margin-top: 20px;
        }
        .no-account a {
            color: #333;
            text-decoration: none;
        }
        .no-account a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit">Login</button>
            </div>
        </form>
        <div class="no-account">
            <p>Don't have an account? <a href="signup.php">Sign up here</a></p>
        </div>
    </div>
</body>
</html>
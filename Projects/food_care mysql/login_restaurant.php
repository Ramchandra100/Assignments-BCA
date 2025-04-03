
<?php
session_start();

$host = "localhost";
$user = "root";
$password = "";
$database = "food_management_system";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

    $checkEmail = $conn->prepare("SELECT id FROM restaurants WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $result = $checkEmail->get_result();

    if ($result->num_rows > 0) {
        $message = "Email already registered!";
    } else {
        $stmt = $conn->prepare("INSERT INTO restaurants (name, email, phone, address, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $email, $phone, $address, $password);
        if ($stmt->execute()) {
            $message = "Registration successful! You can now log in.";
        } else {
            $message = "Error: " . $stmt->error;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, password FROM restaurants WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION["restaurant_id"] = $row["id"];
            echo "<script>alert('Login successful! Redirecting...'); window.location.href='donate_food.php';</script>";
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
    <title>Restaurant Login & Signup</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(-45deg, #11998e, #38ef7d, #56ab2f, #a8e063);
            background-size: 400% 400%;
            animation: gradientBG 6s infinite linear;
        }
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
            width: 400px;
            text-align: center;
        }
        input {
            width: 90%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn {
            width: 100%;
            padding: 12px;
            background: #11998e;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: transform 0.2s, background 0.3s;
        }
        .btn:hover {
            background: #0c7a69;
            transform: scale(1.05);
        }
        .signup-link {
            margin-top: 10px;
            font-size: 14px;
        }
        .signup-link a {
            color: #11998e;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Food Waste Management</h2>
        <p class="message"><?php echo $message; ?></p>
        <form id="loginForm" method="POST">
            <input type="email" name="email" placeholder="Enter your email" required>
            <input type="password" name="password" placeholder="Enter your password" required>
            <button class="btn" type="submit" name="login">Login</button>
        </form>
        <p class="signup-link">New user? <a href="#" onclick="showForm('signup')">Sign up first</a></p>
        <form id="signupForm" method="POST" style="display:none;">
            <input type="text" name="name" placeholder="Enter your restaurant name" required>
            <input type="email" name="email" placeholder="Enter your email" required>
            <input type="tel" name="phone" placeholder="Enter your phone number" required>
            <input type="text" name="address" placeholder="Enter your address" required>
            <input type="password" name="password" placeholder="Create a password" required>
            <button class="btn" type="submit" name="register">Register</button>
        </form>
    </div>
    <script>
        function showForm(form) {
            document.getElementById("loginForm").style.display = form === "login" ? "block" : "none";
            document.getElementById("signupForm").style.display = form === "signup" ? "block" : "none";
        }
    </script>
</body>
</html>


<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Management System</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: url('f4.jpg') no-repeat center center/cover;
            color: white;
            text-align: center;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 50px;
            background: rgba(0, 0, 0, 0.7);
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .navbar .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .navbar ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
        }

        .navbar ul li {
            margin: 0 15px;
        }

        .navbar ul li a {
            text-decoration: none;
            color: white;
            font-weight: 600;
            transition: color 0.3s;
        }

        .navbar ul li a:hover {
            color: #38ef7d;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            padding-top: 80px;
        }

        .container h1 {
            font-size: 50px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .btn-container {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }

        .btn {
            padding: 15px 30px;
            font-size: 18px;
            font-weight: 600;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s;
            
        }

        .btn-donate {
            background: #ff4b5c;
            color: white;
            box-shadow: 0px 5px 10px rgba(255, 75, 92, 0.4);
        }

        .btn-request {
            background: #1cb5e0;
            color: white;
            box-shadow: 0px 5px 10px rgba(28, 181, 224, 0.4);
        }

        .btn-admin {
            background: #f39c12;
            color: white;
            box-shadow: 0px 5px 10px rgba(243, 156, 18, 0.4);
        }

        .btn:hover {
            transform: scale(1.1);
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">Food Management</div>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="aboutus.php">About Us</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <li><a href="help.php">Help</a></li>
            <li><a href="notification.php">Notifications</a></li>
        </ul>
    </nav>

    <div class="container">
        <h1>Welcome to the Food Management System</h1>
        <p>Donate food to those in need or request food for assistance.</p>
        <div class="btn-container">
            <a href="login_admin.php" class="btn btn-donate">Donate Food</a>
            <a href="login_beneficary.php" class="btn btn-request">Request Food</a>
            <a href="login_admin.php" class="btn btn-admin">Admin Panel</a>
        </div>
    </div>
</body>
</html>


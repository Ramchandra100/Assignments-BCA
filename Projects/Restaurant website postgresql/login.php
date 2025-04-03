<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = pg_connect("host=localhost dbname=flavorhaven user=postgres password=root");
    if (!$conn) {
        die("Connection failed: " . pg_last_error());
    }

    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = pg_query($conn, $query);

        if (pg_num_rows($result) == 1) {
            $user = pg_fetch_assoc($result);
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header("Location: index.php");
                exit();
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "Username not found.";
        }
    } elseif (isset($_POST['signup'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $query = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
        $result = pg_query($conn, $query);

        if ($result) {
            $_SESSION['user_id'] = pg_last_oid($result);
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit();
        } else {
            $error = "Registration failed.";
        }
    }

    pg_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Sign up page</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="login_style.css">
</head>
<body>
    <div class="container">
        <div class="form-box login">
            <form action="" method="POST">
                <h1> Login </h1>
                <div class="input-box">
                    <input type="text" name="username" placeholder="Username" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <div class="forget-link">
                    <a href="#">Forget Password</a>
                </div>
                <button type="submit" name="login" class="btn">Login</button>
                <p>or login with social platform</p>
                <div class="social-icons">
                    <a href="#"><i class='bx bxl-google' ></i></a>
                    <a href="#"><i class='bx bxl-facebook'></i></a>
                    <a href="#"><i class='bx bxl-github'></i></a>
                    <a href="#"><i class='bx bxl-linkedin'></i></a>
                </div>
            </form>
        </div>

        <div class="form-box signup">
            <form action="" method="POST">
                <h1> Sign Up </h1>
                <div class="input-box">
                    <input type="text" name="username" placeholder="Username" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="email" name="email" placeholder="Email" required>
                    <i class='bx bxs-envelope'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <button type="submit" name="signup" class="btn">Sign Up</button>
                <p>or sign up with social platform</p>
                <div class="social-icons">
                    <a href="#"><i class='bx bxl-google' ></i></a>
                    <a href="#"><i class='bx bxl-facebook'></i></a>
                    <a href="#"><i class='bx bxl-github'></i></a>
                    <a href="#"><i class='bx bxl-linkedin'></i></a>
                </div>
            </form>
        </div>

        <div class="toggle-box">
            <div class="toggle-panel toggle-left">
                <h1>Hello Welcome!</h1>
                <p> Don't have an account</p>
                <button class="btn signup-btn">Sign Up</button>
            </div>
            <div class="toggle-panel toggle-right">
                <h1> Welcome Back </h1>
                <p> Already have an account</p>
                <button class="btn login-btn">Login</button>
            </div>
        </div>
    </div>

    <script src="login_script.js"></script>
</body>
</html>
<?php
session_start();
include 'config.php';

$error_message = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $selected_role = $_POST["role"];

    
    
    $query = "SELECT id, name, password, role FROM users WHERE email = $1";
    $stmt = pg_prepare($conn, "check_user", $query);
    $result = pg_execute($conn, "check_user", array($email));

    if (pg_num_rows($result) > 0) {
        $user = pg_fetch_assoc($result);

      
        
        if (password_verify($password, $user['password'])) {
            if ($user['role'] === $selected_role) {
                
                $_SESSION["user_id"] = $user['id'];
                $_SESSION["name"] = $user['name'];
                $_SESSION["role"] = $user['role'];

                
                
                if ($user['role'] == "landlord") {
                    header("Location: landlord_dashboard.php");
                } else {
                    header("Location: tenant_dashboard.php");
                }
                exit();
            } else {
                $error_message = "Incorrect role selected. Please choose the correct role.";
            }
        } else {
            $error_message = "Incorrect password.";
        }
    } else {
        $error_message = "No account found with this email.";
    }
}
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | House Rental System</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body style="background: url('images/b1.jpg') no-repeat center center/cover;">
    <div class="login-container">
        <h2>Login</h2>

        <?php if (!empty($error_message)): ?>
            <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
        <?php endif; ?>

        <form id="loginForm" method="post">
            <label for="role">Select Role:</label>
            <select id="role" name="role" required>
                <option value="tenant">Tenant</option>
                <option value="landlord">Landlord</option>
            </select>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="signup.php">Sign up</a></p>
    </div>
</body>
</html>

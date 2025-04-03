<?php

include 'config.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: home_page.php");
    exit();
}

$user_id = $_SESSION['user_id'];


$query = "SELECT * FROM users WHERE id = $1";
$result = pg_query_params($conn, $query, array($user_id));
$user = pg_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="css/user_profile.css">
    
</head>

<body>
    <header>
        <nav>
            <h1>House Rental System</h1>
            <ul>
                <li><a href="tenant_dashboard.php">Home</a></li>
                <li><a href="user_profile.php">Profile</a></li>
                <li><a href="home_page.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section class="profile-container">
        <div class="profile-card">
            <div class="profile-icon">
                <i class="fas fa-user-circle"></i>
            </div>
            <h2><?php echo htmlspecialchars($user['name']); ?></h2>
            <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
            <p>Role: <?php echo ucfirst(htmlspecialchars($user['role'])); ?></p>
            <p>Joined on: <?php echo date('d M Y', strtotime($user['created_at'])); ?></p>

            <a href="edit_profile.php" class="edit-btn">Edit Profile</a>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 House Rental System. All Rights Reserved.</p>
    </footer>
</body>

</html>

<?php

include 'config.php';  



session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: Home_page.php");
    exit();
}

$user_id = $_SESSION['user_id'];



if (!$conn) {
    die("Connection failed: " . pg_last_error());
}



$query = "SELECT * FROM users WHERE id = $1";
$result = pg_query_params($conn, $query, array($user_id));
$user = pg_fetch_assoc($result);



if (isset($_POST['update_profile'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $user['password'];

   
    $update_query = "UPDATE users SET name = $1, email = $2, password = $3 WHERE id = $4";
    $update_result = pg_query_params($conn, $update_query, array($name, $email, $password, $user_id));

    if ($update_result) {
        echo "<script>alert('Profile Updated Successfully!'); window.location='user_profile.php';</script>";
    } else {
        echo "Update Failed!";
    }
}


pg_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="css/edit_profile.css">
</head>

<body>
    <header>
        <nav>
            <h1>House Rental System</h1>
            <ul>
                <li><a href="tenant_dashboard.php">Home</a></li>
                <li><a href="user_profile.php">Profile</a></li>
                <li><a href="Home_Page.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section class="edit-profile-container">
        <h2>Edit Profile</h2>
        <form method="POST">
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <label for="password">New Password:</label>
            <input type="password" name="password" placeholder="Leave blank to keep current password">

            <button type="submit" name="update_profile">Update Profile</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2025 House Rental System. All Rights Reserved.</p>
    </footer>
</body>

</html>

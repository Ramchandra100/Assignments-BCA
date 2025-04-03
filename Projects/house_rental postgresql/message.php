<?php
session_start();
include 'config.php'; 




$user_id = $_SESSION['user_id']; 



if (isset($_POST['send_message'])) {
    $receiver_id = $_POST['receiver_id'];
    $message = $_POST['message'];

    
    
    $insertQuery = "INSERT INTO messages (sender_id, receiver_id, message) VALUES ($1, $2, $3)";
    $stmt = pg_prepare($conn, "send_message", $insertQuery);
    pg_execute($conn, "send_message", [$user_id, $receiver_id, $message]);

    header("Location: message.php"); 
    exit();
}


$query = "SELECT * FROM messages WHERE sender_id = $1 OR receiver_id = $1 ORDER BY timestamp DESC";
$result = pg_prepare($conn, "fetch_messages", $query);
$messages = pg_execute($conn, "fetch_messages", [$user_id]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Messages</title>
    <link rel="stylesheet" href="css/message.css">
        <style>
        body {
            background-image: url('images/message.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body >


<nav class="navbar">
    <h1>House Rental System</h1>
    <ul>
        <li><a href="message.php" class="active">💬 Messages</a></li>
        <li><a href="Home_Page.php">🚪 Logout</a></li>
    </ul>
</nav>


<div class="message-container">
    <h2>📩 Messages</h2>

   
    <div class="message-list">
        <?php while ($row = pg_fetch_assoc($messages)): ?>
            <div class="<?= ($row['sender_id'] == $user_id) ? 'sent' : 'received'; ?>">
                <p><?= $row['message']; ?></p>
                <span><?= date('d M Y, H:i', strtotime($row['timestamp'])); ?></span>
            </div>
        <?php endwhile; ?>
    </div>

    
    <form method="POST">
        <select name="receiver_id" required>
            <option value="" disabled selected>📧 Select User</option>
            <?php
            $users = pg_query($conn, "SELECT id, name FROM users WHERE id != $user_id");
            while ($user = pg_fetch_assoc($users)) {
                echo "<option value='{$user['id']}'>{$user['name']}</option>";
            }
            ?>
        </select>
        <textarea name="message" placeholder="Type your message..." required></textarea>
        <button type="submit" name="send_message">📤 Send</button>
    </form>
</div>


<footer>
    <p>&copy; <?php echo date("Y"); ?> House Rental System. All rights reserved.</p>
</footer>

</body>
</html>

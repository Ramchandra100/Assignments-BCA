
<?php
include 'db_connect.php'; // Database connection

// Ensure notifications table exists
$createTableQuery = "CREATE TABLE IF NOT EXISTS notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    message TEXT NOT NULL,
    type VARCHAR(50) NOT NULL,  -- success, warning, info, error
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($createTableQuery);

// Fetch notifications from the database
$sql = "SELECT * FROM notifications ORDER BY created_at DESC";
$result = $conn->query($sql);

$notifications = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $notifications[] = $row;
    }
}

// Clear all notifications
if (isset($_POST['clear'])) {
    $conn->query("DELETE FROM notifications");
    header("Location: notification.php"); // Refresh the page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications & Alerts</title>
    <style>
        /* General Styling */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to right, #11998e, #38ef7d);
        }

        .notification-container {
            width: 50%;
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            transition: 0.3s;
        }

        .notification-container:hover {
            transform: scale(1.02);
        }

        h2 {
            margin-bottom: 10px;
            font-size: 24px;
            color: #333;
        }

        .notifications {
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-height: 300px;
            overflow-y: auto;
            padding: 10px;
            border-radius: 8px;
            background: #fff;
            border: 1px solid #ddd;
        }

        /* Notification Card Styling */
        .notification-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            position: relative;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }

        .notification-card:hover {
            transform: scale(1.03);
        }

        .success { background-color: #d4edda; border-left: 5px solid #28a745; }
        .warning { background-color: #fff3cd; border-left: 5px solid #ffc107; }
        .info { background-color: #cce5ff; border-left: 5px solid #007bff; }
        .error { background-color: #f8d7da; border-left: 5px solid #dc3545; }

        .timestamp {
            font-size: 14px;
            color: #666;
            margin-left: 10px;
        }

        /* Clear Button */
        #clear-notifications {
            background: #ff4757;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }

        #clear-notifications:hover {
            background: #e84118;
        }
    </style>
</head>
<body>
    <div class="notification-container">
        <h2>🔔 Notifications & Alerts</h2>
        <p>Stay updated with real-time notifications.</p>

        <!-- Clear Notifications Button -->
        <form method="post">
            <button type="submit" name="clear" id="clear-notifications">Clear All</button>
        </form>

        <!-- Notifications List -->
        <div class="notifications">
            <?php if (!empty($notifications)): ?>
                <?php foreach ($notifications as $notification): ?>
                    <div class="notification-card <?= $notification['type']; ?>">
                        <span class="message"><?= htmlspecialchars($notification['message']); ?></span>
                        <span class="timestamp"><?= $notification['created_at']; ?></span>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No new notifications.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

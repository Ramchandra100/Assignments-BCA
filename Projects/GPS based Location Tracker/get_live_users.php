<?php
include 'db.php';

$result = $conn->query("SELECT users.name, users.email, user_locations.latitude, user_locations.longitude 
                        FROM users 
                        JOIN user_locations ON users.id = user_locations.user_id");

$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

echo json_encode($users);
?>
<?php
session_start();
include 'db_connect.php'; // Make sure this file contains the correct PostgreSQL connection details

// Approve or Reject Donation
if (isset($_POST['update_donation_status'])) {
    $id = $_POST['donation_id'];
    $status = $_POST['update_donation_status'];

    try {
        $conn->beginTransaction();
        if ($status == 'Approved') {
            $conn->exec("UPDATE food_donations SET status='Approved' WHERE id=$id");
        } elseif ($status == 'Rejected') {
            $conn->exec("DELETE FROM food_donations WHERE id=$id");
        }
        $conn->commit();
    } catch (PDOException $e) {
        $conn->rollBack();
        die("Error: " . $e->getMessage());
    }

    header("Location: admin_dashboard.php");
    exit();
}

// Approve or Reject Food Request
if (isset($_POST['update_request_status'])) {
    $id = $_POST['request_id'];
    $status = $_POST['update_request_status'];

    try {
        $conn->beginTransaction();
        if ($status == 'Approved') {
            $conn->exec("UPDATE food_requests SET status='Approved' WHERE id=$id");
        } elseif ($status == 'Rejected') {
            $conn->exec("DELETE FROM food_requests WHERE id=$id");
        }
        $conn->commit();
    } catch (PDOException $e) {
        $conn->rollBack();
        die("Error: " . $e->getMessage());
    }

    header("Location: admin_dashboard.php");
    exit();
}

// Fetch Food Donations
$donations = $conn->query("SELECT * FROM food_donations");

// Fetch Food Requests
$requests = $conn->query("SELECT * FROM food_requests");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #11998e, #38ef7d);
            color: white;
            text-align: center;
            margin: 0;
            padding: 20px;
        }
        .container {
            width: 80%;
            margin: auto;
            background: rgba(0, 0, 0, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            background: white;
            color: black;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background: #11998e;
            color: white;
        }
        .approve, .reject {
            padding: 8px 12px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            color: white;
        }
        .approve {
            background: green;
        }
        .reject {
            background: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Dashboard</h2>

        <h3>Food Donations</h3>
        <table>
            <tr>
                <th>Food Name</th>
                <th>Quantity</th>
                <th>Donor Name</th>
                <th>Contact</th>
                <th>Location</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php while ($row = $donations->fetch()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['food_name']); ?></td>
                    <td><?= htmlspecialchars($row['quantity']); ?></td>
                    <td><?= htmlspecialchars($row['donor_name']); ?></td>
                    <td><?= htmlspecialchars($row['contact']); ?></td>
                    <td><?= htmlspecialchars($row['location']); ?></td>
                    <td><?= htmlspecialchars($row['status']); ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="donation_id" value="<?= $row['id']; ?>">
                            <button type="submit" name="update_donation_status" value="Approved" class="approve">Approve</button>
                            <button type="submit" name="update_donation_status" value="Rejected" class="reject">Reject</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

        <h3>Food Requests</h3>
        <table>
            <tr>
                <th>Requester Name</th>
                <th>Contact</th>
                <th>Address</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php while ($row = $requests->fetch()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['name']); ?></td>
                    <td><?= htmlspecialchars($row['contact']); ?></td>
                    <td><?= htmlspecialchars($row['address']); ?></td>
                    <td><?= htmlspecialchars($row['status']); ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="request_id" value="<?= $row['id']; ?>">
                            <button type="submit" name="update_request_status" value="Approved" class="approve">Approve</button>
                            <button type="submit" name="update_request_status" value="Rejected" class="reject">Reject</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
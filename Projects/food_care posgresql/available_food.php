<?php
session_start();
include 'db_connect.php'; // Ensure this file contains the correct PostgreSQL connection details

// Initialize messages
if (!isset($_SESSION['success_msg'])) $_SESSION['success_msg'] = "";
if (!isset($_SESSION['error_msg'])) $_SESSION['error_msg'] = "";

// Handle food request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['request_food'])) {
    $food_id = $_POST['food_id'];
    $beneficiary_name = $_POST['beneficiary_name'];
    $contact = $_POST['contact'];

    // Insert request into food_requests table
    $query = "INSERT INTO food_requests (food_id, name, contact, status) VALUES (:food_id, :beneficiary_name, :contact, 'Pending')";
    
    try {
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':food_id', $food_id);
        $stmt->bindParam(':beneficiary_name', $beneficiary_name);
        $stmt->bindParam(':contact', $contact);
        $stmt->execute();
        
        $_SESSION['success_msg'] = "Your food request has been submitted successfully!";
    } catch (PDOException $e) {
        $_SESSION['error_msg'] = "Error: " . $e->getMessage();
    }

    // Redirect to avoid form resubmission
    header("Location: available_food.php");
    exit();
}

// Fetch approved food donations
$donations = $conn->query("SELECT * FROM food_donations WHERE status='Approved'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Food</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #11998e, #38ef7d); /* ✅ Consistent color */
            color: white;
            text-align: center;
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
        .request-btn {
            padding: 8px 12px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            background: green;
            color: white;
        }
        .message {
            margin-top: 10px;
            padding: 10px;
            color: white;
            border-radius: 5px;
            display: none;
        }
        .success {
            background: green;
        }
        .error {
            background: red;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Available Food Donations</h2>

        <?php if (!empty($_SESSION['success_msg'])) { ?>
            <div class="message success" id="successMessage"><?= htmlspecialchars($_SESSION['success_msg']); ?></div>
            <?php unset($_SESSION['success_msg']); ?>
        <?php } elseif (!empty($_SESSION['error_msg'])) { ?>
            <div class="message error" id="errorMessage"><?= htmlspecialchars($_SESSION['error_msg']); ?></div>
            <?php unset($_SESSION['error_msg']); ?>
        <?php } ?>

        <table>
            <tr>
                <th>Food Name</th>
                <th>Quantity</th>
                <th>Location</th>
                <th>Donor</th>
                <th>Contact</th>
                <th>Action</th>
            </tr>
            <?php while ($row = $donations->fetch()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['food_name']); ?></td>
                    <td><?= htmlspecialchars($row['quantity']); ?></td>
                    <td><?= htmlspecialchars($row['location']); ?></td>
                    <td><?= htmlspecialchars($row['donor_name']); ?></td>
                    <td><?= htmlspecialchars($row['contact']); ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="food_id" value="<?= $row['id']; ?>">
                            <input type="text" name="beneficiary_name" placeholder="Your Name" required>
                            <input type="text" name="contact" placeholder="Your Contact" required>
                            <button type="submit" name="request_food" class="request-btn">Request Food</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <script>
        // Show message for 3 seconds and then fade out
        document.addEventListener("DOMContentLoaded", function () {
            let successMsg = document.getElementById("successMessage");
            let errorMsg = document.getElementById("errorMessage");

            if (successMsg) {
                successMsg.style.display = "block";
                setTimeout(() => successMsg.style.display = "none", 3000);
            }
            if (errorMsg) {
                errorMsg.style.display = "block";
                setTimeout(() => errorMsg.style.display = "none", 3000);
            }
        });
    </script>

</body>
</html>
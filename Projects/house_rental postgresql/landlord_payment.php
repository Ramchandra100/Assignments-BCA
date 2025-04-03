<?php
session_start();
include 'config.php';  



if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'landlord') {
    header("Location: login.php");
    exit();
}

$landlord_id = $_SESSION['user_id'];  


// Default sorting order
$sort_order = $_GET['sort'] ?? 'desc';
$order_by = ($sort_order === 'asc') ? 'ASC' : 'DESC';



$query = "SELECT 
            p.transaction_id,
            p.amount, 
            p.payment_date,
            p.payment_method, 
            u.name AS tenant_name
          FROM payments p
          JOIN users u ON p.tenant_id = u.id
          JOIN properties prop ON prop.landlord_id = $1
          ORDER BY p.payment_date $order_by";

$result = pg_prepare($conn, "fetch_payments", $query);
$result = pg_execute($conn, "fetch_payments", array($landlord_id));



if (!$result) {
    die("Query Error: " . pg_last_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landlord Payments</title>
    <!-- <link rel="stylesheet" href="css/landloard_payment.css">  Link to your CSS file -->
     <style>
       
       
body {
    font-family: 'Arial', sans-serif;
    background: url('images/bg.webp') no-repeat center center/cover;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}



.navbar {
    position: fixed;
    top: 0;
    width: 100%;
    background: rgba(41, 128, 185, 0.95);
    padding: 15px 0;
    text-align: center;
}

.navbar a {
    color: white;
    text-decoration: none;
    font-size: 18px;
    margin: 0 15px;
    font-weight: bold;
    transition: 0.3s;
}

.navbar a:hover {
    color: #f1c40f;
}


.container {
    background: rgba(255, 255, 255, 0.95);
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
    text-align: center;
    max-width: 800px;
    width: 90%;
    margin-top: 100px;
    animation: fadeIn 0.5s ease-in-out;
}

h2 {
    color: #333;
    margin-bottom: 15px;
}



form {
    margin-bottom: 15px;
}

label {
    font-weight: bold;
}

select, button {
    padding: 8px;
    font-size: 16px;
    border: 2px solid #ddd;
    border-radius: 5px;
    transition: border 0.3s ease-in-out;
}

select:focus, button:focus {
    border-color: #2980b9;
}

button {
    background: #2980b9;
    color: white;
    border: none;
    cursor: pointer;
    margin-left: 5px;
    transition: 0.3s;
}

button:hover {
    background: #21618c;
}



table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

th, td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: center;
}

th {
    background: #2980b9;
    color: white;
}

td {
    background: #f9f9f9;
}



tbody tr:hover {
    background: #eaf2ff;
}



.footer {
    position: fixed;
    bottom: 0;
    width: 100%;
    background: rgba(41, 128, 185, 0.95);
    color: white;
    text-align: center;
    padding: 10px;
    font-size: 14px;
}



@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}



@media (max-width: 768px) {
    .container {
        max-width: 95%;
    }
}

     </style>
</head>
<body>
<div class="navbar">
    <a href="landlord_dashboard.php">Dashboard</a>
    <a href="landlord_payment.php">Payments</a>
    <a href="Home_Page.php">Logout</a>
</div>

    <div class="container">
        <h2>Payment History</h2>

      
        
        <form method="GET">
            <label for="sort">Sort by Date:</label>
            <select name="sort">
                <option value="desc" <?= ($sort_order === 'desc') ? 'selected' : ''; ?>>Newest First</option>
                <option value="asc" <?= ($sort_order === 'asc') ? 'selected' : ''; ?>>Oldest First</option>
            </select>
            <button type="submit">Apply</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Tenant Name</th>
                    <th>Amount ($)</th>
                    <th>Payment Date</th>
                    <th>Payment Method</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = pg_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?= htmlspecialchars($row['transaction_id']); ?></td>
                        <td><?= htmlspecialchars($row['tenant_name']); ?></td>
                        <td><?= htmlspecialchars($row['amount']); ?></td>
                        <td><?= htmlspecialchars($row['payment_date']); ?></td>
                        <td><?= htmlspecialchars($row['payment_method']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <div class="footer">
    &copy; 2025 House Rental System | All Rights Reserved
</div>
</body>
</html>

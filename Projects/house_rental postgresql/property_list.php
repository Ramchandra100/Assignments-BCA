<?php
session_start();
include 'config.php';


if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "tenant") {
    die("Unauthorized Access");
}

$query = "SELECT id, title, location, price, availability FROM properties WHERE availability = 'available'";
$result = pg_query($conn, $query);

$properties = [];
while ($row = pg_fetch_assoc($result)) {
    $properties[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Properties</title>
    <!-- <link rel="stylesheet" href="css/property_list.css"> -->
     <style>
        
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background: rgb(87, 162, 236);
    color: #fff;
}

/* Navbar */
.navbar {
    background: #2c3e50;
    padding: 15px 0;
}

.navbar .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
}

.navbar h2 {
    color: white;
    margin: 0;
}

.navbar ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
}

.navbar ul li {
    margin: 0 15px;
}

.navbar ul li a {
    text-decoration: none;
    color: white;
    font-weight: bold;
    transition: 0.3s;
}

.navbar ul li a:hover,
.navbar ul li.active a {
    color: #f39c12;
}

/* Container */
.container {
    max-width: 90%;
    margin: 30px auto;
    background: rgba(255, 255, 255, 0.1);
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    text-align: center;
}

/* Heading */
h1 {
    font-size: 28px;
    margin-bottom: 20px;
}

/* Property Table */
.property-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background: #34495e;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.3);
}

.property-table th,
.property-table td {
    padding: 15px;
    text-align: center;
    border-bottom: 1px solid #ddd;
    color: white;
}

.property-table th {
    background-color: #2980b9;
    font-size: 16px;
}

.property-table tr:hover {
    background-color: #1abc9c;
    transition: 0.3s;
}

/* Book Button */
.book-btn {
    display: inline-block;
    background: #e74c3c;
    color: white;
    padding: 10px 15px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
    transition: 0.3s;
}

.book-btn:hover {
    background: #c0392b;
}

/* No Properties Message */
.no-properties {
    text-align: center;
    font-size: 18px;
    margin-top: 20px;
    background: #e74c3c;
    padding: 10px;
    border-radius: 5px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        max-width: 95%;
        padding: 15px;
    }

    .navbar .container {
        flex-direction: column;
        text-align: center;
    }

    .navbar ul {
        flex-direction: column;
        padding-top: 10px;
    }

    .navbar ul li {
        margin: 10px 0;
    }

    .property-table {
        font-size: 14px;
    }
}

     </style>
</head>
<body>

 
    <nav class="navbar">
        <div class="container">
            <h2>🏠 Rental System</h2>
            <ul>
                <li class="active"><a href="property_list.php">View Properties</a></li>
                <li><a href="tenant_dashboard.php">My Bookings</a></li>
                <li><a href="user_profile.php">Edit Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    
    <div class="container">
        <h1>Available Properties</h1>

        <?php if (count($properties) > 0): ?>
            <table class="property-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Location</th>
                        <th>Price (₹)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($properties as $property): ?>
                        <tr>
                            <td><?= htmlspecialchars($property["title"]) ?></td>
                            <td><?= htmlspecialchars($property["location"]) ?></td>
                            <td><?= number_format($property["price"], 2) ?></td>
                            <td>
                                <a href="book_property.php?property_id=<?= urlencode($property['id']) ?>" 
                                   class="book-btn">📌 Book Now</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-properties">No properties available at the moment.</p>
        <?php endif; ?>
    </div>

</body>
</html>

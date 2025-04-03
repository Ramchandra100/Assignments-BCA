<?php
session_start();
include 'config.php'; 

$landlord_id = 1;



if (isset($_POST['add_property'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    $contact = $_POST['contact'];
    $availability = $_POST['availability']; 
    
    
    
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_path = "images/" . $image_name;
    move_uploaded_file($image_tmp, $image_path);

  
    $query = "INSERT INTO properties (landlord_id, title, description, location, price, contact_number, availability, image, created_at) 
              VALUES ($1, $2, $3, $4, $5, $6, $7, $8, NOW())";
    $stmt = pg_prepare($conn, "add_property", $query);
    pg_execute($conn, "add_property", [$landlord_id, $title, $description, $location, $price, $contact, $availability, $image_name]);

    header("Location: landlord_dashboard.php");
    exit();
}



if (isset($_POST['delete_property'])) {
    $property_id = $_POST['property_id'];
    pg_query($conn, "DELETE FROM properties WHERE id = $property_id");
    header("Location: landlord_dashboard.php");
    exit();
}


if (isset($_POST['approve_booking'])) {
    $booking_id = $_POST['booking_id'];
    pg_query($conn, "UPDATE bookings SET status = 'confirmed' WHERE id = $booking_id");
    header("Location: landlord_dashboard.php");
    exit();
}



if (isset($_POST['cancel_booking'])) {
    $booking_id = $_POST['booking_id'];
    pg_query($conn, "UPDATE bookings SET status = 'cancelled' WHERE id = $booking_id");
    header("Location: landlord_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Landlord Dashboard</title>
    <link rel="stylesheet" href="css/landlord_dashboard.css">
</head>

<body>

    

    <div class="sidebar">
        <h1>Home</h1>
        <button onclick="showSection('manage-properties')">🏠 Manage Properties</button>
        <button onclick="showSection('manage-bookings')">📅 Manage Bookings</button>
        <button>
        <i style="color: white;">💬</i>
        <a href="message.php" style="color: white; text-decoration: none;">Messages</a>
        </button>

        <button>
            <i style="color: white;">💳</i>
            <a href="landlord_payment.php" style="color: white; text-decoration: none;">Payment History</a>
        </button>
        <button>
            <i style="color: white;">👤</i>
            <a href="landlord_profile.php" style="color: white; text-decoration: none;">Update Profile</a>
        </button>
        <button>
            <i style="color: white;">🚪</i>
            <a href="Home_Page.php" style="color: white; text-decoration: none;">Logout</a>
        </button>
        
    </div>

   
    
    <div class="section active" id="manage-properties">
        <h2>Manage Properties</h2>
        <button onclick="showPropertyForm()">➕ Add Property</button>

        
        
        <form method="POST" enctype="multipart/form-data" id="property-form" class="hidden">
            <input type="text" name="title" placeholder="Property Title" required>
            <input type="text" name="description" placeholder="Description" required>
            <input type="text" name="location" placeholder="Location" required>
            <input type="number" name="price" placeholder="Price" required>
            <input type="text" name="contact" placeholder="Contact Number" required>
            <select name="availability">
                <option value="available">Available</option>
                <option value="rented">Rented</option>
            </select>
            <input type="file" name="image" required>
            <button type="submit" name="add_property">✅ Save Property</button>
            <button type="button" onclick="hidePropertyForm()">❌ Cancel</button>
        </form>

        <!-- Property Table -->
        <table class="property-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Location</th>
                    <th>Price</th>
                    <th>Contact</th>
                    <th>Availability</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = pg_query($conn, "SELECT id, title, description, location, price, contact_number, availability, image FROM properties WHERE landlord_id = $landlord_id");
                while ($row = pg_fetch_assoc($result)) {
                    echo "
                    <tr>
                        <td><img src='images/{$row['image']}' width='60'></td>
                        <td>{$row['title']}</td>
                        <td>{$row['location']}</td>
                        <td>{$row['price']}</td>
                        <td>{$row['contact_number']}</td>
                        <td>{$row['availability']}</td>
                        <td>
                            <form method='POST' class='inline-form'>
                                <input type='hidden' name='property_id' value='{$row['id']}'>
                                <button type='submit' name='delete_property'>❌ Delete</button>
                            </form>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

   
    
    <div class="section" id="manage-bookings">
        <h2>Manage Bookings</h2>
        <table class="booking-table">
            <thead>
                <tr>
                    <th>Property</th>
                    <th>Tenant Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $bookings = pg_query($conn, "SELECT b.id, p.title, u.name, b.status 
                                             FROM bookings b 
                                             JOIN properties p ON b.property_id = p.id 
                                             JOIN users u ON b.tenant_id = u.id");
                while ($row = pg_fetch_assoc($bookings)) {
                    echo "
                    <tr>
                        <td>{$row['title']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['status']}</td>
                        <td>
                            <form method='POST' class='inline-form'>
                                <input type='hidden' name='booking_id' value='{$row['id']}'>
                                <button type='submit' name='approve_booking'>✅ Approve</button>
                                <button type='submit' name='cancel_booking'>❌ Cancel</button>
                            </form>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

<script>
    function showSection(sectionId) {
        document.querySelectorAll('.section').forEach(section => section.classList.remove('active'));
        document.getElementById(sectionId).classList.add('active');
    }

    function showPropertyForm() {
        document.getElementById('property-form').classList.remove('hidden');
    }

    function hidePropertyForm() {
        document.getElementById('property-form').classList.add('hidden');
    }
</script>

</body>
</html>


<<?php
include 'db_connect.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Insert into database
    $sql = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('✅ Message sent successfully!');</script>";
    } else {
        echo "<script>alert('❌ Error: " . mysqli_error($conn) . "');</script>";
    }
}

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Food Management System</title>
    
    <!-- Google Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
        /* General Styling */
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(to right, #11998e, #38ef7d); /* Background you liked */
        }

        /* Contact Wrapper */
        .contact-wrapper {
            display: flex;
            width: 80%;
            max-width: 1000px;
            background: white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        /* Left Section: Contact Info */
        .contact-info {
            width: 40%;
            background: #0f807e;
            color: white;
            padding: 30px;
            text-align: center;
        }

        .contact-info h2 {
            margin-bottom: 15px;
            font-size: 28px;
        }

        .contact-details p {
            margin: 10px 0;
            font-size: 16px;
        }

        .contact-details i {
            margin-right: 10px;
            color: #ffeb3b;
        }

        /* Social Icons */
        .social-icons {
            margin-top: 20px;
        }

        .social-icons a {
            color: white;
            font-size: 20px;
            margin: 0 10px;
            transition: 0.3s;
        }

        .social-icons a:hover {
            color: #ffeb3b;
        }

        /* Right Section: Contact Form */
        .contact-form {
            width: 60%;
            padding: 40px;
        }

        .contact-form h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 28px;
            color: #0f807e;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 2px solid #11998e;
            border-radius: 5px;
            font-size: 16px;
            background: #f9f9f9;
        }

        textarea {
            height: 120px;
        }

        .submit-btn {
            width: 100%;
            background: #11998e;
            color: white;
            padding: 12px;
            border: none;
            font-size: 18px;
            cursor: pointer;
            transition: 0.3s;
        }

        .submit-btn:hover {
            background: #0f807e;
        }
    </style>

</head>
<body>

    <div class="contact-wrapper">
        <!-- Left Section: Contact Information -->
        <div class="contact-info">
            <h2>📞 Get in Touch</h2>
            <p>We would love to hear from you! Feel free to reach out with any questions or feedback.</p>

            <div class="contact-details">
                <p><i class="fas fa-map-marker-alt"></i> 123 Food Help Street, City, Country</p>
                <p><i class="fas fa-envelope"></i> support@foodmanagement.com</p>
                <p><i class="fas fa-phone-alt"></i> +1 234 567 890</p>
            </div>

            <!-- Social Media Links -->
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>

        <!-- Right Section: Contact Form -->
        <div class="contact-form">
            <h2>📨 Send a Message</h2>
            <form action="contact.php" method="POST">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <textarea name="message" placeholder="Your Message" required></textarea>
                <button type="submit" class="submit-btn">Send Message</button>
            </form>
        </div>
    </div>

</body>
</html>

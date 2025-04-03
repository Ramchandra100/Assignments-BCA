<?php
// Database Connection
$host = "localhost";
$dbname = "food_management_system";
$user = "postgres";
$password = "root";

try {
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Fetch Team Members
$team_sql = "SELECT name, role, img FROM team";
$team_result = $conn->query($team_sql);

// Fetch Testimonials
$testimonial_sql = "SELECT name, feedback FROM testimonials";
$testimonial_result = $conn->query($testimonial_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Food Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #11998e, #38ef7d);
            color: #333;
        }
        header {
            background-color: #00264d;
            padding: 20px;
            text-align: center;
            color: #fff;
            border-bottom: 4px solid #ffcc00;
        }
        nav ul {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
        }
        nav ul li {
            margin: 0 20px;
        }
        nav ul li a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            font-size: 18px;
            transition: color 0.3s;
        }
        nav ul li a:hover {
            color: #ffcc00;
        }

        .hero {
            text-align: center;
            padding: 80px;
            background: url('f4.jpg') no-repeat center center/cover;
            color: #fff;
            position: relative;
        }
        .hero h1 {
            font-size: 48px;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
        }

        .content-section {
            padding: 50px;
            text-align: center;
            background: url('section_bg.jpg') no-repeat center center/cover;
            color: #fff;
            margin: 20px 40px;
            border-radius: 10px;
        }
        .content-section h2 {
            font-size: 32px;
            border-bottom: 3px solid #ffcc00;
            display: inline-block;
            padding-bottom: 10px;
        }

        .team-container, .work-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
            margin-top: 30px;
        }
        .team-member, .work-item {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            width: 250px;
            transition: transform 0.3s ease;
        }
        .team-member img, .work-item img {
            width: 100%;
            border-radius: 10px;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #00264d;
            color: white;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="#mission">Mission</a></li>
                <li><a href="#team">Our Team</a></li>
                <li><a href="#work">Our Work</a></li>
                <li><a href="#testimonials">Testimonials</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <section class="hero">
        <h1>About Us</h1>
        <p>"Where Every Extra Bite Makes a Difference."</p>
    </section>

    <section id="work" class="content-section">
        <h2>Our Work</h2>
        <div class="work-container">
            <div class="work-item"><img src="a1.jpg" alt="Work 1"></div>
            <div class="work-item"><img src="a2.jpg" alt="Work 2"></div>
            <div class="work-item"><img src="a3.jpg" alt="Work 3"></div>
        </div>
    </section>

    <section id="team" class="content-section">
        <h2>Meet Our Team</h2>
        <div class="team-container">
            <?php if ($team_result && $team_result->rowCount() > 0): ?>
                <?php while ($row = $team_result->fetch()): ?>
                    <div class="team-member">
                        <img src="<?php echo htmlspecialchars($row['img']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
                        <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                        <p><?php echo htmlspecialchars($row['role']); ?></p>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No team members available.</p>
            <?php endif; ?>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 FoodCare | Making a difference, one meal at a time.</p>
    </footer>
</body>
</html>

<?php $conn = null; ?>
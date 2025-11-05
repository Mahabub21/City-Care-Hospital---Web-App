<?php
session_start();

// Check if user is logged in and 'user_id' is set in session
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'patient') {
    header("Location: login.php");
    exit();
}

// Ensure 'user_id' is available
$user_id = $_SESSION['user_id']; // This should be set during the login process

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "city_care_hospital";  // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute the query to get the full name
$sql = "SELECT first_name, last_name FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);  // Bind the user_id to the query
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['name'] = $row['first_name'] . ' ' . $row['last_name'];  // Store full name in session
} else {
    echo "No user found!";
}

$stmt->close();
$conn->close();

// Check if the user's name is set in the session
if (isset($_SESSION['name'])) {
    $name = $_SESSION['name'];
} else {
    $name = "User";  // Fallback name if not set
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Care Hospital - Patient Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>

<header>
    <div class="logo"><i class="fas fa-hospital"></i> City Care Hospital</div>
    <nav>
        <ul>
            <li><a href="../Patient/patient_dashboard.php">Dashboard</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="appointments.php">Appointments</a></li>
            <li><a href="visit_history.php">Visit History</a></li>
            <li><a href="./profile/profile.php">Profile</a></li>

        </ul>
    </nav>
    <div class="auth-links">
        <h1>PATIENT</h1>
    </div>
</header>

<section class="dashboard">
    <h2>Welcome, <?php echo $name; ?>!</h2>
    <div class="card-container">
        <div class="card">
            <i class="fas fa-calendar-check"></i>
            <h3>Book Appointment</h3>
            <a href="./appointments.php">Make Appointment</a>
        </div>
        <div class="card">
            <i class="fas fa-history"></i>
            <h3>Visit History</h3>
            <a href="visit_history.php">View History</a>
        </div>
        <div class="card">
            <i class="fas fa-user"></i>
            <h3>My Profile</h3>
            <a href="./profile/profile.php">View Profile</a>
        </div>
        <div class="card">
            <i class="fas fa-sign-out-alt"></i>
            <h3>Logout</h3>
            <a href="logout.php">Log Out</a>
        </div>
    </div>
</section>

<section id="contact" class="section">
    <h2>Contact Us</h2>
    <div class="contact-info">
        <p><i class="fas fa-envelope"></i> Email: contact@citycare.com</p>
        <p><i class="fas fa-phone"></i> Phone: +123 456 7890</p>
        <p><i class="fas fa-map-marker-alt"></i> Address: 123 Healthcare Street, Your City</p>
        <p><i class="fas fa-clock"></i> Open: 24/7 Emergency Services</p>
    </div>
    <div class="contact-form">
        <h3>Get in Touch</h3>
        <form>
            <input type="text" placeholder="Your Name" required>
            <input type="email" placeholder="Your Email" required>
            <textarea placeholder="Your Message" required></textarea>
            <button type="submit">Send Message</button>
        </form>
    </div>
</section>

<footer>
    <p>&copy; 2025 City Care Hospital. All Rights Reserved.</p>
</footer>

</body>
</html>

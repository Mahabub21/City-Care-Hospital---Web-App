<?php
session_start();

// Check if the user is logged in and has the doctor role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'doctor') {
    header("Location: login.php");
    exit();
}

// Database connection (replace with your own database details)
$servername = "localhost";
$username = "root";  // Your MySQL username
$password = "";  // Your MySQL password
$dbname = "city_care_hospital";  // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming the correct column name is `id`
$user_id = $_SESSION['user_id'];  // This is the session variable holding the user's ID
$sql = "SELECT first_name, last_name, phone_number, email FROM users WHERE id = '$user_id' AND role = 'doctor'";
$result = $conn->query($sql);

// Check if there's a result
if ($result->num_rows > 0) {
    // Fetch doctor details
    $doctor = $result->fetch_assoc();
    $_SESSION['first_name'] = $doctor['first_name'];
    $_SESSION['last_name'] = $doctor['last_name'];
    $_SESSION['phone_number'] = $doctor['phone_number'];
    $_SESSION['email'] = $doctor['email'];
} else {
    echo "No doctor details found.";
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Care Hospital - Doctor Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>

<header>
    <div class="logo"><i class="fas fa-hospital"></i> City Care Hospital</div>
    <nav>
        <ul>
            <li><a href="#appointments">Appointments</a></li>
            <li><a href="#patients">Patients</a></li>
            <li><a href="#reports">Reports</a></li>
        </ul>
    </nav>
    <div class="auth-links">
        <h1>DOCTOR</h1>
    </div>
</header>

<section class="dashboard">
    <h2>Welcome, Dr. <?php echo $_SESSION['first_name']; ?>!</h2> <!-- Display the doctor's first name -->
    <div class="card-container">
        <div class="card">
            <i class="fas fa-calendar-check"></i>
            <h3>Appointments</h3>
            <a href="appointments.php">View Appointments</a>
        </div>
        <div class="card">
            <i class="fas fa-user-injured"></i>
            <h3>Manage Patients</h3>
            <a href="patients.php">View Patients</a>
        </div>
        <div class="card">
            <i class="fas fa-chart-line"></i>
            <h3>Reports</h3>
            <a href="reports.php">View Reports</a>
        </div>
        <div class="card">
            <i class="fas fa-cogs"></i>
            <h3>Settings</h3>
            <a href="edit_doctor_info.php">Edit Doctor Info</a>
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

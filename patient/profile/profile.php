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

// Prepare and execute the query to get the patient information
$sql = "SELECT first_name, last_name, email, phone_number, address, birthday FROM users WHERE id = ? AND role = 'patient'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);  // Bind the user_id to the query
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $email = $row['email'];
    $phone = $row['phone_number'];  // Use phone_number instead of phone
    $address = $row['address'];
    $birthday = $row['birthday'];
} else {
    echo "No patient found!";
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Profile - City Care Hospital</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>

<header>
    <div class="logo"><i class="fas fa-hospital"></i> City Care Hospital</div>
    <nav>
        <ul>
            <li><a href="../patient_dashboard.php">Home</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="appointments.php">Appointments</a></li>
            <li><a href="visit_history.php">Visit History</a></li>
        </ul>
    </nav>
    <div class="auth-links">
        <h1>PATIENT</h1>
    </div>
</header>

<section class="profile">
    <h2>My Profile</h2>
    <div class="profile-card">
        <h3><?php echo $first_name . ' ' . $last_name; ?></h3>
        
        <table class="profile-table">
            <tr>
                <td><strong>Email:</strong></td>
                <td><?php echo $email; ?></td>
            </tr>
            <tr>
                <td><strong>Phone:</strong></td>
                <td><?php echo $phone; ?></td>
            </tr>
            <tr>
                <td><strong>Address:</strong></td>
                <td><?php echo $address; ?></td>
            </tr>
            <tr>
                <td><strong>Birthday:</strong></td>
                <td><?php echo date('F j, Y', strtotime($birthday)); ?></td>
            </tr>
        </table>
        
        <a href="edit_profile.php">Edit Profile</a>
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

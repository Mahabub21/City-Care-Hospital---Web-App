<?php
session_start();

// Check if the user is logged in and has the doctor role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'doctor') {
    header("Location: login.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "city_care_hospital";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch doctor reports
$doctor_id = $_SESSION['user_id'];
$sql = "SELECT reports.*, users.first_name AS patient_first_name, users.last_name AS patient_last_name
        FROM reports 
        JOIN users ON reports.patient_id = users.id 
        WHERE reports.doctor_id = '$doctor_id' 
        ORDER BY report_date DESC";
$reports_result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Reports - City Care Hospital</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 30px;
            justify-content: center;
        }
        .card {
            width: 300px;
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: relative;
        }
        .card i {
            font-size: 40px;
            color: #007bff;
            margin-bottom: 10px;
        }
        .card h3 {
            margin: 5px 0;
        }
        .card p {
            margin: 4px 0;
        }
        .btn {
            display: inline-block;
            margin-top: 10px;
            padding: 6px 12px;
            border: none;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            font-size: 14px;
        }
        .approve-btn { background-color: #28a745; }
        .view-btn { background-color: #007bff; }
        .delete-btn { background-color: #dc3545; }


        
    </style>
</head>

<body>

<header>
    <div class="logo"><i class="fas fa-hospital"></i> City Care Hospital</div>
    <nav>
        <ul>
            <li><a href="doctor_dashboard.php">Dashboard</a></li>
            <li><a href="appointments.php">Appointments</a></li>
            <li><a href="patients.php">Patients</a></li>
            <li><a href="reports.php">Reports</a></li>
        </ul>
    </nav>
    <div class="auth-links">
        <h1>DOCTOR</h1>
    </div>
</header>

<section class="dashboard">
    <h2>View Reports - Dr. <?php echo $_SESSION['first_name']; ?></h2>
    <div class="card-container">
        <?php if ($reports_result->num_rows > 0): ?>
            <?php while ($report = $reports_result->fetch_assoc()): ?>
                <div class="card">
                    <i class="fas fa-file-medical-alt"></i>
                    <h3><?php echo htmlspecialchars($report['report_title']); ?></h3>
                    <p><strong>Patient:</strong> <?php echo htmlspecialchars($report['patient_first_name'] . ' ' . $report['patient_last_name']); ?></p>
                    <p><strong>Date:</strong> <?php echo $report['report_date']; ?></p>
                    <p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($report['report_description'])); ?></p>
                    <!-- Optional buttons -->
                    <a href="view_report.php?id=<?php echo $report['id']; ?>" class="btn view-btn">View Full Report</a>
                    <a href="delete_report.php?id=<?php echo $report['id']; ?>" class="btn delete-btn">Delete Report</a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No reports found.</p>
        <?php endif; ?>
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

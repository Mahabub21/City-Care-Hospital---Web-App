<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Care Hospital</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

</head>
<body>

<body>
    <header>
        <div class="logo"><i class="fas fa-hospital"></i> City Care Hospital</div>
        <nav>
            <ul>
                <li><a href="../Admin/registration/signup.php">Registration</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="../Admin/manage_doctor/manage_doctors.php">Doctors</a></li>
                <li><a href="../Admin/Manage Patients/manage_patients.php">Patient</a></li>
            </ul>
        </nav>
        <div class="auth-links">
            <h1>ADMIN</h1>
        </div>
    </header>

    <section class="dashboard">
        <h2>Welcome, Admin!</h2>
        <div class="card-container">
            <div class="card">
                <i class="fas fa-user-md"></i>
                <h3>Manage Doctors</h3>
                <a href="../Admin/manage_doctor/manage_doctors.php">Go to Doctors</a>
            </div>
            <div class="card">
                <i class="fas fa-procedures"></i>
                <h3>Manage Patients</h3>
                <a href="../Admin/Manage Patients/manage_patients.php">Go to Patients</a>
            </div>
            <div class="card">
                <i class="fas fa-calendar-check"></i>
                <h3>Appointments</h3>
                <a href="./appointments/appointments.php">View Appointments</a>
            </div>
            <div class="card">
                <i class="fas fa-chart-line"></i>
                <h3>Reports</h3>
                <a href="reports.php">View Reports</a>
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
</body>
</html>

</body>
</html>


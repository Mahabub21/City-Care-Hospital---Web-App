<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}
include '../registration/config.php'; // Your DB config

// Handle approve
if (isset($_GET['approve'])) {
    $id = intval($_GET['approve']);
    $conn->query("UPDATE appointments SET status='Confirmed' WHERE id=$id");
    header("Location: appointments.php"); // refresh
    exit();
}

// Handle delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM appointments WHERE id=$id");
    header("Location: appointments.php"); // refresh
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Appointments - City Care Hospital</title>
    <link rel="stylesheet" href="../styles.css">
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
        .delete-btn { background-color: #dc3545; }
    </style>
</head>
<body>

<header>
    <div class="logo"><i class="fas fa-hospital"></i> City Care Hospital</div>
    <nav>
        <ul>
            <li><a href="../registration/signup.php">Registration</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="../manage_doctor/manage_doctors.php">Doctors</a></li>
            <li><a href="../Manage Patients/manage_patients.php">Patient</a></li>
            <li><a href="../admin_dashboard.php">Dashboard</a></li>
        </ul>
    </nav>
    <div class="auth-links"><h1>ADMIN</h1></div>
</header>

<section class="dashboard">
    <h2>Appointments</h2>
    <div class="card-container">
        <?php
        $sql = "SELECT a.*, 
                       u1.first_name AS patient_first, u1.last_name AS patient_last, 
                       u2.first_name AS doctor_first, u2.last_name AS doctor_last,
                       di.hospital, di.specialization
                FROM appointments a
                JOIN users u1 ON a.user_id = u1.id
                JOIN users u2 ON a.doctor_id = u2.id
                LEFT JOIN doctor_info di ON a.doctor_id = di.user_id
                ORDER BY a.appointment_date DESC";

        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0):
            while ($row = mysqli_fetch_assoc($result)):
        ?>
        <div class="card">
            <i class="fas fa-calendar-check"></i>
            <h3><?= htmlspecialchars($row['patient_first'] . ' ' . $row['patient_last']) ?></h3>
            <p><strong>Doctor:</strong> <?= htmlspecialchars($row['doctor_first'] . ' ' . $row['doctor_last']) ?></p>
            <p><strong>Hospital:</strong> <?= htmlspecialchars($row['hospital']) ?></p>
            <p><strong>Specialization:</strong> <?= htmlspecialchars($row['specialization']) ?></p>
            <p><strong>Date:</strong> <?= date('F j, Y, g:i A', strtotime($row['appointment_date'])) ?></p>
            <p><strong>Status:</strong> <?= htmlspecialchars($row['status']) ?></p>

            <?php if ($row['status'] == 'Pending'): ?>
                <a href="?approve=<?= $row['id'] ?>" class="btn approve-btn">Approve</a>
            <?php endif; ?>
            <a href="?delete=<?= $row['id'] ?>" class="btn delete-btn" onclick="return confirm('Delete this appointment?');">Delete</a>
        </div>
        <?php endwhile; else: ?>
        <p>No appointments found.</p>
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

<footer>
    <p>&copy; 2025 City Care Hospital. All Rights Reserved.</p>
</footer>
</body>
</html>

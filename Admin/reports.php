<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Include the database connection
include('./registration/config.php');

// Query to fetch reports with the doctor's and patient's names
$query = "SELECT reports.id, reports.report_title, reports.report_description, reports.report_date, 
                 patients.first_name AS patient_first_name, patients.last_name AS patient_last_name, 
                 doctors.first_name AS doctor_first_name, doctors.last_name AS doctor_last_name
          FROM reports
          JOIN users AS patients ON reports.patient_id = patients.id
          JOIN users AS doctors ON reports.doctor_id = doctors.id
          ORDER BY reports.report_date DESC";

// Execute the query
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Care Hospital - Reports</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .container {
            padding: 20px;
        }
    </style>
</head>
<body>

<header>
    <div class="logo"><i class="fas fa-hospital"></i> City Care Hospital</div>
    <nav>
        <ul>
            <li><a href="../Admin/registration/signup.php">Registration</a></li>
            <li><a href="./admin_dashboard.php">Home</a></li>
            <li><a href="../Admin/manage_doctor/manage_doctors.php">Doctors</a></li>
            <li><a href="../Admin/Manage Patients/manage_patients.php">Patients</a></li>
        </ul>
    </nav>
    <div class="auth-links">
        <h1>ADMIN</h1>
    </div>
</header>

<section class="dashboard">
    <h2>Reports</h2>
    <div class="container">
        <?php
        // Check if there are any reports
        if (mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<thead><tr><th>Report Title</th><th>Patient Name</th><th>Doctor Name</th><th>Date</th><th>Description</th></tr></thead>";
            echo "<tbody>";

            // Loop through each report and display it
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['report_title']) . "</td>";
                echo "<td>" . htmlspecialchars($row['patient_first_name']) . " " . htmlspecialchars($row['patient_last_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['doctor_first_name']) . " " . htmlspecialchars($row['doctor_last_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['report_date']) . "</td>";
                echo "<td>" . nl2br(htmlspecialchars($row['report_description'])) . "</td>";
                echo "</tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "<p>No reports found.</p>";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
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

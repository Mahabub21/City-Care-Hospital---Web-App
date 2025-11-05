<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'patient') {
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

// Fetch hospitals
$hospitals_result = $conn->query("SELECT DISTINCT hospital FROM doctor_info");

// Handle appointment booking
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['doctor_id'])) {
    $doctor_id = $_POST['doctor_id'];
    $appointment_date = $_POST['appointment_date'];

    $stmt = $conn->prepare("INSERT INTO appointments (user_id, doctor_id, appointment_date) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $_SESSION['user_id'], $doctor_id, $appointment_date);

    $message = $stmt->execute() ? "✅ Appointment booked successfully!" : "❌ Error: " . $stmt->error;
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Appointment</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

<header>
    <div class="logo"><i class="fas fa-hospital"></i> City Care Hospital</div>
    <nav>
        <ul>
            <li><a href="patient_dashboard.php">Dashboard</a></li>
            <li><a href="appointments.php">Appointments</a></li>
            <li><a href="visit_history.php">Visit History</a></li>
            <li><a href="./profile/profile.php">Profile</a></li>
        </ul>
    </nav>
    <div class="auth-links"><h1>PATIENT</h1></div>
</header>

<section class="dashboard">
    <h2><i class="fas fa-calendar-plus"></i> Book an Appointment</h2>

    <?php if (!empty($message)): ?>
        <p style="color: green; font-weight: bold;"><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="POST" action="" class="appointment-form">
        <label for="hospital">Select Hospital:</label>
        <select name="hospital" id="hospital" required>
            <option value="">--Select Hospital--</option>
            <?php while ($row = $hospitals_result->fetch_assoc()): ?>
                <option value="<?= $row['hospital']; ?>"><?= $row['hospital']; ?></option>
            <?php endwhile; ?>
        </select>

        <label for="specialization">Select Specialization:</label>
        <select name="specialization" id="specialization" required>
            <option value="">--Select Specialization--</option>
        </select>

        <label for="doctor_id">Select Doctor:</label>
        <select name="doctor_id" id="doctor_id" required>
            <option value="">--Select Doctor--</option>
        </select>

        <label for="appointment_date">Appointment Date & Time:</label>
        <input type="datetime-local" name="appointment_date" id="appointment_date" required>

        <button type="submit"><i class="fas fa-check-circle"></i> Book Appointment</button>
    </form>
</section>

<script>
$(document).ready(function() {
    $('#hospital').change(function() {
        const hospital = $(this).val();
        $.ajax({
            url: 'get_specializations.php',
            method: 'POST',
            data: { hospital },
            success: function(data) {
                $('#specialization').html(data);
                $('#doctor_id').html('<option value="">--Select Doctor--</option>');
            }
        });
    });

    $('#specialization').change(function() {
        const hospital = $('#hospital').val();
        const specialization = $(this).val();
        $.ajax({
            url: 'dr.php',
            method: 'POST',
            data: { hospital, specialization },
            success: function(data) {
                $('#doctor_id').html(data);
            }
        });
    });
});
</script>

</body>
</html>

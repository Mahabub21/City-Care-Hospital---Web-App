<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Database
$host = '127.0.0.1';
$db = 'city_care_hospital';
$user = 'root';
$pass = '';
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit();
}

// Fetch patients
$sql = "SELECT * FROM users WHERE role = 'patient'";
$stmt = $pdo->query($sql);
$patients = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Patients - City Care Hospital</title>
    <link rel="stylesheet" href="../styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .card-container { display: flex; flex-wrap: wrap; gap: 20px; padding: 20px; }
        .card {
            background: #f9f9f9; padding: 20px; border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1); width: 300px;
        }
        .card i { font-size: 36px; color: #007bff; margin-bottom: 10px; }
        .card h3, p { margin: 5px 0; }
        .card a {
            background: #dc3545; color: white; padding: 8px 12px;
            text-decoration: none; border-radius: 6px; display: inline-block;
        }
        .card a:hover { background: #bd2130; }
    </style>
</head>
<body>

<header>
    <div class="logo"><i class="fas fa-hospital"></i> City Care Hospital</div>
    <nav>
        <ul>
            <li><a href="../admin_dashboard.php">Dashboard</a></li>
            <li><a href="../registration/signup.php">Registration</a></li>
            <li><a href="../manage_doctor/manage_doctors.php">Doctors</a></li>
        </ul>
    </nav>
    <div class="auth-links"><h1>ADMIN</h1></div>
</header>

<section class="dashboard">
    <h2>Manage Patients</h2>
    <div class="card-container">
        <?php foreach ($patients as $patient): ?>
        <div class="card">
            <i class="fas fa-user"></i>
            <h3><?= htmlspecialchars($patient['first_name'] . ' ' . $patient['last_name']) ?></h3>
            <p><strong>Email:</strong> <?= htmlspecialchars($patient['email']) ?></p>
            <p><strong>Phone:</strong> <?= htmlspecialchars($patient['phone_number']) ?></p>
            <p><strong>Address:</strong> <?= htmlspecialchars($patient['address']) ?></p>
            <a href="patient_delete.php?id=<?= $patient['id'] ?>" onclick="return confirm('Are you sure you want to delete this patient?')">Delete</a>
        </div>
        <?php endforeach; ?>
    </div>
</section>

</body>
</html>

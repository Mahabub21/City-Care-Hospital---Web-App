<?php
session_start();

// Only admins allowed
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Database connection
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

// Check if patient ID is provided
if (isset($_GET['id'])) {
    $patient_id = intval($_GET['id']);

    try {
        // Begin transaction
        $pdo->beginTransaction();

        // Step 1: Delete appointments related to this patient
        $stmt1 = $pdo->prepare("DELETE FROM appointments WHERE user_id = :id");
        $stmt1->bindParam(':id', $patient_id, PDO::PARAM_INT);
        $stmt1->execute();

        // Step 2: Delete patient
        $stmt2 = $pdo->prepare("DELETE FROM users WHERE id = :id AND role = 'patient'");
        $stmt2->bindParam(':id', $patient_id, PDO::PARAM_INT);
        $stmt2->execute();

        // Commit both
        $pdo->commit();

        // Redirect
        header("Location: manage_patients.php");
        exit();
    } catch (PDOException $e) {
        $pdo->rollBack();
        echo "Error deleting patient: " . $e->getMessage();
    }
} else {
    echo "Error: No patient ID provided.";
}
?>

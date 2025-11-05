<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

require_once './config.php';

$message = "";
$success = false;

if (!empty($_GET['id'])) {
    $doctorId = intval($_GET['id']);

    // Check if doctor exists
    $checkSql = "SELECT * FROM users WHERE id = $doctorId AND role = 'doctor'";
    $checkResult = mysqli_query($conn, $checkSql);

    if (mysqli_num_rows($checkResult) > 0) {
        // Delete the doctor
        $deleteSql = "DELETE FROM users WHERE id = $doctorId";
        if (mysqli_query($conn, $deleteSql)) {
            $message = "✅ Doctor has been successfully deleted.";
            $success = true;
        } else {
            $message = "❌ Error deleting doctor: " . mysqli_error($conn);
        }
    } else {
        $message = "❌ Doctor not found.";
    }
} else {
    $message = "❌ Invalid request. Doctor ID not found.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Doctor</title>
    <style>
        body {
            background-color: #f4f7f6;
            font-family: Arial, sans-serif;
            padding: 50px;
            text-align: center;
        }
        .container {
            background: white;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            max-width: 500px;
            margin: 0 auto;
        }
        .message {
            font-size: 18px;
            color: <?php echo $success ? '#2e7d32' : '#c62828'; ?>;
            margin-bottom: 30px;
        }
        a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #003366;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
            background-color: #00509e;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="message"><?php echo $message; ?></div>
        <a href="doctor_list.php">Back to Doctor List</a>
    </div>
</body>
</html>

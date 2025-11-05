<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

require_once '../manage_doctor/config.php'; // Update path as needed

// Fetch all doctors
$sql = "SELECT u.id, u.first_name, u.last_name, u.phone_number, u.email, u.gender, u.birthday, di.hospital, di.specialization 
        FROM users u 
        LEFT JOIN doctor_info di ON u.id = di.user_id 
        WHERE u.role = 'doctor'";

$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctor List - City Care Hospital</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7f6;
            font-family: Arial, sans-serif;
            color: #333;
        }

        header {
            background-color: #003366;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }

        .container {
            padding: 40px 20px;
        }

        h2 {
            text-align: center;
            color: #003366;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #003366;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .back-btn {
            margin-top: 30px;
            text-align: center;
        }

        .back-btn a {
            background-color: #ff9900;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 6px;
        }

        .back-btn a:hover {
            background-color: #e68a00;
        }

        .delete-btn {
            color: red;
            text-decoration: none;
            font-weight: bold;
        }

        .delete-btn:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <i class="fas fa-user-md"></i> Doctor List
    </header>

    <div class="container">
        <h2>All Registered Doctors</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Birthday</th>
                    <th>Hospital</th>
                    <th>Specialization</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['first_name'] . ' ' . $row['last_name'] ?></td>
                            <td><?= $row['phone_number'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['gender'] ?></td>
                            <td><?= $row['birthday'] ?></td>
                            <td><?= $row['hospital'] ?></td>
                            <td><?= $row['specialization'] ?></td>
                            <td>
                                <a href="delete_doctor.php?id=<?= $row['id'] ?>" class="delete-btn">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="9">No doctors found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="back-btn">
            <a href="manage_doctors.php"><i class="fas fa-arrow-left"></i> Back to Manage</a>
        </div>
    </div>
</body>
</html>

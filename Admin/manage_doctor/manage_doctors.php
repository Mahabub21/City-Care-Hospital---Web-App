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
    <title>Manage Doctors - City Care Hospital</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f7f6;
            color: #333;
        }

        header {
            background-color: #003366;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header .logo {
            font-size: 24px;
            font-weight: bold;
            display: flex;
            align-items: center;
        }

        header .logo i {
            margin-right: 10px;
        }

        nav ul {
            list-style: none;
            display: flex;
        }

        nav ul li {
            margin-left: 20px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        nav ul li a:hover {
            color: #ff9900;
        }

        .auth-links h1 {
            margin: 0;
            font-size: 18px;
        }

        .dashboard {
            padding: 40px 20px;
        }

        .dashboard h2 {
            font-size: 32px;
            margin-bottom: 30px;
            text-align: center;
            color: #003366;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
        }

        .card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 250px;
            padding: 25px 20px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        }

        .card i {
            font-size: 40px;
            color: #003366;
            margin-bottom: 15px;
        }

        .card h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .card a {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 15px;
            background-color: #ff9900;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }

        .card a:hover {
            background-color: #e68a00;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #003366;
            color: white;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo"><i class="fas fa-hospital"></i> City Care Hospital</div>
        <nav>
            <ul>
                <li><a href="../admin_dashboard.php">Home</a></li>
                <li><a href="../registration/signup.php">Registration</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#patient">Patient</a></li>
            </ul>
        </nav>
        <div class="auth-links">
            <h1>ADMIN</h1>
        </div>
    </header>

    <section class="dashboard">
        <h2>Manage Doctors</h2>
        <div class="card-container">
            <div class="card">
                <i class="fas fa-plus-circle"></i>
                <h3>Add Doctor</h3>
                <a href="./signup.php">Add New</a>
            </div>
            <div class="card">
                <i class="fas fa-users"></i>
                <h3>View All Doctors</h3>
                <a href="doctor_list.php">View List</a>
            </div>

            <div class="card">
                <i class="fas fa-trash-alt"></i>
                <h3>Delete Doctor</h3>
                <a href="delete_doctor.php">Delete</a>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 City Care Hospital. All Rights Reserved.</p>
    </footer>
</body>
</html>

<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logged Out</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: #333;
        }
        .logout-box {
            text-align: center;
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .logout-box h2 {
            margin-bottom: 20px;
            color: #003366;
        }
        .logout-box a {
            display: inline-block;
            margin: 10px;
            text-decoration: none;
            background-color: #ff9900;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
        }
        .logout-box a:hover {
            background-color: #e68a00;
        }
    </style>
</head>
<body>
    <div class="logout-box">
        <h2>You have been logged out successfully!</h2>
        <a href="../loging/login.php">Login Again</a>
        <a href="../index.html">Go to Home Page</a>
    </div>
</body>
</html>

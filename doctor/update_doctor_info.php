<?php
session_start();

// Ensure the user is logged in and is a doctor
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'doctor') {
    header("Location: login.php");
    exit();
}

include("./config.php");  // Assuming you have a database connection file

// Fetch the current password from the database (for validation)
$user_id = $_SESSION['user_id'];  // This assumes the session stores the logged-in user's ID
$sql = "SELECT password FROM users WHERE id = '$user_id' AND role = 'doctor'";  // Use 'id' instead of 'user_id'
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$current_password = $row['password'];  // Existing password from the DB

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle the update of doctor information
    if (isset($_POST['edit_option']) && $_POST['edit_option'] == 'info') {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone_number = $_POST['phone_number'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $profile_picture = $_FILES['profile_picture'];

        // Handle file upload
        if ($profile_picture['name']) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($profile_picture["name"]);
            move_uploaded_file($profile_picture["tmp_name"], $target_file);
        }

        // Update the doctor's personal and professional info
        $update_sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', phone_number='$phone_number', birthday='$dob', gender='$gender', address='$target_file' WHERE id='$user_id' AND role='doctor'";

        if (mysqli_query($conn, $update_sql)) {
            echo "Information updated successfully!";
        } else {
            echo "Error updating information.";
        }
    }

    // Handle password update
    if (isset($_POST['edit_option']) && $_POST['edit_option'] == 'password') {
        $current_password_input = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Validate password fields
        if (strlen($new_password) < 6) {
            echo "Password must be at least 6 characters long.";
        } elseif ($new_password !== $confirm_password) {
            echo "New password and confirm password do not match.";
        } elseif (!password_verify($current_password_input, $current_password)) {
            echo "Current password is incorrect.";
        } else {
            // Hash the new password
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

            // Update the password in the database
            $update_sql = "UPDATE users SET password='$hashed_password' WHERE id='$user_id' AND role='doctor'";

            if (mysqli_query($conn, $update_sql)) {
                // Password updated successfully, redirect to homepage
                    echo "<script>alert('Password updated successfully!'); window.location='./doctor_dashboard.php';</script>";
                } else {
                    echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
                } // Ensure no further code is executed
            
            
        }
    }
}
?>

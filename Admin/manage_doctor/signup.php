<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $hospital = mysqli_real_escape_string($conn, $_POST['hospital']);
    $specialization = mysqli_real_escape_string($conn, $_POST['specialization']);

    // Check if email already exists
    $check_email = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $check_email);
    
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Email already exists! Please use a different email.'); window.location='signup.php';</script>";
        exit();
    }

    // Insert new user
    $sql = "INSERT INTO users (first_name, last_name, phone_number, email, password, birthday, address, gender, role, specialization) 
            VALUES ('$first_name', '$last_name', '$phone_number', '$email', '$password', '$birthday', '$address', '$gender', '$role', '$specialization')";

    if (mysqli_query($conn, $sql)) {
        $user_id = mysqli_insert_id($conn);

        // Insert into doctor_info if role is doctor
        if ($role === 'doctor') {
            $insertDoctorInfo = "INSERT INTO doctor_info (user_id, hospital, specialization)
                                 VALUES ('$user_id', '$hospital', '$specialization')";
            mysqli_query($conn, $insertDoctorInfo);
        }

        echo "<script>alert('Account created successfully!'); window.location='./manage_doctors.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup - City Care Hospital</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <a href="./manage_doctors.php" class="home-btn">🏠 Home</a>
    <h2>Sign Up</h2>
    <form method="post" action="">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required>

        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="birthday">Birthday:</label>
        <input type="date" id="birthday" name="birthday" required>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>

        <label for="role">Role:</label>
        <select id="role" name="role" required onchange="toggleDoctorFields(this.value)">
            <option value="doctor">Doctor</option>  
        </select>

        <div id="doctorFields">
            <label for="hospital">Hospital:</label>
            <input type="text" id="hospital" name="hospital" required>

            <label for="specialization">Specialization:</label>
            <input type="text" id="specialization" name="specialization" required>
        </div>

        <button type="submit">Create Account</button>
    </form>
</div>

<script>
    function toggleDoctorFields(role) {
        const doctorFields = document.getElementById('doctorFields');
        doctorFields.style.display = (role === 'doctor') ? 'block' : 'none';
    }
</script>
</body>
</html>

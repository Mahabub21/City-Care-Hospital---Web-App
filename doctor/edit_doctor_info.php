<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Doctor Info</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            background: #f0f8ff;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 900px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            margin-bottom: 20px;
            color: #003366;
        }
        label {
            font-weight: bold;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            margin-bottom: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        textarea {
            resize: vertical;
        }
        .form-section {
            margin-bottom: 30px;
        }
        .button-group {
            display: flex;
            gap: 20px;
            justify-content: center;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }
        .save-btn {
            background-color: #28a745;
            color: white;
        }
        .cancel-btn {
            background-color: #dc3545;
            color: white;
        }
        .reset-btn {
            background-color: #ffc107;
            color: white;
        }
        input:hover, select:hover, textarea:hover {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0,123,255,0.2);
        }
        .btn:hover {
            opacity: 0.9;
            transform: scale(1.03);
            transition: 0.2s ease;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Doctor Info</h2>
    <form action="update_doctor_info.php" method="POST" enctype="multipart/form-data">

        <!-- Choose Edit Option -->
        <div class="form-section">
            <h3>Choose an Option</h3>
            <label for="edit_option">Select Action</label>
            <select name="edit_option" id="edit_option" required onchange="toggleEditForm()">
                <option value="">--Select--</option>
                <option value="info">Edit Information</option>
                <option value="password">Edit Password</option>
            </select>
        </div>

        <!-- Edit Information Form (Initially Hidden) -->
        <div id="infoForm" class="form-section" style="display:none;">
            <h3>Personal Info</h3>
            <label for="first_name">First Name</label>
            <input type="text" name="first_name">

            <label for="last_name">Last Name</label>
            <input type="text" name="last_name">

            <label for="phone_number">Phone Number</label>
            <input type="text" name="phone_number">

            <label for="dob">Date of Birth</label>
            <input type="date" name="dob">

            <label for="gender">Gender</label>
            <select name="gender">
                <option value="">--Select--</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>

            <label for="profile_picture">Profile Picture Upload</label>
            <input type="file" name="profile_picture" accept="image/*">

            <!-- Professional Info -->
            <h3>Professional Info</h3>
            <label for="school">School</label>
            <input type="text" name="school">

            <label for="college">College</label>
            <input type="text" name="college">

            <label for="medical_college">Medical College</label>
            <input type="text" name="medical_college">

            <label for="other_degrees">Other Degrees</label>
            <input type="text" name="other_degrees">

            <label for="experience">Years of Experience</label>
            <input type="number" name="experience" min="0">
        </div>

        <!-- Edit Password Form (Initially Hidden) -->
        <div id="passwordForm" class="form-section" style="display:none;">
            <h3>Edit Password</h3>
            <label for="current_password">Current Password</label>
            <input type="password" name="current_password" required>

            <label for="new_password">New Password (Min. 6 characters)</label>
            <input type="password" name="new_password" required minlength="6">

            <label for="confirm_password">Confirm New Password</label>
            <input type="password" name="confirm_password" required minlength="6">
        </div>

        <!-- Buttons -->
        <div class="button-group">
            <button type="submit" class="btn save-btn">✅ Save Changes</button>
            <a href="./doctor_dashboard.php" class="btn cancel-btn">❌ Cancel</a>
            <button type="reset" class="btn reset-btn">🔄 Reset to Default</button>
        </div>
    </form>
</div>

<script>
    function toggleEditForm() {
        const option = document.getElementById("edit_option").value;
        const infoForm = document.getElementById("infoForm");
        const passwordForm = document.getElementById("passwordForm");

        if (option === "info") {
            infoForm.style.display = "block";
            passwordForm.style.display = "none";
        } else if (option === "password") {
            passwordForm.style.display = "block";
            infoForm.style.display = "none";
        } else {
            infoForm.style.display = "none";
            passwordForm.style.display = "none";
        }
    }
</script>

</body>
</html>

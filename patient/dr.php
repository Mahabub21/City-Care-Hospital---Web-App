<?php
$conn = new mysqli("localhost", "root", "", "city_care_hospital");

$hospital = $_POST['hospital'];
$specialization = $_POST['specialization'];

$sql = "
    SELECT users.id, users.first_name, users.last_name
    FROM users
    INNER JOIN doctor_info ON users.id = doctor_info.user_id
    WHERE doctor_info.hospital = ? AND doctor_info.specialization = ? AND users.role = 'doctor'
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $hospital, $specialization);
$stmt->execute();
$result = $stmt->get_result();

echo '<option value="">--Select Doctor--</option>';
while ($row = $result->fetch_assoc()) {
    echo '<option value="' . $row['id'] . '">' . $row['first_name'] . ' ' . $row['last_name'] . '</option>';
}
?>

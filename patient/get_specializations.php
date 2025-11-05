<?php
$conn = new mysqli("localhost", "root", "", "city_care_hospital");

$hospital = $_POST['hospital'];
$sql = "SELECT DISTINCT specialization FROM doctor_info WHERE hospital = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $hospital);
$stmt->execute();
$result = $stmt->get_result();

echo '<option value="">--Select Specialization--</option>';
while ($row = $result->fetch_assoc()) {
    echo '<option value="' . $row['specialization'] . '">' . $row['specialization'] . '</option>';
}
?>

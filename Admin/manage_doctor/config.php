<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "city_care_hospital";

$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>

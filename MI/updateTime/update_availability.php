<?php
$mysqli = new mysqli("localhost", "root", "", "user");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$availability_time = $_POST['availability_time'];

$sql = "INSERT INTO DoctorTime (name, availability_time) VALUES ('Dr. Name', '$availability_time')";

if ($mysqli->query($sql) === TRUE) {
    echo "Availability updated successfully.";
} else {
    echo "Error updating availability: " . $mysqli->error;
}

$mysqli->close();
?>

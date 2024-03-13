<?php
$mysqli = new mysqli("localhost", "root", "", "user");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$sql = "SELECT MAX(availability_time) AS max_time FROM Doctortime";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $max_time = strtotime($row['max_time']);
    $formatted_time = date("F j, Y, g:i a", $max_time);
    echo $formatted_time;
} else {
    echo "No availability information available.";
}

$mysqli->close();
?>

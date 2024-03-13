<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$dbname = 'userdb';

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$username = $_POST['username'];
$password = $_POST['password'];
$user_type = $_POST['user_type'];

// Insert data into the database
$sql = "INSERT INTO users (username, password, user_type) VALUES ('$username', '$password', '$user_type')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

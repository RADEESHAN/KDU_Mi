<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("location: login.php");
}

// Replace these database connection details with your own
$host = "localhost";
$user = "root";
$password = "";
$database = "user";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_SESSION["username"];

// Fetch medical history data for the logged-in user
$sql = "SELECT medicalapply.firstname, medicalapply.subdate, medicalapply.ufile, medicalapply.DocStatus, medicalapply.ARstatus, medicalapply.Final_Stats, medicalapply.missLecDays
        FROM medicalapply
        INNER JOIN login ON medicalapply.regno = login.regno
        WHERE login.username = '$username'";

$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        a {
            text-decoration: none;
            color: #007BFF;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
    <title>Your Page Title</title>
</head>
<body>

<?php include("navbar.html") ?>
<?php
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>First Name</th><th>Submission Date</th><th>Uploaded File</th><th>DocStatus</th><th>ARStatus</th><th>Final Status</th><th>Missed Lecture Days</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["firstname"] . "</td>";
        echo "<td>" . $row["subdate"] . "</td>";
        echo "<td><a href='../mediForm/" . $row["ufile"] . "' download>" . $row["ufile"] . "</a></td>"; 
        
    
        // Replace 'file_directory' with your file directory path
        echo "<td>" . $row["DocStatus"] . "</td>";
        echo "<td>" . $row["ARstatus"] . "</td>";
        echo "<td>" . $row["Final_Stats"] . "</td>";
        echo "<td>" . $row["missLecDays"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No data found for the logged-in user.";
}

$conn->close();
?>
</body>
</html>

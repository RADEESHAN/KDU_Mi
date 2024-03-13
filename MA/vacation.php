<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vacation_date = $_POST["vacation_date"];

    // SQL query to insert the new "vacation_date" into the "vacationskdu" table
    $insert_sql = "INSERT INTO vacationskdu (vacation_date) VALUES ('$vacation_date')";

    if ($conn->query($insert_sql) === TRUE) {
        echo "Date inserted successfully.";
    } else {
        die("Error inserting date: " . $conn->error);
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Vacation Date</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            background-color: #fff;
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px #888;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <h1>Update Vacation Date</h1>
    <form method="post">
        <label for="vacation_date">New Vacation Date:</label>
        <input type="date" id="vacation_date" name="vacation_date" required>
        <br>
        <input type="submit" value="Update Date for All Rows">
    </form>
</body>
</html>

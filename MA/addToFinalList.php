<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the JSON data
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    if ($data) {
        // Database connection settings
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "user";

        // Create a connection to the database
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $firstname = $data->firstname;

        // Insert data into the "finalATD" table
        $insertQuery = "INSERT INTO finalatd (firstname, missLecDays) VALUES (?, ?)";
        $stmtInsert = $conn->prepare($insertQuery);
        $stmtInsert->bind_param('si', $firstname, $data->missLecDays);

        if ($stmtInsert->execute()) {
            // Update the "medicalapply" table
            $updateSql = "UPDATE medicalapply SET Final_Stats = 'done' WHERE firstname = ?";
            $stmtUpdate = $conn->prepare($updateSql);
            $stmtUpdate->bind_param('s', $firstname);

            if ($stmtUpdate->execute()) {
                // Both actions were successful
                $response = ["success" => true];
            } else {
                // Failed to update "medicalapply"
                $response = ["success" => false];
            }
            $stmtUpdate->close();
        } else {
            // Failed to insert into "finalATD"
            $response = ["success" => false];
        }

        $stmtInsert->close();
        $conn->close();
    } else {
        $response = ["success" => false];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Handle non-POST requests
    header("HTTP/1.0 405 Method Not Allowed");
}
?>

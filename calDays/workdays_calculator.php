<?php

function getWorkdays($date1, $date2, $workSat = FALSE, $patron = NULL) {
    // Your existing getWorkdays function code here...
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $startDate = $_POST["startDate"];
    $endDate = $_POST["endDate"];
    $workSat = isset($_POST["workSat"]) ? ($_POST["workSat"] === "true") : false;
    $patronDate = $_POST["patronDate"];

    // Call the getWorkdays function with the form data
    $result = getWorkdays($startDate, $endDate, $workSat, $patronDate);
    
    // Return the result as a JSON response
    echo json_encode(["workdays" => $result]);
    exit;
}
?>
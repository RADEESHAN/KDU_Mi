<?php

/**
 * Count the number of working days between two dates.
 *
 * This function calculate the number of working days between two given dates,
 * taking account of the Public festivities, Easter and Easter Morning days,
 * the day of the Patron Saint (if any) and the working Saturday.
 *
 * @param   string  $date1    Start date ('YYYY-MM-DD' format)
 * @param   string  $date2    Ending date ('YYYY-MM-DD' format)
 * @param   boolean $workSat  TRUE if Saturday is a working day
 * @param   string  $patron   Day of the Patron Saint ('MM-DD' format)
 * @return  integer           Number of working days ('zero' on error)
 *
 * @author Massimo Simonini <massiws@gmail.com>
 */
function getWorkdays($date1, $date2, $workSat = FALSE, $patron = NULL) {
    if (!defined('SATURDAY')) define('SATURDAY', 6);
    if (!defined('SUNDAY')) define('SUNDAY', 0);

    // Array of all public festivities
    $publicHolidays = array('01-01', '01-06', '04-25', '05-01', '06-02', '08-15', '11-01', '12-08', '12-25', '12-26');
    // The Patron day (if any) is added to public festivities
    if ($patron) {
        $publicHolidays[] = $patron;
    }

    /*
     * Array of all Easter Mondays in the given interval
     */
    $yearStart = date('Y', strtotime($date1));
    $yearEnd   = date('Y', strtotime($date2));

    for ($i = $yearStart; $i <= $yearEnd; $i++) {
        $easter = date('Y-m-d', easter_date($i));
        list($y, $m, $g) = explode("-", $easter);
        $monday = mktime(0,0,0, date($m), date($g)+1, date($y));
        $easterMondays[] = $monday;
    }

    $start = strtotime($date1);
    $end   = strtotime($date2);
    $workdays = 0;
    for ($i = $start; $i <= $end; $i = strtotime("+1 day", $i)) {
        $day = date("w", $i);  // 0=sun, 1=mon, ..., 6=sat
        $mmgg = date('m-d', $i);
        if ($day != SUNDAY &&
            !in_array($mmgg, $publicHolidays) &&
            !in_array($i, $easterMondays) &&
            !($day == SATURDAY && $workSat == FALSE)) {
                $workdays++;
        }
    }

    return intval($workdays);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Handle the form submission here
    $inputData = json_decode(file_get_contents("php://input"), true);

    if ($inputData) {
        $startDate = $inputData["startDate"];
        $endDate = $inputData["endDate"];
        $workSat = isset($inputData["workSat"]) ? (bool)$inputData["workSat"] : false;
        $patronDay = $inputData["patronDay"];

        // Calculate workdays
        $workdays = getWorkdays($startDate, $endDate, $workSat, $patronDay);

        // Return the result as JSON
        header("Content-Type: application/json");
        echo json_encode(["workdays" => $workdays]);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workdays Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="checkbox"] {
            margin-right: 5px;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        #result {
            margin-top: 20px;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Workdays Calculator</h1>
        <form id="workday-form">
            <label for="start-date">Start Date (YYYY-MM-DD):</label>
            <input type="text" id="start-date" name="start-date" required>

            <label for="end-date">End Date (YYYY-MM-DD):</label>
            <input type="text" id="end-date" name="end-date" required>

            <label for="work-sat">Include Saturdays:</label>
            <input type="checkbox" id="work-sat" name="work-sat" value="1">

            <label for="patron-day">Patron Saint Day (MM-DD):</label>
            <input type="text" id="patron-day" name="patron-day">

            <button type="button" id="calculate-button">Calculate</button>
        </form>

        <div id="result"></div>
    </div>

    <script>
        document.getElementById("calculate-button").addEventListener("click", function () {
            // Get user inputs
            const startDate = document.getElementById("start-date").value;
            const endDate = document.getElementById("end-date").value;
            const workSat = document.getElementById("work-sat").checked ? 1 : 0;
            const patronDay = document.getElementById("patron-day").value;

            // Send the data to the server for calculation (you can use AJAX for this)
            // Replace 'your_php_script.php' with the actual URL of this file
            fetch(window.location.href, {
                method: 'POST',
                body: JSON.stringify({ startDate, endDate

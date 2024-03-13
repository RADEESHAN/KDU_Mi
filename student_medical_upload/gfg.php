<?php


// Database connection (replace with your database credentials)
$con = mysqli_connect("localhost", "root", "", "user");
// Get the email from the request
$email = $_GET['email'];

if ($email !== "") {
    // Prepare and execute the SQL query to fetch data based on the email
    $query = mysqli_prepare($con, "SELECT regno, firstname, phonenumber FROM login WHERE email = ?");
    mysqli_stmt_bind_param($query, "s", $email);
    mysqli_stmt_execute($query);
    mysqli_stmt_bind_result($query, $regno, $firstname,$phonenumber);

    if (mysqli_stmt_fetch($query)) {
        // Data found, store it in an associative array
        $user_data = [
            "regno" => $regno,
            "firstname" => $firstname,
            "phonenumber"=> $phonenumber
        ];

        // Send the response as JSON
        header("Content-Type: application/json");
        echo json_encode($user_data);
    } else {
        // No data found for the given email
      //  echo json_encode(["error" => "User not found"]);
    }

    mysqli_stmt_close($query);
} else {
    // Invalid input
   // echo json_encode(["error" => "Invalid email"]);
}
?>

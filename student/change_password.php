<?php
session_start();

if (isset($_SESSION["username"])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $oldPassword = $_POST["old_password"];
        $newPassword = $_POST["new_password"];
        $confirmPassword = $_POST["confirm_password"];

        // Database connection setup
        $host = "localhost"; // Update with your database host
        $user = "root"; // Update with your database user
        $password = ""; // Update with your database password
        $database = "user"; // Update with your database name

        $conn = new mysqli($host, $user, $password, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Ensure the new password and confirmation match
        if ($newPassword !== $confirmPassword) {
            echo "New password and confirmation do not match.";
        } else {
            // You should replace "users" with your actual table name, and "password" with the actual column name in your database
            $username = $_SESSION["username"];
            $sql = "UPDATE login SET password = '$newPassword' WHERE username = '$username'";

            if ($conn->query($sql) === TRUE) {
                echo "Password changed successfully!";
            } else {
                echo "Error updating password: " . $conn->error;
            }
        }

        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="your-styles.css">
    <style>
        body {
            padding-top: 56px; /* Adjust the top padding to match the height of your navbar */
        }
    </style>
    <title>Change Password</title>


<style>
    body {
            background-color: #f8f9fa;
            padding-top: 70px; /* Adjust based on your navigation bar height */
        }

        .navbar {
            background-color: #333;
        }

        .navbar a {
            color: #fff;
            margin-right: 15px;
        }

        .navbar-brand img {
            height: 50px; /* Adjust the height as needed */
            width: auto; /* To maintain aspect ratio */
        }
        </style>
</head>
<body>
   <!-- Navigation Bar -->
   <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <a class="navbar-brand" href="#"><img src="kdu-logo2.png" alt="KDULogo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a> <!-- Update with your logout page -->
                </li>
            </ul>
        </div>
    </nav>

    <!-- Content -->
    <div class="container mt-5">
        <h1>Change Password</h1>
        <form method="post">
            <input type="password" name="old_password" placeholder="Old Password" required><br>
            <input type="password" name="new_password" placeholder="New Password" required><br>
            <input type="password" name="confirm_password" placeholder="Confirm New Password" required><br>
            <button type="submit" class="btn btn-primary change-password-button">Change Password</button>
        </form>
    </div>

    <!-- Bootstrap JS and jQuery (required for the navbar toggle) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>

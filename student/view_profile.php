<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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

        .profile-container {
            background-color: #ffffff;
            width: 80%;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 36px;
            font-weight: bold;
            text-align: center;
            color: #007bff;
        }

        p {
            font-size: 18px;
            text-align: center;
            margin: 10px 0;
            color: #555;
        }

        .btn.change-password-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            color: #ffffff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn.change-password-button:hover {
            background-color: #0056b3;
        }

        .not-logged-in-message {
            text-align: center;
            color: #dc3545;
            font-size: 18px;
            margin-top: 50px;
        }

        .password-change-instructions {
            text-align: center;
            margin-top: 20px;
            color: #555;
        }
    </style>
    <title>User Profile</title>
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

    <?php
    session_start();

    if (isset($_SESSION["username"])) {
        $username = $_SESSION["username"];
        $host = "localhost"; // Update with your database host
        $user = "root"; // Update with your database user
        $password = ""; // Update with your database password
        $database = "user"; // Update with your database name

        $conn = new mysqli($host, $user, $password, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM login WHERE username = '$username'";
        $result = $conn->query($sql);

        if (!$result) {
            die("Query failed: " . $conn->error);
        }

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $firstname = $row["firstname"];
                $email = $row["email"];

                echo "<div class='profile-container'>";
                echo "<h1>User Profile</h1>";
                echo "<p>Username: $username</p>";
                echo "<p>Name: $firstname</p>";
                echo "<p>Email: $email</p>";
                echo "<a href='change_password.php' class='btn change-password-button'>Change Password</a>";
                
                echo "</div>";
            }
        } else {
            echo "<p class='not-logged-in-message'>Profile not found.</p>";
        }

        $conn->close();
    } else {
        echo "<p class='not-logged-in-message'>You are not logged in. Please log in to view your profile.</p>";
    }
    ?>

<p class='password-change-instructions'>To change your password, follow these simple steps. First, 
    log in to your account using your current username and password. 
    Once logged in, navigate to your account settings—typically found under 
    options like 'Account,' 'Profile,' or your username at the top of the page. 
    Look for the 'Change Password' option within your account settings, often located 
    under a security or password tab. To ensure security, you'll be prompted to enter your current password.
     Next, create a strong and unique new password, incorporating a mix of uppercase and lowercase letters,
      numbers, and symbols. Confirm your new password by entering it again. Finally, locate the 
      'Save Changes' or 'Update Password' button and click it to apply the new password. For added security,
       log out of your account and log back in using the new password to ensure it works correctly.
     Remember to keep your password confidential and consider updating it regularly for enhanced security.</p>";

    <!-- Bootstrap JS and jQuery (if not already included in your project) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "user";

session_start();

$data = mysqli_connect($host, $user, $password, $db);

if ($data === false) {
    die("Connection error");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM login WHERE username='" . $username . "' AND password='" . $password . "' ";
    $result = mysqli_query($data, $sql);
    $row = mysqli_fetch_array($result);

    if ($row["usertype"] == "student") {
        $_SESSION["username"] = $username;
        header("location:student.php");
    } elseif ($row["usertype"] == "admin") {
        $_SESSION["username"] = $username;
        header("location:adminhome.php");
    } elseif ($row["usertype"] == "hod") {
        $_SESSION["username"] = $username;
        header("location:hod.php");
    } else {
        $login_error = "Username or password incorrect";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Background image */
        body {
            background-image: url('kdunew.jpg'); /* Path to your background image */
            background-size: cover; /* Adjusts the image to cover the entire viewport */
            background-repeat: no-repeat; /* Prevents image repetition */
            font-family: Arial, sans-serif;
            margin: 0; /* Remove default body margin */
            padding: 0; /* Remove default body padding */
        }

        .login-box {
            background-color: rgba(255, 255, 255, 0.8); /* Transparent white background */
            padding: 20px;
            width: 300px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            margin: 100px auto; /* Center the login box */
        }

        .login-box form {
            text-align: center;
        }

        .login-box .textbox {
            margin-bottom: 10px;
        }

        .login-box label {
            font-weight: bold;
        }

        .login-box input[type="text"],
        .login-box input[type="password"] {
            width: 90%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .login-box input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login-box input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: #ff0000;
            margin-top: 10px;
        }
    </style>
</head>

<body>
	
    <div class="login-box">
        <form action="#" method="POST">
            <div class="textbox">
                <label for="username">Username</label>
                <input type="text" name="username" required>
            </div>
            <div class="textbox">
                <label for="password">Password</label>
                <input type="password" name="password" required>
            </div>
            <div>
                <input type="submit" value="Login">
            </div>
        </form>
        <?php if (isset($login_error)) { ?>
            <div class="error-message"><?php echo $login_error; ?></div>
        <?php } ?>
    </div>
</body>
</html>

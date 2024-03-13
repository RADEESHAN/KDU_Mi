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

    // Check the "login" table
    $sql_login = "SELECT * FROM login WHERE username='" . $username . "' AND password='" . $password . "'";
    $result_login = mysqli_query($data, $sql_login);
    $row_login = mysqli_fetch_array($result_login);

    // Check the "admLogin" table if not found in "login" table
    if (!$row_login) {
        $sql_admLogin = "SELECT * FROM admLogin WHERE username='" . $username . "' AND password='" . $password . "'";
        $result_admLogin = mysqli_query($data, $sql_admLogin);
        $row_admLogin = mysqli_fetch_array($result_admLogin);

        if ($row_admLogin) {
            $_SESSION["username"] = $username;
            $usertype = $row_admLogin["usertype"];
        }
    } else {
        $_SESSION["username"] = $username;
        $usertype = $row_login["usertype"];
    }

    if (isset($usertype)) {
        // Determine the user's usertype and redirect accordingly
        switch ($usertype) {
            case "student":
                header("location:../home/student/student3.php");
                break;
            case "doctor":
                header("location:../home/Doctor/doctor.php");
                break;
            case "hod":
                header("location:../home/hod/hod.php");
                break;
            case "ma":
                header("location:../home/MA/ma.php");
                break;
            case "mi":
                header("location:../home/MI/mi.php");
                break;
            case "arOfficer":
                header("location:../home/AR/ar.php");
                break;
            default:
                $login_error = "Invalid user type";
                break;
        }
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

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        /* Background image */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: url('Untitled-1.png'); /* Path to your background image */
            background-size: cover; /* Adjusts the image to cover the entire viewport */
            background-repeat: no-repeat; /* Prevents image repetition */
            background-position:center;
            background-attachment:fixed;
            font-family: Arial, sans-serif;
            margin: 0; /* Remove default body margin */
            padding: 0; /* Remove default body padding */
        }

        .wrapper {
            background: rgba(175, 169, 169, 0.326); /* Transparent white background */
            padding: 30px 40px;
            width: 350px;
            border-radius: 20px;
            box-shadow: 0px 0px 100px rgb(0, 0, 0);
            min-height: 50vh;
            margin: 100px auto; /* Center the login box */
        }

        .wrapper h1{
            font-size: 30px;
            text-align: center;
            color: #000000;
            
        }

        .wrapper .input-box{
            width: 100%;
            height: 50px;
            margin: 30px 0;
            background: transparent;
        }

        .input-box input{
            width: 800px;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            border: 2px solid rgba(255, 255, 255, 2);
            border-radius: 40px;
         }
 
        .input-box input::placeholder{
            color: #ffffff82;
        }

        .wrapper  .remember-forgot{
            display: flex;
            justify-content:center;
            font-size: 14px;
            margin: -15px 0 15px;
            color: #ffffff;
            font-weight: bold;
        
            
        }

        .wrapper.btn{
            width: 100% ;
            height: 45px;
            border: none;
            border-radius: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 1);
        }
         
        .wrapper form {
            text-align: center;
        }

        .wrapper.input-box {
            margin-bottom: 30px;
        }

        

        .wrapper input[type="text"],
        .wrapper input[type="password"] {
            background: transparent;
            width: 225px;
            padding: 12px;
            border: 1.5px solid #ffffff;
            border-radius: 50px;
            font-weight: bold;

}


.wrapper h1 {
            font-size: 30px;
            text-align: center;
            color: white; /* Change the color to dark orange */
        }

/*login button*/
        .wrapper button[type="submit"] {
            background-color: #000000;
            font-weight: bold;
            color: #ffffff;
            padding: 10px 105 px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            width: 224px;
            height: 35px;
            transition: background-color 0.3s;
        }

        

        .wrapper button[type="submit"]:hover {
            background-color: #fffdfd;
            color: #000000;
            font-weight: bold;
        }

        .error-message {
            color: #ff0000;
            margin-top: 10px;
        }
    </style>
</head>

<body>
	
    <div class="wrapper">
        <form action="#" method="POST">
            <h1>Login</h1>
            <div class="input-box">
               <input type="text" name= "username" placeholder="username" required>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="password" required>
            </div>

            <div class="remember-forgot">
                <label><input type="checkbox">Remember me</label>
            </div>
            <div>
                <button type="submit" class="btn">Login</button>
            </div>
        </form>
        <?php if (isset($login_error)) { ?>
            <div class="error-message"><?php echo $login_error; ?></div>
        <?php } ?>
      
    </div> 
</body>
</html>
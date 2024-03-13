<!DOCTYPE html>
<html>
<head>
    <title>Doctor Availability Update</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            background-color: #007bff;
            color: white;
            padding: 20px;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            font-weight: bold;
        }
        input[type="datetime-local"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div>
<?php include("navbar.html"); ?>
    </div>
   
    <h1>Update Your Availability</h1>
    <form action="update_availability.php" method="post">
        <label for="availability_time">Availability Time:</label>
        <input type="datetime-local" id="availability_time" name="availability_time" required>
        <br><br>
        <input type="submit" value="Update Availability">
    </form>
</body>
</html>

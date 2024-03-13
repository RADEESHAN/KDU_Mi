<!DOCTYPE html>
<html lang="en">

<head>
    <title>Update Vacation Date</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
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
    <div class="container">
        <h1 class="mt-4">Update Vacation Date</h1>
        <form method="post">
            <div class="form-group">
                <label for="vacation_date">New Vacation Date:</label>
                <input type="date" id="vacation_date" name="vacation_date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Date for All Rows</button>
        </form>

        <h1 class="mt-4 text-center text-white bg-success">Vacations</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">DATES</th>
                </tr>
            </thead>

            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "user";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $vacation_date = $_POST["vacation_date"];

                $insert_sql = "INSERT INTO vacationskdu (vacation_date) VALUES ('$vacation_date')";

                if ($conn->query($insert_sql) === TRUE) {
                    echo '<div class="alert alert-success" role="alert">Date inserted successfully.</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">Error inserting date: ' . $conn->error . '</div>';
                }
            }

            $query = "SELECT * FROM vacationskdu";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <tbody>
                    <tr>
                        <td><?php echo $row['no']; ?></td>
                        <td><?php echo $row['vacation_date']; ?></td>
                    </tr>
                </tbody>
            <?php } ?>
        </table>

        <?php
        $conn->close();
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UoQ8L3iB1CqHqdS9Z2uAaPtwfKf56EopT2VjE+KqjD94uswz1z9j8iCgMz9LMEBB" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjcvHfAV9RSsqg10V2FnpvI6L4N2a8k" crossorigin="anonymous"></script>
</body>

</html>

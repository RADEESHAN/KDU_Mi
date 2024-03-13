<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approved Medical Applications</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <section>
    <?php include("./navbar.php") ?>
    </section>

    <div class="container mt-5">
        <h1><center>Approved Medical Applications</center></h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                <th>Medical Number</th>
                    <th>First Name</th>
                    <th>Registration Number</th>
                    <th>Department</th>
                    <th>Medical Letter</th>
                    <th>Missed Lecture Days</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
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

                // SQL query to retrieve data
                $sql = "SELECT id, firstname, regno, dept, misslec , missLecDays FROM medicalapply WHERE DocStatus = 'Approved' AND HODstatus = 'Approved' AND ARstatus = 'Approved'  ";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['firstname'] . "</td>";
                        echo "<td>" . $row['regno'] . "</td>";
                        echo "<td>" . $row['dept'] . "</td>";
                        echo "<td>" . $row['misslec'] . "</td>";
                        echo "<td>" . $row['missLecDays'] . "</td>";
                        echo '<td><button class="btn btn-primary add-to-list" data-firstname="' . $row['firstname'] . '" data-misslecdays="' . $row['missLecDays'] . '">Add to List</button></td>';
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No approved applications found.</td></tr>";
                }

                // Close the database connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>






    

    <!-- Include Bootstrap JS (optional) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Include jQuery (required for the following script) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        // Function to send data to addToFinalList.php
        function addToFinalList(firstname, missLecDays) {
            $.ajax({
                url: 'addToFinalList.php',
                type: 'POST',
                data: JSON.stringify({ firstname: firstname, missLecDays: missLecDays }),
                contentType: 'application/json',
                success: function(response) {
                    if (response.success) {
                        alert('Added to the final list successfully.');
                        $('.add-to-list[data-firstname="' + firstname + '"]').removeClass('btn-primary').addClass('btn-success');
                        
                        // Add the following code to make the update request
                        $.ajax({
                            url: 'updateFinalStatus.php',
                            type: 'POST',
                            data: { firstname: firstname },
                            success: function(response) {
                                if (response.success) {
                                    console.log('Final_Stats updated to "done"');
                                } else {
                                    console.log('Failed to update Final_Stats');
                                }
                            },
                            dataType: 'json'
                        });
                    } else {
                        alert('Failed to add to the final list.');
                    }
                }
            });
        }

        // Add event listener to "Add to List" buttons
        $(document).ready(function() {
            $('.add-to-list').click(function() {
                var firstname = $(this).data('firstname');
                var missLecDays = $(this).data('misslecdays');
                addToFinalList(firstname, missLecDays);
            });
        });
    </script>
</body>
</html>

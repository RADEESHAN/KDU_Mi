<?php
// Define the getWorkdays function
function getWorkdays($date1, $date2, $workSat = FALSE, $publicHolidays) {
    if (!defined('SATURDAY')) define('SATURDAY', 6);
    if (!defined('SUNDAY')) define('SUNDAY', 0);

    // Array of all Easter Mondays in the given interval
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

$response = isset($_GET["response"]) ? $_GET["response"] : ""; // add user eke response eka link krnwa
$status = isset($_GET["res_status"]) ? $_GET["res_status"] : "";

// Database credentials
$host = 'localhost'; // Replace with your database host name or IP address
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password
$database = 'user'; // Replace with your database name

// Create a database connection
$db = new mysqli($host, $username, $password, $database);

// Check the connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $email = $_POST['email'];
    $regno = $_POST['regno'];
    $firstname = $_POST['firstname'];
    $intake = $_POST['intake'];
    $phonenumber = $_POST['phonenumber'];
    $dept = $_POST['dept'];
    $sdate = $_POST['sdate'];
    $edate = $_POST['edate'];
    $subdate = $_POST['subdate'];
    $missLec = $_POST['missLec'];

    $uploadDirectory = 'imges/'; // Directory to store uploaded files
    $uploadedFile = $uploadDirectory . basename($_FILES['uimg']['name']);

    if (move_uploaded_file($_FILES['uimg']['tmp_name'], $uploadedFile)) {
        // File was successfully uploaded
        // Store the file path in the database
        $ufilePath = $uploadedFile; // Update this path to the actual path

        // Retrieve public holidays from the "vacations" table
        $publicHolidays = array();
        $publicHolidaysQuery = "SELECT vacation_date FROM vacationskdu";
        $publicHolidaysResult = $db->query($publicHolidaysQuery);
        while ($row = $publicHolidaysResult->fetch_assoc()) {
            $publicHolidays[] = date("m-d", strtotime($row['vacation_date']));
        }

        // Calculate the number of working days between sdate and edate
        $missLecDays = getWorkdays($sdate, $edate, false, $publicHolidays);

        // Insert data into the 'medicalapply' table with the file path
        $medicalInsertQuery = "INSERT INTO medicalapply (email, regno, firstname, intake, phonenumber, dept, sdate, edate, subdate, misslec, ufile, DocStatus, HODstatus, ARstatus, Final_Stats ,missLecDays) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending', 'pending', 'pending','pending' , ?)";
        $medicalInsertStmt = $db->prepare($medicalInsertQuery);
        $medicalInsertStmt->bind_param('ssssssssssss', $email, $regno, $firstname, $intake, $phonenumber, $dept, $sdate, $edate, $subdate, $missLec, $ufilePath, $missLecDays);
        $medicalInsertStmt->execute();
        $medicalInsertStmt->close();

        // Success message or redirection to another page
        echo "Data has been successfully submitted. Missed Lecture Days: $missLecDays";
    } else {
        echo "File upload failed.";
    }
}

// Remember to close the database connection when you're done (usually at the end of your PHP script)
$db->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data enetr</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../assests/fontawesome/fontawesome-free-5.15.3-web/css/all.css">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<?php include("navbar.html") ?>
    <!-- //////////////// Response Alert //////////////////// -->
    <div class="row mt-3">
        <div class="col-sm-8 mx-auto text-center">
            <?php if ($status == "1") { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 style="color: green;"><?php echo $response; ?></h3>
                </div>
            <?php } else if ($status == "0") { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 style="color: red;"><?php echo $response; ?></h3>
                </div>
            <?php } ?>
        </div>
    </div>
    <!-- //////////////// Response Alert End //////////////////// -->

 
  <div class="card-header">
   <h1 class="text-center">Enter your details for Apply Medical.</h1>
  </div>
  <div class="card-body">
    <!--h2 class"text-center"--><!--?php echo $response; ?></h2-->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <p class="text-danger">* required fields </p>
                    </div>
                    <form id="medi_upload_form" enctype="multipart/form-data" method="POST" ><!--user controller wala case eke thiyen type eka-->
                    <!--farmer email and farmer id-->
                        <div class="row mt-3">
                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label">Email <i class="text-danger">*</i></label>
                                <span id="emailError" class="text-danger"></span> <!-- Error message container -->
                            </div>
                            <div class="col-sm-4 text-muted">
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label"> Register Number <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <input type="text" name="regno" id="regno" class="form-control" required onblur="getUserData()">
                            </div>
                        
                        </div>




                        <!--fname and lname-->
                        <div class="row mt-3">
                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label">Full Name <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <input type="text" name="firstname" id="firstname" class="form-control" required>
                            </div>
                            <div class="col-sm-2 text-muted">
                            <label for="intakeSelect" class="control-label">Intake <i class="text-danger">*</i></label>
                        </div>
                        <div class="col-sm-4 text-muted">
                            <select name="intake" id="intakeSelect" class="form-control" required>
                                <option value="intake39">Intake 39</option>
                                <option value="intake38">Intake 38</option>
                                <option value="intake37">Intake 37</option>
                                <option value="intake40">Intake 40</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                        </div>



                        <!--contact number-->


                        <div class="row mt-3">
                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label">Contact Number <i class="text-danger">*</i></label>
                                
                            </div>
                            <div class="col-sm-4 text-muted">
                                <input type="number" name="phonenumber" id="phonenumber" class="form-control" required>
                            </div>

                      
                            </div-->

                            <div class="col-sm-2 text-muted">
                            <label for="deptSelect" class="control-label">Department <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-4 text-muted">
                            <select name="dept" id="deptSelect" class="form-control" required>
                            <option value="IT">IT</option>
                            <option value="department2">QS</option>
                            <option value="servay">servay</option>
                            <option value="Archi">Archi</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                        </div>


                        <h5 >Absent Time period</h5>
                            <div class="row">
                            <div class="col">
                            <label for="">Start date</label>
                                <input id= "sdate" name="sdate" type="date" class="form-control" required>
                            </div>
                            <div class="col">
                            <label for="">End date</label>
                                <input name="edate" id= "edate" type="date" class="form-control" required>
                            </div>
                            </div>


                            <div class="row mt-3">
                            <div class="col-sm-6 text-muted">
                                <label for="">Submit date</label>
                                <input name="subdate" id="subdate" type="date" class="form-control" required>
                                </div>
                            <div class="col-sm-6 text-muted">
                                <label for="" class="control-label">Miss Lectures <i class="text-danger">*</i></label>
                                <div class="col">
                                 <textarea class="form-control" name="missLec" id="missLec" rows="2" required></textarea>
                                </div>
                             </div>

                        
                             </div>



                        <div class="row mt-3">
                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label">Medical File</label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <input type="file" name="uimg" id="uimg" class="form-control-file" onchange="readURL(this);">
                                <!-- Image Preview -->
                                <div>
                                    <img id="prev_img" alt="">
                                </div>
                                <!-- Preview End -->
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-sm-4 text-muted">
                            <button id="submit" type="submit" class="btn btn-block button text-white text-uppercase" style="background-color: green; color: white;">Submit</button>
<i class="fa fa-save"></i>&nbsp; &nbsp; Upload</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
    // Function to validate email format
    function validateEmail() {
        const emailInput = document.getElementById('email');
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

        if (!emailPattern.test(emailInput.value)) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid email structure',
                text: 'Please enter a valid email address.',
            });
            emailInput.classList.add('is-invalid');
            return false;
        } else {
            emailInput.classList.remove('is-invalid');
            return true;
        }
    }

    // Add an event listener to the form to validate the email on submit
    document.getElementById('medi_upload_form').addEventListener('submit', function (e) {
        if (!validateEmail()) {
            e.preventDefault(); // Prevent form submission if email is invalid
        }
    });


// Function to validate regno format
function validateRegno() {
    const regnoInput = document.getElementById('regno');
    const regnoPattern = /^(D|M|C)\/(BIS|BIT|BQS|ARC|ICT)\/(19|20|21|22|23|24)\/\d{4}$/;

    if (!regnoPattern.test(regnoInput.value)) {
        Swal.fire({
            icon: 'error',
            title: 'Invalid registration number',
            text: 'Please enter a valid registration number in the format "D/BIS/22/0009".',
        });
        regnoInput.classList.add('is-invalid');
        return false;
    } else {
        regnoInput.classList.remove('is-invalid');
        return true;
    }
}

// Add an event listener to the form to validate the "regno" on submit
document.getElementById('medi_upload_form').addEventListener('submit', function (e) {
    if (!validateRegno()) {
        e.preventDefault(); // Prevent form submission if "regno" is invalid
    }
});


// Function to validate the "sdate" (start date)
function validateStartDate() {
    const sdateInput = document.getElementById('sdate');
    const currentDate = new Date(); // Get the current date

    if (new Date(sdateInput.value) >= currentDate) {
        Swal.fire({
            icon: 'error',
            title: 'Invalid start date',
            text: 'Please select a start date before today.',
        });
        sdateInput.classList.add('is-invalid');
        return false;
    } else {
        sdateInput.classList.remove('is-invalid');
        return true;
    }
}

// Add an event listener to the form to validate the "sdate" on submit
document.getElementById('medi_upload_form').addEventListener('submit', function (e) {
    if (!validateStartDate()) {
        e.preventDefault(); // Prevent form submission if "sdate" is invalid
    }
});


// Function to validate the "edate" (end date)
function validateEndDate() {
    const sdateInput = document.getElementById('sdate');
    const edateInput = document.getElementById('edate');

    const startDate = new Date(sdateInput.value);
    const endDate = new Date(edateInput.value);

    if (endDate <= startDate) {
        Swal.fire({
            icon: 'error',
            title: 'Invalid end date',
            text: 'End date must be after the start date (sdate).',
        });
        edateInput.classList.add('is-invalid');
        return false;
    } else {
        edateInput.classList.remove('is-invalid');
        return true;
    }
}

// Add an event listener to the form to validate the "edate" on submit
document.getElementById('medi_upload_form').addEventListener('submit', function (e) {
    if (!validateEndDate()) {
        e.preventDefault(); // Prevent form submission if "edate" is invalid
    }
});



// Function to validate the "subdate" (submission date)
function validateSubmissionDate() {
    const subdateInput = document.getElementById('subdate');
    const currentDate = new Date(); // Get the current date

    const selectedDate = new Date(subdateInput.value);

    if (!isSameDate(currentDate, selectedDate)) {
        Swal.fire({
            icon: 'error',
            title: 'Invalid submission date',
            text: 'Submission date must be today\'s date.',
        });
        subdateInput.classList.add('is-invalid');
        return false;
    } else {
        subdateInput.classList.remove('is-invalid');
        return true;
    }
}

// Helper function to compare if two dates are the same
function isSameDate(date1, date2) {
    return (
        date1.getFullYear() === date2.getFullYear() &&
        date1.getMonth() === date2.getMonth() &&
        date1.getDate() === date2.getDate()
    );
}

// Add an event listener to the form to validate the "subdate" on submit
document.getElementById('medi_upload_form').addEventListener('submit', function (e) {
    if (!validateSubmissionDate()) {
        e.preventDefault(); // Prevent form submission if "subdate" is invalid
    }
});




function getUserData() {
    var email = document.getElementById("email").value;

    if (email !== "") {
        // Create a new XMLHttpRequest object
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                // Parse the JSON response
                var userData = JSON.parse(this.responseText);

                // Fill the form fields with the retrieved data
                document.getElementById("regno").value = userData.regno;
                document.getElementById("firstname").value = userData.firstname;
                document.getElementById("phonenumber").value = userData.phonenumber;
                // ... Populate other fields similarly ...
            }
        };

        // Send a GET request to the PHP script with the email as a parameter
        xmlhttp.open("GET", "gfg.php?email=" + email, true);
        xmlhttp.send();
    }
}
</script>
    
    </body>
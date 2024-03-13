
<?php
include("conn.php");

// Include PHPMailer and other necessary settings here
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Function to send an email using PHPMailer
function sendEmail($to, $subject, $message) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'pramuditharadeeshan@gmail.com'; // Your Gmail email address
        $mail->Password = 'hciocxtwhcbniwke'; // Your Gmail password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Recipients
        $mail->setFrom('pramuditharadeeshan@gmail.com', 'Your Name');
        $mail->addAddress($to);
        $mail->isHTML(true);

        // Email content
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if (isset($_POST['approve'])) {
    $id = $_POST['id'];
    
    // Retrieve the student's email address from the database
    $query = "SELECT email FROM medicalapply WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $studentEmail = $row['email'];

    // Send an email to the student
    $subject = "Medical Approval";
    $message = "Your medical request has been approved."; // msg eka
    sendEmail($studentEmail, $subject, $message);

    // Update the ARstatus to 'Approved' in the database
    $select = "UPDATE medicalapply SET DocStatus = 'Approved' WHERE id = '$id' ";
    $result = mysqli_query($conn, $select);
    header("location:approved.php");
}

if (isset($_POST['reject'])) {
    $id = $_POST['id'];

    // Retrieve the student's email address from the database
    $query = "SELECT email FROM medicalapply WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $studentEmail = $row['email'];

    // Send an email to the student
    $subject = "Medical Rejection";
    $message = "Your medical request has been rejected.";
    sendEmail($studentEmail, $subject, $message);

    // Update the ARstatus to 'Reject' in the database
    $select = "UPDATE medicalapply SET DocStatus = 'Reject' WHERE id = '$id' ";
    $result = mysqli_query($conn, $select);
    header("location:approved.php");
}
?>








<!DOCTYPE html>
<html>
<head>
	<title></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<style>
   

    /* Custom style for the green "Approve" button */
    .btn-success {
        background-color: #28a745; /* Green color */
        color: white;
    }

     /* Custom style for the red "Reject" button */
     .btn-danger {
        background-color: #dc3545; /* Red color */
        color: white;
    }
</style>

</head>
<body>
 
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="http://www.kdu.ac.lk" target="_blank">
            <img src="kdu-logo2.png" alt="KDU Logo" width="180" height="40" class="d-inline-block align-top">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <!-- Replace the href with the appropriate URLs for your pages -->
                <!-- Moved Home button to the right side -->
            </ul>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li><a class="nav-link" href="../Doctor/doctor.php">Home</a></li>
            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
    </div>
</nav>


<h1 class="text-center  text-white bg-dark col-md-12">PENDING LIST</h1>

<table class="table table-bordered col-md-12">
  <thead>
    <tr>
   <th scope="col">Medical No</th>
	 <th scope="col">Name</th>
	 <th scope="col">DATE</th>
	 <th scope="col">MEDICAL FILE</th>
	 <th scope="col">ACTION</th>
    </tr>
  </thead>

<?php 

$query = "SELECT * FROM  medicalapply WHERE DocStatus = 'pending' AND HODstatus = 'approved'  AND ARstatus= 'approved' "; //ORDER BY id ASC... mekata add wenna one hod approve ekai ar approve ekai
$result = mysqli_query($conn,$query);
while($row = mysqli_fetch_array($result))  { ?>


  <tbody>   <!--table headers-->
    <tr>
      <th scope="row"><?php echo $row['id']; ?></th>   
      <td><?php echo $row['firstname']; ?></td>
      <td><?php echo $row['sdate']; ?></td>

      <td><a href="../mediForm/<?php echo $row['ufile']; ?>" download><?php echo $row['ufile']; ?></a></td> <!--pdf view-->
      </td>
      


      <td>
    <form action="approved.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
        <input type="submit" name="approve" value="Approve" class="btn btn-success"> &nbsp &nbsp <br>
        <input type="submit" name="reject" value="Reject" class="btn btn-danger"> 
    </form>
</td>
    </tr>
   
  </tbody>
  <?php } ?>
</table>


<?php 
if(isset($_POST['approve'])){ // when pressing approve to table update status as pending to approve 

	$id = $_POST['id'];
	$select = "UPDATE medicalapply SET DocStatus = 'Approved' WHERE id = '$id' ";
	$resut = mysqli_query($conn,$select);
	//header("location:approved.php");
}


if(isset($_POST['reject'])){// when pressing reject

	$id = $_POST['id'];
	$select = "UPDATE medicalapply SET DocStatus = 'Reject' WHERE id = '$id' ";
	$resut = mysqli_query($conn,$select);
	header("location:approved.php");
}

 ?>






<!-- ==================Approved list table================================================ -->



 
&nbsp &nbsp   &nbsp &nbsp   &nbsp &nbsp   &nbsp &nbsp   &nbsp &nbsp   &nbsp &nbsp  &nbsp 


 <h1 class="text-center  text-white bg-success col-md-12
">APPROVED LIST </h1>

<table class="table table-bordered col-md-12">
  <thead>
    <tr>
      <th scope="col">ID</th>
	 <th scope="col">SUBJECT</th>
	 <th scope="col">CONTACT</th>
   <th scope="col">MEDICAL</th>
	 
   <th scope="col">EDIT</th>
    </tr>
  </thead>

<?php 
$query = "SELECT * FROM  medicalapply WHERE DocStatus = 'Approved' ";
$result = mysqli_query($conn,$query);
while($row = mysqli_fetch_array($result)) { ?>


  <tbody>
    <tr>
      <th scope="row"><?php echo $row['id']; ?></th>
      <td><?php echo $row['firstname']; ?></td>
      <td><?php echo $row['phonenumber']; ?></td>
      <td><a href="../mediForm/<?php echo $row['ufile']; ?>" download><?php echo $row['ufile']; ?></a></td>
      

      <td>
		<form action="approved.php" method="POST">
		<input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
		 &nbsp &nbsp 
		 <input type="submit" name="reject" value="reject" class="btn btn-danger" > 

		</form>
   </td>


    </tr>
  </tbody>

  <?php } ?>

</table>

<!--Rejected list-->


&nbsp &nbsp   &nbsp &nbsp   &nbsp &nbsp   &nbsp &nbsp   &nbsp &nbsp   &nbsp &nbsp  &nbsp 


 <h1 class="text-center  text-white bg-danger col-md-12
">REJCTED LIST </h1>

<table class="table table-bordered col-md-12">
  <thead>
    <tr>
      <th scope="col">ID</th>
	 <th scope="col">SUBJECT</th>
	 <th scope="col">CONTACT</th>
   <th scope="col">MEDICAL FILE</th>
	 
   <th scope="col">EDIT</th>
    </tr>
  </thead>

<?php 
$query = "SELECT * FROM  medicalapply WHERE DocStatus = 'reject' ";
$result = mysqli_query($conn,$query);
while($row = mysqli_fetch_array($result)) { ?>


  <tbody>
    <tr>
      <th scope="row"><?php echo $row['id']; ?></th>
      <td><?php echo $row['firstname']; ?></td>
      <td><?php echo $row['phonenumber']; ?></td>
      <td><a href="../mediForm/<?php echo $row['ufile']; ?>" download><?php echo $row['ufile']; ?></a></td>
      

      <td>
		<form action="approved.php" method="POST">
		<input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
		<input type="submit" name="approve" value="approve" class="btn btn-success"> &nbsp &nbsp 
		

		</form>
   </td>


    </tr>
  </tbody>

  <?php } ?>

</table>
<br>

</body>

</html>
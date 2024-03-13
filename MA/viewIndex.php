<?php 

include("conn.php"); 


if (isset($_POST['approve'])) {
  $id = $_POST['id'];

  // Select the data from the medicalapply table based on the ID
  $selectQuery = "SELECT  firstname,dept, missLecDays, regno, misslec FROM medicalapply WHERE id = $id";
  $selectResult = mysqli_query($conn, $selectQuery);

  if ($selectResult) {
      $row = mysqli_fetch_array($selectResult);

      // Insert the data into the finalatd table
      $insertQuery = "INSERT INTO finalatd ( firstname,dept, missLecDays, regno, misslec) VALUES (?, ?, ?, ?, ?)";
      $stmt = mysqli_prepare($conn, $insertQuery);
      mysqli_stmt_bind_param($stmt, "ssiss", $row['firstname'],  $row['dept'], $row['missLecDays'], $row['regno'], $row['misslec']);

      if (mysqli_stmt_execute($stmt)) {
          // Data successfully copied to finalatd table
          // You can add a success message or redirect the user to another page if needed
      } else {
          // Handle the error if the insertion fails
          echo "Error: " . mysqli_error($conn);
      }

      mysqli_stmt_close($stmt);
  }
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
    /* ... your existing styles ... */

    /* Custom style for the green "Approve" button */
    .btn-approve {
        background-color: #28a745; /* Green color */
        color: white;
    }
</style>
</head>
<body>
<div>
	<!--?php include("hodnavbar.html") ?-->
  </div>
  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="http://www.kdu.ac.lk" target="_blank">
            <img src="kdu-logo2.png" alt="KDU Logo" width="180" height="35" class="d-inline-block align-top">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <!-- Your other navigation items here -->
            </ul>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <!-- Move Home to the right side -->
            <li class="nav-item"><a class="nav-link" href="../MA/ma.php">Home</a></li>
            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
    </div>
</nav>



	

<h1 class="text-center  text-white bg-dark col-md-12">LIST OF DOCTOR APPROVE MEDICAL</h1>

<table class="table table-bordered col-md-12">
  <thead>
    <tr>
    <th>Medical Number</th>
                    <th>First Name</th>
                    <th>Registration Number</th>
                    <th>Department</th>
                    <th>Lecture Missed</th>
                    <th>Absent Days</th>
                    <th>Action</th>
    </tr>
  </thead>

<?php 

$query = "SELECT * FROM  medicalapply WHERE DocStatus = 'Approved' AND 	Final_Stats= 'pending'  "; //ORDER BY id ASC
$result = mysqli_query($conn,$query);
while($row = mysqli_fetch_array($result))  { ?>


  <tbody>   <!--table headers-->
    <tr>
      <th scope="row"><?php echo $row['id']; ?></th>   
      <td><?php echo $row['firstname']; ?></td>
      <td><?php echo $row['regno']; ?></td>
      <td><?php echo $row['dept']; ?></td>
      <td><?php echo $row['misslec']; ?></td>

      <td><?php echo $row['missLecDays']; ?></td>
      


      <td>
    <form action="viewIndex.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
        <input type="submit" name="approve" value="Approve" class="btn btn-approve"> &nbsp &nbsp <br>
    </form>
</td>
    </tr>
   
  </tbody>
  <?php } ?>
</table>


<?php 
if(isset($_POST['approve'])){ // when pressing approve to table update status as pending to approve 

	$id = $_POST['id'];
	$select = "UPDATE medicalapply SET 	Final_Stats = 'Medical Approve' WHERE id = '$id' ";
	$resut = mysqli_query($conn,$select);

}



 ?>






<!-- ==================Approved list table================================================ -->



 
&nbsp &nbsp   &nbsp &nbsp   &nbsp &nbsp   &nbsp &nbsp   &nbsp &nbsp   &nbsp &nbsp  &nbsp 


 <h1 class="text-center  text-white bg-success col-md-12
">APPROVED LIST FINALIST AND FINISH </h1>
<div class="col-md-12 head">
  <div class="float-right">
    <a href="export.php" class="btn btn-success"><i class="dwn"></i>Export
  </a>    
</div>
<hr>
</div>
<!--?php include 'data.php'; ?-->
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<table class="table table-bordered col-md-12">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Department</th>
                <th>Missed Lecture Days</th>
                <th>Registration Number</th>
                <th>Missed Lectures</th>
                <th>Action</th> <!-- Add this column for Remove button -->
            </tr>
        </thead>

        <tbody>
            <?php 
            $query = "SELECT * FROM finalatd";
            $result = mysqli_query($conn, $query);

            while($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['firstname']; ?></td>
                    <td><?php echo $row['dept']; ?></td>
                    <td><?php echo $row['missLecDays']; ?></td>
                    <td><?php echo $row['regno']; ?></td>
                    <td><?php echo $row['misslec']; ?></td>
                    <td>
                        <form action="viewIndex.php" method="POST">
                            <input type="hidden" name="remove_id" value="<?php echo $row['id']; ?>"/>
                            <input type="submit" name="remove" value="Remove" class="btn btn-danger"> <!-- Use the red "Remove" button -->
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <?php 
    if(isset($_POST['remove'])){ // when pressing remove, delete the selected record

        $remove_id = $_POST['remove_id'];
        $deleteQuery = "DELETE FROM finalatd WHERE id = '$remove_id'";
        $deleteResult = mysqli_query($conn, $deleteQuery);

        if($deleteResult) {
            // Record successfully deleted
        } else {
            // Handle the error if deletion fails
            echo "Error: " . mysqli_error($conn);
        }
    }
    ?>








</body>
</html>
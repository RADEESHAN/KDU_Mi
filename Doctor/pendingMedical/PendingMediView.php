<?php
require_once('config/db.php');

// Remove this line, as it reassigns the $result variable
// $result = dispaly_data();

$query = "SELECT * FROM medicalapply";
$result = mysqli_query($con, $query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <style>
    .table-container {
      width: 100%;
      height: 100%; /* Adjust the maximum height as needed */
      overflow: auto;
    }
  </style>
  <title>Fetch Data From Database in Php</title>
</head>
<body class="bg-dark">
    <div class="container">
      <div class="row mt-5">
        <div class="col">
          <div class="card mt-5">
            <div class="card-header">
              <h2 class="display-6 text-center">Student uploads medical and Details.</h2>
            </div>
            <div class="card-body">
              <div class="table-container">
                <table class="table table-bordered text-center">
                  <tr class="bg-dark text-white">
                 
                    <td> Reg No </td>
                    <td> Full Name </td>
                    
                    <td> Contact No </td>
                    <td> Start Date</td>
                    <td> End Date</td>
                    <td> Submit Date</td>
                    <td> Medical file </td>
                  </tr>
                  <?php 
                    while($row = mysqli_fetch_assoc($result))
                    {
                  ?>
                    <tr>
                      
                     
                      <td><?php echo $row['regno']; ?></td>
                      <td><?php echo $row['firstname']; ?></td>
                     
                      <td><?php echo $row['phonenumber']; ?></td>
                      <td><?php echo $row['sdate']; ?></td>
                      <td><?php echo $row['edate']; ?></td>
                      <td><?php echo $row['subdate']; ?></td>
                      
                      <td>
                        
                      <a href="../home/mediUploadwithAutofill/image/<?php echo $row['ufile']; ?>" download><?php echo $row['ufile']; ?></a>

                      
                      </td>
                    </tr>
                  <?php    
                    }
                  ?>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>
</html>
<?php
include("conn.php");
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
    .btn-success {
        background-color: #28a745; /* Green color */
        color: white;
    }
</style>
</head>
<body>


<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="http://www.kdu.ac.lk" target="_blank">
            <img src="kdu-logo2.png" alt="KDU Logo" width="180" height="40" class="d-inline-block align-top">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav text-center">
                <!-- Replace the href with the appropriate URLs for your pages -->
                <li class="nav-item"><a class="nav-link" href="../hod/hod.php">Home</a></li>
                 
            </ul>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
    </div>
</nav>

<h1 class="text-center text-white bg-dark col-md-12">PENDING LIST</h1>

<table class="table table-bordered col-md-12">
  <thead>
    <tr>
        <th scope="col">Medical No</th>
        <th scope="col">Name</th>
        <th scope="col">DATE</th>
        <th scope="col">MEDICAL</th>
        <th scope="col">ACTION</th>
    </tr>
  </thead>

<?php 

$query = "SELECT * FROM  medicalapply WHERE HODstatus = 'pending' "; //ORDER BY id ASC
$result = mysqli_query($conn,$query);
while($row = mysqli_fetch_array($result))  { 
  ?>

  <tbody>
    <tr>
      <th scope="row"><?php echo $row['id']; ?></th>   
      <td><?php echo $row['firstname']; ?></td>
      <td><?php echo $row['sdate']; ?></td>

      <td><a href="../mediForm/<?php echo $row['ufile']; ?>" download><?php echo $row['ufile']; ?></a></td>
      
      <td>
        <form action="hodApprove.php" method="POST">
          <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
          <input type="submit" name="approve" value="approve" class="btn btn-success"> &nbsp &nbsp <br>
        </form>
      </td>
    </tr>
  </tbody>
  <?php } ?>
</table>

<?php 
if(isset($_POST['approve'])){ // when pressing approve to table update status as pending to approve 
    $id = $_POST['id'];
    $select = "UPDATE medicalapply SET HODstatus = 'Approved' WHERE id = '$id' ";
    $resut = mysqli_query($conn,$select);
    //header("location:hodApprove.php");

}
?>

<!-- Approved List Table -->

<h1 class="text-center text-white bg-success col-md-12">APPROVED LIST</h1>

<table class="table table-bordered col-md-12">
  <thead>
    <tr>
      <th scope="col">Medical No</th>
      <th scope="col">NAME</th>
      <th scope="col">DATE</th>
      <th scope="col">MEDICAL</th>
      <th scope="col">STATUS</th>
    </tr>
  </thead>

<?php 
$query = "SELECT * FROM  medicalapply WHERE HODstatus = 'Approved'  ";
$result = mysqli_query($conn,$query);
while($row = mysqli_fetch_array($result)) { ?>
  <tbody>
    <tr>
      <th scope="row"><?php echo $row['id']; ?></th>
      <td><?php echo $row['firstname']; ?></td>
      <td><?php echo $row['sdate']; ?></td>
      <td><a href="../mediForm/<?php echo $row['ufile']; ?>" download><?php echo $row['ufile']; ?></a></td>
      <td><?php echo $row['HODstatus']; ?></td>
    </tr>
  </tbody>
  <?php } ?>
</table>

<!-- Rejected List -->

<!-- Add your rejected list table here if needed -->

</body>
</html>

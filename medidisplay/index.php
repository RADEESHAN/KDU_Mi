<?php
require_once('config/db.php');

$query = "SELECT * FROM medicalapply";
$result = mysqli_query($con, $query);

// Handle search
if(isset($_POST['search'])) {
  $search = $_POST['search'];
  $query .= " WHERE CONCAT(id, email, regno, firstname, intake, phonenumber, dept, sdate, edate, subdate, misslec, ufile) LIKE '%$search%'";
  $result = mysqli_query($con, $query);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <style>
    body {
      overflow-x: hidden;
    }
    .container {
      height: 100vh; /* Set the container height to 100% of the viewport height */
      display: flex;
      flex-direction: column;
    }
    .table-container {
      flex-grow: 1; /* Allow the table container to grow and fill the remaining space */
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
              <div class="row mb-3">
                <div class="col-md-6">
                  <form method="POST">
                    <input type="text" name="search" class="form-control" placeholder="Search...">
                  </form>
                </div>
              </div>
              <div class="table-container">
                <table class="table table-bordered text-center">
                  <tr class="bg-dark text-white">
                    <td> User ID </td>
                    <td> Email </td>
                    <td> Reg No </td>
                    <td> Full Name </td>
                    <td> Intake </td>
                    <td> Contact No </td>
                    <td> Department </td>
                    <td> Start Date</td>
                    <td> End Date</td>
                    <td> Submit Date</td>
                    <td> Missed Lectures</td>
                    <td> Medical file </td>
                  </tr>
                  <?php 
                    while($row = mysqli_fetch_assoc($result))
                    {
                  ?>
                    <tr>
                      <td><?php echo $row['id']; ?></td>
                      <td><?php echo $row['email']; ?></td>
                      <td><?php echo $row['regno']; ?></td>
                      <td><?php echo $row['firstname']; ?></td>
                      <td><?php echo $row['intake']; ?></td>
                      <td><?php echo $row['phonenumber']; ?></td>
                      <td><?php echo $row['dept']; ?></td>
                      <td><?php echo $row['sdate']; ?></td>
                      <td><?php echo $row['edate']; ?></td>
                      <td><?php echo $row['subdate']; ?></td>
                      <td><?php echo $row['misslec']; ?></td>
                      <td>
                        <a href="../mediForm/<?php echo $row['ufile']; ?>" download><?php echo $row['ufile']; ?></a> <!--pdf view-->
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
    <script>
      // JavaScript for filtering the table
      const searchInput = document.querySelector('input[name="search"]');
      const tableRows = document.querySelectorAll('.table tbody tr');

      searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        tableRows.forEach(row => {
          const rowData = Array.from(row.children).map(cell => cell.textContent.toLowerCase());
          if (rowData.some(data => data.includes(searchTerm))) {
            row.style.display = '';
          } else {
            row.style.display = 'none';
          }
        });
      });
    </script>
</body>
</html>
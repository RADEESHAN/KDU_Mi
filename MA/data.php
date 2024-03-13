<?php include("conn.php"); ?>

<table class="table table-bordered col-md-12">
  <thead>
    <tr>
      <th>ID</th>
      <th>First Name</th>
      <th>Department</th>
      <th>Missed Lecture Days</th>
      <th>Registration Number</th>
      <th>Missed Lectures</th>
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
      </tr>
    <?php } ?>
  </tbody>
</table>
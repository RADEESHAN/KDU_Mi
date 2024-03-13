<?php  include("conn.php");  ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body>
<section>
  <?php include("navbar.html") ?>

  </section>


<h1 class="text-center text-white bg-dark col-md-12">CONTACT EMAIL LIST</h1>

<table class="table table-bordered col-md-12">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Reason</th>
            <th scope="col">Message</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>

    <?php
    $query = "SELECT * FROM contactemail";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($result)) { ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['reason']; ?></td>
            <td><?php echo $row['message']; ?></td>
            <td>
                <!--form action="edit.php" method="POST"-->
                <form>
                    <!--input type="hidden" name="id" value="<?php echo $row['id']; ?>"/-->
                    <input type="submit" name="OK" value="OK" class="btn btn-primary"/>
                </form>
              
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>


 


</body>

</html>
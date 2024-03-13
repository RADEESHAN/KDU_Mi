
<?php  include('conn.php'); ?>
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


  <br>  <br>  <br>  <br>
<div class="pt-1 mb-2 text-center">

<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">User Registration</button>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<!-- <button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">User Registration</h4> -->
</div>

<div class="modal-body">

<form  method="post" action="">

<div class="form-outline mb-4">
<input type="text" id="username"  name="username"  class="form-control form-control-lg" required="" /><br>
<label class="form-label" for="form2Example27"  >User Name</label>
</div> 

<div class="form-outline mb-4">
<input type="text" id="email"   name="email" class="form-control form-control-lg" required="" /><br>
<label class="form-label" for="form2Example17">Email address</label>
</div>

<div class="form-outline mb-4">
<input type="text" id="password"  name="password"  class="form-control form-control-lg" required="" /><br>
<label class="form-label" for="form2Example27"  >Password</label>
</div>

<div class="pt-1 mb-2">
<button class="btn btn-dark btn-lg btn-success" type="submit" name="submit">User Registration</button>
</div>

<a href="login.php">Login</a>
</form>



</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
</div>
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<?php 

if (isset($_POST['submit'])) 
       {

        $username = $_POST['username'];
        $email =   $_POST['email'];
        $password = $_POST['password'];

        $checkuser = "select * from  emp_table where email = '$email'";
        $result = mysqli_query($conn,$checkuser);
        $count = mysqli_num_rows($result);
        if ($count>0) 
        {
          echo "Username already exists ! ";
        }

   else{
        $rtgb = mysqli_query($conn,"insert into emp_table(email,password,username)value('$email','$password','$username')");

        if($rtgb)

        {
          header("location:complain_register.php");
        }


      }

      }

?>
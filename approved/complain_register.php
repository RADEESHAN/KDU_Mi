<?php  include("conn.php");


  ?>

<!DOCTYPE html>
<html>
<head>
  <title>User Login </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>



<body>
 
  <br><br>
  <center>
     
<form  method="post" action="">
  
  <div class="form-outline  text-left col-md-6 mb-4">
    
<input type="text"  name="subject" id="subject"    class="form-control form-control-lg" required=""  placeholder="subject" /><br>

</div> 

<div class="form-outline  col-md-6 mb-4">

<textarea  name="content" id="content" class="col-md-12"></textarea>

</div>

<div class="pt-1 col-md-6 mb-2">
<button class="btn btn-dark btn-lg btn-success" type="submit" name="submit">Submit</button>
</div>
</form>
<a href="login.php">Login</a>
     
</form>
</center>
</body>
</html>

<?php 

     if (isset($_POST['submit']))  {

        $subject = $_POST['subject'];
        $content =   $_POST['content'];
 
        $sub = mysqli_query($conn,"insert into pending_list(subject,content,status)value('$subject','$content','pending')");

 if($sub>0){

  echo "your request is  under process! ";

 }
 else
 {
  
  echo "something went wrong ! ";
 }

       
 }
     

      

?>
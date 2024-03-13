<?php
require_once('config.php');
?>


<!DOCTYPE html>
<html>
<head>
    <title>User Registration | PHP</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>

<div>
    <?php
    include('navbar.html');
    ?>  
</div>

<div>
    <form action="process.php" method="post">
        <div class="container">
            
            <div class="row">
                <div class="col-sm-7">
                    <h1>Add New Users to the System.</h1>
                    <p>Fill up the form with correct values.</p>
                    <hr class="mb-7">
                    <label for="firstname"><b>Full Name</b></label>
                    <input class="form-control" id="firstname" type="text" name="firstname" required>

                    <label for="username"><b>User Name</b></label>
                    <input class="form-control" id="username"  type="text" name="username" required>

                    <label for="email"><b>Email Address</b></label>
                    <input class="form-control" id="email"  type="email" name="email" required>

                 


                    <label for="regno"><b>Registration number</b></label>
                    <input class="form-control" id="regno"  type="text" name="regno" required>

                    <label for="password"><b>Password</b></label>
                    <input class="form-control" id="password"  type="password" name="password" required>

                    <label for="usertype"><b>User Type</b></label>
                    <select class="form-control" id="usertype" name="usertype" required>
                        
                        <option value="hod">HOD</option>
                        <option value="ma">MA</option>
                        <option value="mi">MI</option>
                        <option value="doctor">Doctor</option>
                        <option value="arOfficer">AR Officer</option>
                    </select>

                    <label for="phonenumber"><b>Phone Number</b></label>
                    <input class="form-control" id="phonenumber"  type="text" name="phonenumber" required>

                    
                    <hr class="mb-3">
                    <input class="btn btn-primary" type="submit" id="register" name="create" value="Sign Up">
                </div>
            </div>
        </div>
    </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">
    $(function(){
        $('#register').click(function(e){

            var valid = this.form.checkValidity();

            if(valid){

               var firstname   = $('#firstname').val();
                var username    = $('#username').val();
                var email       = $('#email').val();
                
                var regno       = $('#regno').val();
                var password    = $('#password').val();
                var usertype    = $('#usertype').val();
                var phonenumber = $('#phonenumber').val();
                
                e.preventDefault();    

                $.ajax({
                    type: 'POST',
                    url: 'process.php',
                    data: {firstname: firstname, username: username, email: email, regno: regno, password: password, usertype: usertype, phonenumber: phonenumber},
                    success: function(data){
                    Swal.fire({
                                'title': 'Successful',
                                'text': data,
                                'type': 'success'
                                })
                            
                    },
                    error: function(data){
                        Swal.fire({
                                'title': 'Errors',
                                'text': 'There were errors while saving the data.',
                                'type': 'error'
                                })
                    }
                });

                
            } else {
                
            }
        });        
   

   


    });



</script>
</body>
</html>

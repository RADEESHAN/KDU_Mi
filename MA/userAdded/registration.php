<?php 
require_once('config.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User registration</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>

<body>

    <div>
        <?php
       
        ?>

    </div>

    <div>
        <form action="registration.php" method="post">
        <div class="container">
            <div class="row">
                <div class="col-sm-5">
                    <h1>User Registration</h1>
                    <p>Fill up the form with correct details.</p>
                    <hr class="mb-5">
                    <label for="fisrtname"><b>Full Name</b></label>
                    <input class="form-control" id="firstname" type="text" name="firstname" required>

                    <label for="email"><b>Email</b></label>
                    <input class="form-control" id="email"  type="text" name="email" required>

                    <label for="regno"><b>Registration number</b></label>
                    <input class="form-control" id="regno"  type="text" name="regno" required>

                    <label for="phonenumber"><b>Phone Number</b></label>
                    <input class="form-control" id="phonenumber"  type="text" name="phonenumber" required>

                    <label for="usertype"><b>user type</b></label>
                    <input class="form-control" id="usertype"  type="text" name="usertype" required>

                    <label for="passwords"><b>Password</b></label>
                    <input class="form-control" id="passwords"  type="passwords" name="passwords" required>
                    <hr class="mb-5">
                    <input class="btn btn-primary" type="submit" id="register" name="create" value="User Add">
                </div>
            </div>
        </div>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script type="text/javascript">
        $(function(){ 
            $('#register').click(function(e){
                var valid = this.form.checkValidity();

                


                if(valid){

                var firstname   = $('firstname').val();
                var email        = $('email').val();
                var regno        = $('regno').val();
                var phonenumber  = $('phonenumber').val();
                var usertype     = $('usertype').val();
                var passwords    = $('passwords').val();

                    e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        url: 'process.php',
                        data:{firstname:firstname,email:email,regno:regno,phonenumber:phonenumber,
                            usertype:usertype,passwords:passwords},
                        success: function(data){
                            Swal.fire({
                        'title':'Successful',
                        'text':data,
                        'type':'success' 
                         })
                      },
                        error: function(data){
                            Swal.fire({
                        'title':'Errors',
                        'text':'There were errors while saving the data',
                        'type':'error' 
                         })
                        }   
                    });
                  // alert('true'); 
                }else{
                  //  alert('false');
                }

             
            });
              
         });
</script>
</body>

</html>
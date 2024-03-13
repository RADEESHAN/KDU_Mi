<?php
session_start();


if(!isset($_SESSION["username"]))
{
	header("location:login.php");
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>student web page</title>
    <link rel="stylesheet" type="text/css" href="student.css" >
    <!--script type="text/javascript">// thids is for no going back when user loging
        function preventBack(){window.history.forward()};
        setTimeout("preventBack()",0);
        window.onunload=function(){null;}
    </script-->

    <script src="https://kit.fontawesome.com/3f91c23995.js" crossorigin="anonymous"></script>
</head>

<body>



    <div id="navbar-container">
        <?php include("navbar.html"); ?>
    </div>

    <section class="hero">
        <style>
            .hero {
                background-image: url('stuimg.jpg');
                background-size: cover;
                background-position: center;
                text-align: center;
                padding: 100px;
                color: #1f0535;
                position: relative;
            }

            .blur-card {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5); /* Adjust the alpha value to control transparency */
                backdrop-filter: blur(5px); /* Adjust the blur amount as needed */
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                color: white;
                padding: 20px;
            }
        </style>

        <div class="blur-card">
            <h1>Welcome STUDENT</h1>
            <p>Providing quality healthcare services.</p>
        </div>
    </section>

<div class="service">
    <div class="title">
        <h2>Services</h2>
    </div>

    <div class="box">
        <div class="card ">
            <style>.card{
    height: 365px;
    width: 335px;
    padding: 20px 35px;
    background: #191919;
    border-radius: 20px;
    margin: 15px;
    position: relative;
    overflow: hidden;
    text-align: center ;  }</style>


        <i class="fa-solid fa-file-arrow-up"></i>
            <h5>Apply medical</h5>
            <div class="pra">
                <p>You can apply medicals here. you need to fill the form and submit that form with 
                    your medical file.
                </p>
                <p style="text-align: center;">
                <a class="button" href="/home/mediForm/index.php">Click here</a> 
                <!--"/home/mediUploadwithAutofill/medical_upload_form.php-->
            </p>
            </div>
        </div>

        <div class="card">
        <i class="fa-solid fa-file">
            <style>
                .card i{ font-size: 50px;display: block;text-align: center;margin: 25px 0px;color: #f9004d; 
}
            </style>
        </i>
            <h5>View priviously medical</h5>
            <div class="pra">
                <p>You can see your medicals history here.Those approve or reject</p>
                <p style="text-align: center;">
                <a class="button" href="/home/student/privious_medi.php">Click here</a> 
            </p>
            </div>
        </div>

        


        





    </div>
</div>




<footer>
    <div id="navbar-container">
        <?php include("footer.php"); ?>
    </div>
    </footer>

    
</body>

</html>
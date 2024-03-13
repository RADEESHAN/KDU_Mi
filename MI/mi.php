<!DOCTYPE html>
<html lang="en">

<head>
    <title>mi web page</title>
    <link rel="stylesheet" type="text/css" href="mi.css">
    <script src="https://kit.fontawesome.com/3f91c23995.js" crossorigin="anonymous"></script>
</head>

<body>
    <div id="navbar-container">
        <?php include("navbar.html"); ?>
    </div>

    <section class="hero">
        <style>
            .hero {
                background-image: url('miimg.jpg');
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
                background-color: rgba(0, 0, 0, 0.5);
                backdrop-filter: blur(5px);
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                color: white;
                padding: 20px;
            }
        </style>

        <div class="blur-card">
            <h1>Welcome Medical Inspection staff.</h1>
            <p>Providing quality health services.</p>
        </div>
    </section>

    <div class="service">
        <div class="title">
            <h2>Services</h2>
        </div>

        <div class="box" style="display: flex; justify-content: space-around;">
            <div class="card">
                <style>
                    .card {
                        height: 365px;
                        width: 335px;
                        padding: 20px 35px;
                        background: #191919;
                        border-radius: 20px;
                        margin: 15px;
                        position: relative;
                        overflow: hidden;
                        text-align: center;
                        display: inline-block;
                    }
                </style>

                <i class="fa-solid fa-file-arrow-up"></i>
                <h5>Add New Students</h5>
                <div class="pra">
                    <p>You can see student apply medicals here, so it helps for your works.</p>
                    <p style="text-align: center;">
                        <a class="button" href="/home/MI/AddUserLogin/registration.php">Click here</a>
                    </p>
                </div>
            </div>

            <div class="card">
                <style>
                    .card i {
                        font-size: 50px;
                        display: block;
                        text-align: center;
                        margin: 25px 0px;
                        color: #f9004d;
                    }
                </style>
                <i class="fa-solid fa-file"></i>
                <h5>Set doctor time</h5>
                <div class="pra">
                    <p>You can see your medicals history here. Those approve or reject</p>
                    <p style="text-align: center;">
                        <a class="button" href="/home/MI/updateTime/doctor_update.html">Click here</a>
                    </p>
                </div>
            </div>

            <div class="card">
                <style>
                    .card i {
                        font-size: 50px;
                        display: block;
                        text-align: center;
                        margin: 25px 0px;
                        color: #f9004d;
                    }
                </style>
                <i class="fa-solid fa-envelopes-bulk"></i>
                <h5>View user send Mails</h5>
                <div class="pra">
                    <p>You can see your student send mails here. You can give solution to their problems</p>
                    <p style="text-align: center;">
                        <a class="button" href="/home/email/getMailtoMI/mail.php">Click here</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="box" style="display: flex; justify-content: space-around;">
            <div class="card">
                <style>
                    .card {
                        height: 365px;
                        width: 335px;
                        padding: 20px 35px;
                        background: #191919;
                        border-radius: 20px;
                        margin: 15px auto;
                        position: relative;
                        overflow: hidden;
                        text-align: center;
                        display: inline-block;
                    }
                </style>

                <i class="fa-solid fa-file-arrow-up"></i>
                <h5>Add New Admins</h5>
                <div class="pra">
                    <p>You can see student apply medicals here, so it helps for your works.</p>
                    <p style="text-align: center;">
                        <a class="button" href="/home/MI/userADDadmin/registration.php">Click here</a>
                    </p>
                </div>
            </div>


            <div class="card">
                <i class="fa-solid fa-envelopes-bulk"></i>
                <style>
                    .card i {
                        font-size: 50px;
                        display: block;
                        text-align: center;
                        margin: 25px 0px;
                        color: #f9004d;
                    }
                </style>
                </i>
                <h5>Vacations</h5>
                <div class="pra">
                    <p>You can see your student send mails here.you can give solution those their problems</p>
                    <p style="text-align: center;">
                        <a class="button" href="/home/MI/vacation.php">Click here</a>
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

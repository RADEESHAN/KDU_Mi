<?php
session_start();


if(!isset($_SESSION["username"]))
{
	header("location:../home/Home.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>student web page</title>
    <link rel="stylesheet" type="text/css" href="../home/student.css" >
</head>

<body>
    <header><?php echo $_SESSION["username"] ?>
        <nav>
            <ul><li><a href="#">Home</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Contact</a></li>
				<li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section class="hero">
        <h1>Welcome Management Assistant</h1>
        <p>Do the department works.</p>
        <a href="#" class="btn">Learn More</a>
    </section>

    <section class="services">
        <h2>Our Services</h2>
        <div class="service">
            <img src="studentpageima/uploadwebp.webp" alt="Service 1">
            <h3>Service 1</h3>
            <p></p>
        </div>
        <div class="service">
            <img src="student.jpg" alt="Service 2">
            <h3>Service 2</h3>
            <p></p>
        </div>

    </section>

   <!--?php include_once("nuwan/index.php") ?-->

    <footer>
    <?php include_once("../home/footer/footer.php") ?>
    </footer>

    <!--script src="script.js"></script-->




    
</body>
</html>
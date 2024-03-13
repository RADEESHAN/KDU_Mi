<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user";



$name = $_POST["name"];
$email = $_POST["email"];
$subject = $_POST["subject"];
$message = $_POST["message"];

 

	//Connection object
	$conn = new mysqli($servername, $username ,$password, $dbname);
	$sql="INSERT INTO contactemail(name,email,reason,message) VALUES('$name','$email','$subject','$message')";
	$result = mysqli_query($conn,$sql);



		if($result){
			
			
			//header('Location: ../Index.html'); 
				
				echo "<script> 
					window.alert(\"Thank You for Contact us. We will inform you as soon as possible\");
					window.location.replace(\"../view.html\");
	 			 </script>";
			

		}


	$conn->close();






//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing true enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'pramuditharadeeshan@gmail.com';                     //SMTP username
    $mail->Password   = 'hciocxtwhcbniwke';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS

    //Recipients
    $mail->setFrom('pramuditharadeeshan00@gmail.com', 'server');
    $mail->addAddress('pramuditharadeeshan@gmail.com', 'admin');     //Add a recipient
    
    //$mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo($email, 'user');
    $mail->addCC($email);
    //$mail->addBCC('bcc@example.com');

    //Attachments
   // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;
     

    $mail->send();
    echo 'Message has been sent';
    // You can set a success message here
    header("Location:index.php?message=success");
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    // You can set an error message here
    header("Location: index.php?message=error");
}
?>



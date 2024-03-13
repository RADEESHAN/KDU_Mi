<?php
require_once('config.php');





?>
<?php

if(isset($_POST)){

    $firstname 		= $_POST['firstname'];
	$username 		= $_POST['username'];
	$email 			= $_POST['email'];
	$regno 			= $_POST['regno'];
	$intake			= $_POST['intake'];
    $password 		= $_POST['password'];
	$usertype       = $_POST['usertype'];
    $phonenumber	= $_POST['phonenumber'];
	

		$sql = "INSERT INTO login (firstname, username, email,regno,intake,password,usertype, phonenumber) VALUES(?,?,?,?,?,?,?,?)";
		$stmtinsert = $db->prepare($sql);
		$result = $stmtinsert->execute([$firstname, $username, $email, $regno,$intake, $password, $usertype, $phonenumber]);
	
		if($result){
			echo 'Successfully saved.';
		}else{
			echo 'There were erros while saving the data.';
		}
}else{
	echo 'No data';
}
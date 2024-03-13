<?php
require_once('config.php');
?>
<?php

if(isset($_POST)){

	$username 		= $_POST['username'];
	$lastname 		= $_POST['username'];
	$email 			= $_POST['email'];
	$regno 			= $_POST['regno'];
	$usertype       = $_POST['usertype'];
	$phonenumber	= $_POST['phonenumber'];
	$password 		= sha1($_POST['password']);

		$sql = "INSERT INTO ADDusers2 (username,lastname, email,regno,usertype, phonenumber, password ) VALUES(?,?,?,?,?,?)";
		$stmtinsert = $db->ADDuser2($sql);
		$result = $stmtinsert->execute([$username, $lastname,  $email, $regno, $usertype, $phonenumber, $password]);
		if($result){
			echo 'Successfully saved.';
		}else{
			echo 'There were erros while saving the data.';
		}
}else{
	echo 'No data';
}
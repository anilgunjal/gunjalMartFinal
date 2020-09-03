<?php
require_once("../class/connect.php");
$femail=$_POST['email'];

	$stmt = $mysqli->prepare("SELECT email FROM admins WHERE email = ?");
	$stmt->bind_param("s", $femail );
	if($stmt->execute ())
	{
		$stmt->bind_result ( $email );
		$stmt->store_result ();
		$stmt->fetch ();
		if($stmt->num_rows > 0){
			 echo 'This Email-id already exist';
		}
	}
?>
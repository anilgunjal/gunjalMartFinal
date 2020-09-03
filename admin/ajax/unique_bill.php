<?php
require_once("../class/connect.php");
$billnumber = $_POST['billnumber'];

	$stmt = $mysqli->prepare("SELECT billnumber FROM reviewstat WHERE billnumber = ?");
	$stmt->bind_param("s", $billnumber );
	if($stmt->execute ())
	{
		$stmt->bind_result ( $bill );
		$stmt->store_result ();
		$stmt->fetch ();
		if($stmt->num_rows > 0){
			 echo 'This Bill Number already exist';
		}
	}
?>
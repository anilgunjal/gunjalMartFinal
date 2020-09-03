<?php
require_once("../class/connect.php");
$cname=$_POST['cname'];

	$stmt = $mysqli->prepare("SELECT catname FROM category WHERE catname = ?");
	$stmt->bind_param("s", $catname );
	if($stmt->execute ())
	{
		$stmt->bind_result ( $catname );
		$stmt->store_result ();
		$stmt->fetch ();
		if($stmt->num_rows > 0){
			 echo 'This Category already exist';
		}
	}
?>
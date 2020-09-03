<?php
require_once("../class/connect.php");
$subcname=$_POST['subcname'];
$cname=$_POST['cname'];

	$stmt = $mysqli->prepare("SELECT subcatname FROM subcategory WHERE subcatname = ? AND catid = ?");
	$stmt->bind_param("si", $subcatname, $cname );
	if($stmt->execute ())
	{
		$stmt->bind_result ( $subcatname );
		$stmt->store_result ();
		$stmt->fetch ();
		if($stmt->num_rows > 0){
			 echo 'This Sub-Category already exist for selected Category';
		}
	}
?>
<?php
require_once("../class/connect.php");

	date_default_timezone_set("Asia/Kolkata");
	$date = date('Y-m-d H:i:s');
	$points =  $_POST['points'];
	$userid = $_POST['userid'];
	$reviewid = $_POST['reviewid'];
	$adminid = $_POST['adminid'];
	
	$stmt = $mysqli->prepare("INSERT INTO points (userid, reviewid, points, adminid, createdDate ) VALUES (?,?,?,?,?)");
	$stmt->bind_param ( "iiiis", $userid, $reviewid, $points, $adminid, $date );
	if($stmt->execute ())
	{
		$msg = "1";
	}
	else
	{
		$msg = "Something went wrong. Try again";
	}
echo $msg;
?>

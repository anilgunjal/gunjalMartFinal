<?php
require_once("../class/connect.php");

	date_default_timezone_set("Asia/Kolkata");
	$date = date('Y-m-d H:i:s');
	$comments = $_POST['comments'];
	$status = $_POST['status'];
	$adminid = $_POST['adminid'];
	$points = $_POST['points'];
	$revid = $_POST['revid'];
	$userid = $_POST['userid'];
	$invoice_date = $_POST['invoicedate'];
	
	$stmt = $mysqli->prepare("UPDATE reviewstat SET comment = ?, status = ?, upadminid = ?, updatedDate = ?, invoice_date = ?, WHERE id = ?");
	$stmt->bind_param ( "siissi", $comments, $status, $adminid, $date, $invoice_date, $revid );
	if($stmt->execute ())
	{
		if($status == "1")
		{
		$stmtp = $mysqli->prepare("SELECT count(*) as total FROM points WHERE userid = ? AND reviewid = ?");
		$stmtp->bind_param ( "ii", $userid, $revid );
		$stmtp->execute ();
		$stmtp->bind_result ( $total );
		$stmtp->store_result ();
		$stmtp->fetch ();
		if($total > 0){
			$stmti = $mysqli->prepare("UPDATE points SET status = ?  WHERE userid = ? AND reviewid = ?");
			$stmti->bind_param ( "iii", $status, $userid, $revid);
			if($stmti->execute ())
			{
				$msg = "1";
			}
			
		} else {
			$stmti = $mysqli->prepare("INSERT INTO points (userid, reviewid, points, status, adminid, createdDate ) VALUES (?,?,?,?,?,?)");
			$stmti->bind_param ( "iiiiis", $userid, $revid, $points, $status, $adminid, $date );
			if($stmti->execute ())
			{
				$msg = "1";
			}
		}
		}
		else{
			$msg = "1";
		}
		
	}
	else
	{
		$msg = "Something went wrong. Try again";
	}
echo $msg;
?>

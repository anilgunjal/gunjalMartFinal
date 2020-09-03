<?php
require_once("../class/connect.php");

	date_default_timezone_set("Asia/Kolkata");
	$date = date('Y-m-d H:i:s');
	$cname = $_POST['cname'];
	$subcname = ucwords($_POST['subcname']);
	$adminid = $_POST['adminid'];
	
	$stmt = $mysqli->prepare("INSERT INTO subcategory (catid, adminid, subcatname, createdDate ) VALUES (?,?,?,?)");
	$stmt->bind_param ( "iiss", $cname, $adminid, $subcname, $date );
	if($stmt->execute ())
	{
		$last_id = $stmt->insert_id;
		$i = 1;
		foreach ($_POST['specif'] as $specs)
		{
			$stmti = $mysqli->prepare("INSERT INTO specification ( scatid, specification, level, createdDate ) VALUES (?,?,?,?)");
			$stmti->bind_param ( "isis", $last_id, $specs, $i, $date );
			if($stmti->execute ())
			{
				$msg = "1";
			}
			else
			{
				$msg = "Something went wrong";
			}
			$i++;
		}
	}
	else
	{
		$msg = "Something went wrong. Try again";
	}
echo $msg;
?>

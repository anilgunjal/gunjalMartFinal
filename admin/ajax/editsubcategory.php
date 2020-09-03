<?php
require_once("../class/connect.php");
require_once("../class/function.php");

date_default_timezone_set("Asia/Kolkata");
	$date = date('Y-m-d H:i:s');
	$cname = $_POST['cname'];
	$subcname = ucwords($_POST['subcname']);
	$scatid = $_POST['scatid'];
	$addeditmore = $_POST['addeditmore'];
	
	if(!empty($_POST['deletespe']))
	{
		$stmttu = $mysqli->prepare ( "Update specification SET level = '0' where scatid = '$scatid'" );
		$stmttu->execute();
		
		foreach ($_POST['deletespe'] as $delspe)
		{
			$stmtd = $mysqli->prepare("DELETE FROM specification WHERE spfid = ?;");
			$stmtd->bind_param("i", $delspe);
			$stmtd->execute();
		}
		
		$stmtt = $mysqli->prepare ( "select count(*) as total from specification where scatid = '$scatid'" );
		$stmtt->execute();
		$stmtt->bind_result ( $total);
		$stmtt->store_result ();
		$stmtt->fetch ();
		$i =1;
		while($i <= $total)
		{
			$stmttu = $mysqli->prepare ( "Update specification SET level = '$i' where scatid = '$scatid' AND level = '0' LIMIT 1" );
			$stmttu->execute();
			$i++; 
		}
	}
	
	
	if($addeditmore > 0)
	{
		$stmtt = $mysqli->prepare ( "select count(*) as total from specification where scatid = '$scatid'" );
		$stmtt->execute();
		$stmtt->bind_result ( $total);
		$stmtt->store_result ();
		$stmtt->fetch ();
		$i = $total+1;
		foreach ($_POST['editspecif'] as $specs)
		{
			if($specs !="" or !empty($specs))
			{
			$stmti = $mysqli->prepare("INSERT INTO specification ( scatid, specification, level, createdDate ) VALUES (?,?,?,?)");
			$stmti->bind_param ( "isis", $scatid, $specs, $i, $date );
			if($stmti->execute ())
			{
				$msg = "1";
			}
			else
			{
				$msg = "Something went wrong";
			}
			}
			$i++;
		}
	}
	
	
	
	$stmt = $mysqli->prepare("UPDATE subcategory SET catid = ?, subcatname = ?  WHERE scatid = ?");
	$stmt->bind_param ( "isi", $cname, $subcname, $scatid);
	if($stmt->execute ())
	{
		foreach (array_combine($_POST['specif'], $_POST['specifid']) as $specs => $specsid)
		{
			if($specs !="" or !empty($specs))
			{
			$stmtii = $mysqli->prepare("UPDATE specification SET scatid = ?, specification = ?  WHERE spfid = ?");
			$stmtii->bind_param ( "isi", $scatid, $specs, $specsid );
			if($stmtii->execute ())
			{
				$msg = "1";
			}
			else
			{
				$msg = "Something went wrong";
			}
			}
		}
	}
	else
	{
		$msg = "Something went wrong. Try again";
	}
echo $msg;
?>

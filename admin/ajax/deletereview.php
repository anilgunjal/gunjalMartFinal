<?php
require_once("../class/connect.php");

$r_id = $_POST['r_id'];
$stmti = $mysqli->prepare ( "SELECT invoice FROM reviewstat WHERE id = ?" );
$stmti->bind_param ( "i", $r_id);
if($stmti->execute())
{
	$stmti->bind_result ($invoice);
	$stmti->store_result ();
	$stmti->fetch ();
	unlink('../../'.$invoice);		
}									
$stmt = $mysqli->prepare("DELETE FROM reviewstat WHERE id = ?;");
$stmt->bind_param("i", $r_id);
if($stmt->execute())
{
	$stmt = $mysqli->prepare("DELETE FROM smiley WHERE rid = ?;");
	$stmt->bind_param("i", $r_id);
	if($stmt->execute())
	{
		$stmtrr = $mysqli->prepare("DELETE FROM points WHERE reviewid = ?;");
		$stmtrr->bind_param("i", $r_id);
		if($stmtrr->execute())
		{
			$msg ="1";
		}
		else
		{
			echo "Something is Wrong";
		}
	}
	else
	{
		echo "Something is Wrong";
	}
}
else
{
	echo "Something is Wrong";
}

echo $msg;

?>
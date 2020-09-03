<?php
require_once("../class/connect.php");

$adminid = $_POST['adminid'];

$stmt = $mysqli->prepare("DELETE from admins WHERE adminid = ?");
$stmt->bind_param("i", $adminid);
if($stmt->execute())
{	
	$msg ="1";
}
else
{
	$msg = "Something is Wrong";
}

echo $msg;

?>
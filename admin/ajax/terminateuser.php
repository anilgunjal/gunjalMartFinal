<?php
require_once("../class/connect.php");

$userid = $_POST['userid'];

$stmt = $mysqli->prepare("DELETE from users WHERE userid = ?");
$stmt->bind_param("i", $userid);
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
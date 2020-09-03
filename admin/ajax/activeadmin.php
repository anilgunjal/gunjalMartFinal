<?php
require_once("../class/connect.php");

$adminid = $_POST['adminid'];
$stat = "0";
$stmt = $mysqli->prepare("UPDATE admins SET empstat = ? WHERE adminid = ?;");
$stmt->bind_param("ii", $stat, $adminid);
if($stmt->execute())
{	
	$msg ="1";
}
else
{
	echo "Something is Wrong";
}

echo $msg;

?>
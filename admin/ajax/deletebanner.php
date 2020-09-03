<?php
require_once("../class/connect.php");

$b_id = $_POST['b_id'];
$imgpath = $_POST['imgpath'];

$stmt = $mysqli->prepare("DELETE FROM banner WHERE bannerid=?;");
$stmt->bind_param("i", $b_id);
if($stmt->execute())
{	
	$path = "../".$imgpath;
	unlink($path);
	$msg = "1";
}
else
{
	echo "Oops Something went Wrong";
}

echo $msg;

?>
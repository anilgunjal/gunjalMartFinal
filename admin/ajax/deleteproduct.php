<?php
require_once("../class/connect.php");

$p_id = $_POST['p_id'];
$stmts = $mysqli->prepare("DELETE FROM products WHERE id = ?;");
$stmts->bind_param("i", $p_id);
if($stmts->execute())
{
	$msg ="1";	
}
else
{
	echo "Something is Wrong";
}

echo $msg;

?>
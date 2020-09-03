<?php
require_once("class/connect.php");
session_start();
if(isset($_SESSION['SESS_ADMINID']))
{
	$admin_id = $_SESSION['SESS_ADMINID'];
}
$stmt = $mysqli->prepare ( "UPDATE admins SET logstatus = '0' WHERE adminid = ?" );
$stmt->bind_param ( "i", $admin_id);
$stmt->execute();

session_regenerate_id(true);

unset($_SESSION['SESS_ADMINID']);

session_destroy();
header("location:login.php");
?>
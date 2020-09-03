<?php
require_once("../class/connect.php");
date_default_timezone_set("Asia/Kolkata");
$date = date('Y-m-d H:i:s');

$logemail = $_POST['emailid'];
$pass = md5($_POST['password']);

	$stmt = $mysqli->prepare ( "SELECT adminid, email, password, status FROM admins WHERE email = ? AND password =?" );
	$stmt->bind_param ( "ss", $logemail, $pass );
	if($stmt->execute())
	{
		$stmt->bind_result ( $adminid, $email, $password, $status );
		$stmt->store_result ();
		$row = $stmt->fetch ();
		if($logemail==$email && $pass==$password)
		{
			$stmti = $mysqli->prepare ( "UPDATE admins SET logstatus = '1', lastlogindate = ? WHERE adminid = ?" );
			$stmti->bind_param ( "si", $date, $adminid);
			$stmti->execute();
			session_start();
			$_SESSION['SESS_ADMINID'] = $adminid;
			$_SESSION['SESS_ADMSTAT'] = $status;
			$msg = 1;
		}
		else
		{
			$msg = "Login credentials invalid";
		}

	}
	else 
	{
		$msg = "Login credentials invalid";
	}
echo $msg;
?>

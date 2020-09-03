<?php 
	if(session_id()=="")
	{
		session_start();
	}

	if(!isset($_SESSION['SESS_ADMINID']))
	{
		header("location:login.php");
	}
?>
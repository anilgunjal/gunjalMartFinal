<?php
	/* $dbHost = 'localhost';
	$dbUsername = 'naprevie_admin';
	$dbPassword = 'admin@123';
	$dbName = 'naprevie_db'; */
	
	$dbHost = 'localhost';
	$dbUsername = 'root';
	$dbPassword = '';
	$dbName = 'napreview';

	//connect with the database
	$db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
?>	
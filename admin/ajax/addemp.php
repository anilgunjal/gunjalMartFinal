<?php
require_once("../class/connect.php");
require_once("../class/function.php");
date_default_timezone_set("Asia/Kolkata");
$date = date('Y-m-d H:i:s');

	$name = ucwords($_POST['name']);
	$address = trim($_POST['address']);
	$mobile = $_POST['contact'];
	$email = trim($_POST['email']);
	// $dob = date_format(date_create($_POST['dob']),"Y-m-d");
	$dob = date("Y-m-d",strtotime($_POST['dob']));
	$password = md5($_POST['password']);
	$pass = $_POST['password'];
	$empid = $_POST['empid'];
	$status = "2";
	
	$subject = "Login Credentails for NAP Review Admin Panel";
	$header = "From: admin@napreview.com\r\n";
	$header .= "Reply-To: admin@napreview.com\r\n";
	$message = "Hello $name, \n\n\n\r";
	$message.= "Your account has been created in NAP Review Admin Panel. Your Login Credentails are below:\n\n";
	$message.= "Email : $email \n\r";
	$message.= "Password :  $pass \n\r";
	$message.= "Login on clicking this url : https://napreview.com/admin";
	
		if(filter_var($email, FILTER_VALIDATE_EMAIL) === false)
		{
			$msg =  "Invalid Email";
		}
		else
		{
		
			if(empty($_FILES['avatar']['name']))
			{
				$stmt = $mysqli->prepare("INSERT INTO employees (name, empid, email, password, contact, address, dob, status, createDate ) VALUES (?,?,?,?,?,?,?,?,?)");
				$stmt->bind_param ( "sssssssis", $name, $empid, $email, $password, $mobile, $address, $dob, $status, $date );
				if($stmt->execute ())
				{
					$last_id = $stmt->insert_id;
					$msg = "1";
					mail($email, $subject, $message, $header);
				}
				else
				{
					$msg = "Something went wrong. Try again";
				}
			}
			else
			{
				$photo = $_FILES['avatar']['name'];
				$photo_tmp = $_FILES['avatar']['tmp_name'];
				if(file_exists("../uploads/employees/".$photo))
				{
					$newimgname = renameimage($photo);
					move_uploaded_file($photo_tmp,"../uploads/employees/".$newimgname);
				
					$imgpath = "uploads/employees/".$newimgname;
					
					$stmt = $mysqli->prepare("INSERT INTO employees (name, empid, email, password, contact, address, dob, avatar, status, createDate ) VALUES (?,?,?,?,?,?,?,?,?,?)");
					$stmt->bind_param ( "ssssssssis", $name, $empid, $email, $password, $mobile, $address, $dob, $imgpath, $status, $date );
					if($stmt->execute ())
					{
						$last_id = $stmt->insert_id;
						$msg = "1";
						mail($email, $subject, $message, $header);
					}
					else
					{
						$msg = "Something went wrong. Try again";
					}
				}	
				else
				{
					move_uploaded_file($photo_tmp,"../uploads/employees/".$photo);
				
					$imgpath = "uploads/employees/".$photo;
					
					$stmt = $mysqli->prepare("INSERT INTO employees (name, empid, email, password, contact, address, dob, avatar, status, createDate ) VALUES (?,?,?,?,?,?,?,?,?,?)");
					$stmt->bind_param ( "ssssssssis", $name, $empid, $email, $password, $mobile, $address, $dob, $imgpath, $status, $date );
					if($stmt->execute ())
					{
						$last_id = $stmt->insert_id;
						$msg = "1";
						mail($email, $subject, $message, $header);
					}
					else
					{
						$msg = "Something went wrong. Try again";
					}
				}
			}
		}
echo $msg;
?>

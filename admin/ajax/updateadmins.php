<?php
require_once("../class/connect.php");
require_once("../class/function.php");

	$name = ucwords($_POST['name']);
	$address = trim($_POST['address']);
	$mobile = $_POST['contact'];
	$email = trim($_POST['email']);
	$dob = date("Y-m-d",strtotime($_POST['dob']));
	$empid = $_POST['empid'];
	$adminid = $_POST['adminid'];
	
	if(!empty($email))
	{
		if(filter_var($email, FILTER_VALIDATE_EMAIL) === false)
		{
			$msg =  "Invalid Email";
		}
	}
	
	if(empty($_FILES['avatar']['name']))
	{
		$stmt = $mysqli->prepare("UPDATE admins SET name = ?, contact = ?, address = ?, email = ?, dob = ? WHERE adminid = ?");
		$stmt->bind_param ( "sssssi", $name, $mobile, $address, $email, $dob, $adminid );
		if($stmt->execute ())
		{
			$msg = "1";
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
		if(file_exists("../uploads/admin/".$photo))
		{
			$newimgname = renameimage($photo);
			move_uploaded_file($photo_tmp,"../uploads/admin/".$newimgname);
		
			$imgpath = "uploads/admin/".$newimgname;
			
			$stmt = $mysqli->prepare("UPDATE admins SET name = ?, contact = ?, address = ?, email = ?, dob = ?, avatar = ? WHERE adminid = ?");
			$stmt->bind_param ( "ssssssi", $name, $mobile, $address, $email, $dob, $imgpath, $adminid );
			if($stmt->execute ())
			{
				$msg = "1";
			}
			else
			{
				$msg = "Something went wrong. Try again";
			}
		}	
		else
		{
			move_uploaded_file($photo_tmp,"../uploads/admin/".$photo);
		
			$imgpath = "uploads/admin/".$photo;
			
			$stmt = $mysqli->prepare("UPDATE admins SET name = ?, contact = ?, address = ?, email = ?, dob = ?, avatar = ? WHERE adminid = ?");
			$stmt->bind_param ( "ssssssi", $name, $mobile, $address, $email, $dob, $imgpath, $adminid );
			if($stmt->execute ())
			{
				$msg = "1";
			}
			else
			{
				$msg = "Something went wrong. Try again";
			}
		}
	}
	
	
	
echo $msg;
?>

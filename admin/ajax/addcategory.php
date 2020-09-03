<?php
require_once("../class/connect.php");
require_once("../class/function.php");

	date_default_timezone_set("Asia/Kolkata");
	$date = date('Y-m-d H:i:s');
	$cname = ucwords($_POST['cname']);
	$adminid = $_POST['adminid'];
	
	$filename1 = $_FILES['files']['name'];
	$photo = str_replace(' ', '_', $filename1);
	$photo_tmp = $_FILES['files']['tmp_name'];
	$image_info = getimagesize($_FILES['files']['tmp_name']);
	$image_width = $image_info[0];
	$image_height = $image_info[1];
	$allowed =  array('jpeg','png','jpg','JPEG','PNG','JPG');
	$ext = pathinfo($filename1, PATHINFO_EXTENSION);
	if(file_exists("../uploads/cat_img/".$photo))
	{
		if(!in_array($ext,$allowed) ) 
		{
			$msg = 'Sorry, only JPEG, PNG and JPG files are allowed.';
		}
		else if($_FILES['files']['size'] > 512000000)
		{
			$msg = "Image size should be less than 5MB";
		}
		else if ($image_width != 70 and $image_height != 50)
		{
			$msg = "Please Upload image of size 70 X 50";
		}
		else
		{
			$newimgname = renameimage($photo);
			move_uploaded_file($photo_tmp,"../uploads/cat_img/".$newimgname);
			
			$files_path = "../uploads/cat_img/".$newimgname;
			$files_path2 = "uploads/cat_img/".$newimgname;
			
			$stmt = $mysqli->prepare("INSERT INTO category (adminid, catname, cat_img, createdDate ) VALUES (?,?,?,?)");
			$stmt->bind_param ( "isss", $adminid, $cname, $files_path2, $date );
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
	else
	{
		if(!in_array($ext,$allowed) ) 
		{
			$msg = 'Sorry, only JPEG, PNG and JPG files are allowed.';
		}
		else if($_FILES['files']['size'] > 512000000)
		{
			$msg = "Image size should be less than 500kb";
		}
		else if ($image_width != 70 and $image_height != 50)
		{
			$msg = "Please Upload image of size 70 X 50";
		}
		else
		{
		move_uploaded_file($photo_tmp,"../uploads/cat_img/".$photo);
				
		$files_path = "../uploads/cat_img/".$photo;
		$files_path2 = "uploads/cat_img/".$photo;
		
		$stmt = $mysqli->prepare("INSERT INTO category (adminid, catname, cat_img, createdDate ) VALUES (?,?,?,?)");
		$stmt->bind_param ( "isss", $adminid, $cname, $files_path2, $date );
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

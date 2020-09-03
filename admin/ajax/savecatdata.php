<?php
require_once("../class/connect.php");
require_once("../class/function.php");
error_reporting(0);
$c_id = $_POST['c_id'];
$cattxt = ucwords($_POST['cattxt']);
$catimg = $_POST['catimage1'];

	
	$filename1 = $_FILES['catimg']['name'];
	if($filename1 != "")
	{
		
	//echo $filename1."empty";
	$photo = str_replace(' ', '_', $filename1);
	$photo_tmp = $_FILES['catimg']['tmp_name'];
	$image_info = getimagesize($_FILES['catimg']['tmp_name']);
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
			else if($_FILES['catimg']['size'] > 512000)
			{
				$msg = "Image size should be less than 500kb";
			}
			else if ($image_width != 70 and $image_height != 50)
			{
				$msg = "Please Upload image of size 70 X 50";
			}
			else
			{
				$newimgname = renameimage($photo);
				move_uploaded_file($photo_tmp,"../uploads/cat_img/".$newimgname);
				$imgpath = "uploads/cat_img/".$newimgname;
				//echo $imgpath;
				$tpath = "../".$catimg;
				unlink($tpath);

				$stmt = $mysqli->prepare("UPDATE category SET catname = ?, 	cat_img = ? WHERE catid = ?" );
				$stmt->bind_param("ssi", $cattxt, $imgpath, $c_id );
				if($stmt->execute())
				{
					$msg = "Category Updated Successfully";

				}
				else
				{
					$msg = "Something went Wrong";
				}
			}
		}
		else
		{
			
	//echo $filename1."empty";
	$photo = str_replace(' ', '_', $filename1);
	$photo_tmp = $_FILES['catimg']['tmp_name'];
	$image_info = getimagesize($_FILES['catimg']['tmp_name']);
	$image_width = $image_info[0];
	$image_height = $image_info[1];
	$allowed =  array('jpeg','png','jpg','JPEG','PNG','JPG');
	$ext = pathinfo($filename1, PATHINFO_EXTENSION);
	
			if(!in_array($ext,$allowed) ) 
			{
				$msg = 'Sorry, only JPEG, PNG and JPG files are allowed.';
			}
			else if($_FILES['catimg']['size'] > 512000)
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
			$imgpath = "uploads/cat_img/".$filename1;
			$fpath = "../".$catimg;
			unlink($fpath);
			
			$stmt = $mysqli->prepare("UPDATE category SET catname = ?, cat_img = ? WHERE catid = ?" );
				$stmt->bind_param("ssi", $cattxt, $imgpath, $c_id );
				if($stmt->execute())
				{
					$msg = "Category Updated Successfully||";

				}
				else
				{
					$msg = "Something went Wrong";
				}
			}
		}
	}
	else
	{
		$stmt = $mysqli->prepare("UPDATE category SET catname = ?, cat_img = ? WHERE catid = ?" );
		$stmt->bind_param("ssi", $cattxt, $catimg, $c_id );
		if($stmt->execute())
		{
			$msg = "Category Updated Successfully";

		}
		else
		{
			$msg = "Something went Wrong";
		}
	}
	echo $msg;
?>
<?php
require_once("../class/connect.php");
require_once("../class/function.php");

date_default_timezone_set("Asia/Kolkata");
	$date = date('Y-m-d H:i:s');
	$cname = $_POST['cname'];
	$product_name_english = $_POST['product_name_english'];
	$product_name_marathi = $_POST['product_name_marathi'];
	$proPrice = $_POST['proPrice'];
	$proDiscountPrice = $_POST['proDiscountPrice'];
	$proUnit = $_POST['proUnit'];
	$proSize = $_POST['proSize'];
	$prodescpEnglish = $_POST['prodescpEnglish'];
	$prodescpMarathi = $_POST['prodescpMarathi'];
	if(isset($_FILES['files']['name']) && !empty($_FILES['files']['name']))
	{
	$filename1 = $_FILES['files']['name'];
	$photo = str_replace(' ', '_', $filename1);
	$photo_tmp = $_FILES['files']['tmp_name'];
	
	$image_info = getimagesize($_FILES['files']['tmp_name']);
	$image_width = $image_info[0];
	$image_height = $image_info[1];
	$allowed =  array('jpeg','png','jpg','JPEG','PNG','JPG');
	$ext = pathinfo($filename1, PATHINFO_EXTENSION);
	if(file_exists("../uploads/product_img/".$photo))
	{
		if(!in_array($ext,$allowed) ) 
		{
			$msg = 'Sorry, only JPEG, PNG and JPG files are allowed.';
		}
		else if($_FILES['files']['size'] > 512000)
		{
			$msg = "Image size should be less than 500kb";
		}
		else
		{
		$newimgname = renameimage($photo);
		move_uploaded_file($photo_tmp,"../uploads/product_img/".$newimgname);
		
		$files_path = "../uploads/product_img/".$newimgname;
		$files_path2 = "uploads/product_img/".$newimgname;
		$sql = "INSERT INTO products (category, name_english, name_marathi, final_price, discount_price, details_english, details_marathi, unit ,size, created_at, proimage) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
		if($stmt = $mysqli->prepare($sql)){
		$stmt->bind_param ( "sssiissssss", $cname, $product_name_english, $product_name_marathi, $proPrice, $proDiscountPrice,      $prodescpEnglish, $prodescpMarathi, $proUnit, $proSize, $date, $files_path2);
		if($stmt->execute())
		{
			$msg = "1";
		}
		else
		{
			$msg = $stmt->error;
		}
		} else {
			$error = $mysqli->errno . ' ' . $mysqli->error;
			echo $error; // 1054 Unknown column 'foo' in 'field list'
		}
		}
	}
	else
	{
		if(!in_array($ext,$allowed) ) 
		{
			$msg = 'Sorry, only JPEG, PNG and JPG files are allowed.';
		}
		else if($_FILES['files']['size'] > 512000)
		{
			$msg = "Image size should be less than 500kb";
		}
		else
		{
		move_uploaded_file($photo_tmp,"../uploads/product_img/".$photo);
				
		$files_path = "../uploads/product_img/".$photo;
		$files_path2 = "uploads/product_img/".$photo;
		
		
		$stmt = $mysqli->prepare("INSERT INTO products (category, name_english, name_marathi, final_price, discount_price, details_english, details_marathi, unit ,size, adminid, createdDate, proimage ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
		$stmt->bind_param ( "sssiissssiss", $cname, $product_name_english, $product_name_marathi, $proPrice, $proDiscountPrice, $prodescpEnglish, $prodescpMarathi, $proUnit, $proSize, $adminid, $date, $files_path2 );
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
	}
	else{
		$msg = "Please Select Product Image";
	}
echo $msg;
?>

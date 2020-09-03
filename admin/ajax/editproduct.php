<?php
require_once("../class/connect.php");
require_once("../class/function.php");

date_default_timezone_set("Asia/Kolkata");
$date = date('Y-m-d H:i:s');
$cname = $_POST['cname'];
$pid = $_POST['pid'];
$product_name_english = $_POST['product_name_english'];
$product_name_marathi = $_POST['product_name_marathi'];
$proPrice = $_POST['proPrice'];
$proDiscountPrice = $_POST['proDiscountPrice'];
$proUnit = $_POST['proUnit'];
$proSize = $_POST['proSize'];
$prodescpEnglish = $_POST['prodescpEnglish'];
$prodescpMarathi = $_POST['prodescpMarathi'];
	
	if(!empty($_FILES['file']['name'])) {
		$filename1 = $_FILES['file']['name'];
		$photo = str_replace(' ', '_', $filename1);
		$photo_tmp = $_FILES['file']['tmp_name'];
		$image_info = getimagesize($_FILES['file']['tmp_name']);
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
			else if($_FILES['file']['size'] > 512000)
			{
				$msg = "Image size should be less than 500kb";
			}
			else
			{
			$newimgname = renameimage($photo);
			move_uploaded_file($photo_tmp,"../uploads/product_img/".$newimgname);
			$imgpath = "uploads/product_img/".$newimgname;
			if(!empty($pimage)){
				$tpath = "../".$pimage;
				unlink($tpath);
			}
			
			$stmt = $mysqli->prepare("UPDATE products SET category = ?,  name_english = ?,  name_marathi = ?,  final_price = ?,  discount_price = ?,  details_english = ?,  details_marathi = ?,  unit  = ?, size = ?,  created_at = ?,  proimage = ? WHERE id = ?");
			$stmt->bind_param ( "sssiissssssi", $cname, $product_name_english, $product_name_marathi, $proPrice, $proDiscountPrice,      $prodescpEnglish, $prodescpMarathi, $proUnit, $proSize, $date, $imgpath, $pid );
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
			else if($_FILES['file']['size'] > 512000)
			{
				$msg = "Image size should be less than 500kb";
			}
			else
			{
			move_uploaded_file($photo_tmp,"../uploads/product_img/".$photo);
			$imgpath = "uploads/product_img/".$newimgname;
			if(!empty($pimage)){
				$tpath = "../".$pimage;
				unlink($tpath);
			}
			
			$stmt = $mysqli->prepare("UPDATE products SET category = ?,  name_english = ?,  name_marathi = ?,  final_price = ?,  discount_price = ?,  details_english = ?,  details_marathi = ?,  unit  = ?, size = ?,  created_at = ?,  proimage = ? WHERE id = ?");
			$stmt->bind_param ( "sssiissssssi", $cname, $product_name_english, $product_name_marathi, $proPrice, $proDiscountPrice,      $prodescpEnglish, $prodescpMarathi, $proUnit, $proSize, $date, $imgpath, $pid );
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
		$stmt = $mysqli->prepare("UPDATE products SET category = ?,  name_english = ?,  name_marathi = ?,  final_price = ?,  discount_price = ?,  details_english = ?,  details_marathi = ?,  unit  = ?, size = ?,  created_at = ? WHERE id = ?");
			$stmt->bind_param ( "sssiisssssi", $cname, $product_name_english, $product_name_marathi, $proPrice, $proDiscountPrice,      $prodescpEnglish, $prodescpMarathi, $proUnit, $proSize, $date, $pid );
		if($stmt->execute ())
		{
			$msg = "1";
		}
		else
		{
			$msg = "Something went wrong. Try again";
		}
	}
echo $msg;
?>

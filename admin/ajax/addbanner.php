<?php
require_once("../class/connect.php");
require_once("../class/function.php");

date_default_timezone_set("Asia/Kolkata");
$date = date('Y-m-d H:i:s');

if(empty($_FILES['banner']['name']))
{
	$msg = "Please upload Banner Image";
}
	else
	{
	
		$adminid = $_POST['adminid'];
		
		$image_info = getimagesize($_FILES['banner']['tmp_name']);
		$image_width = $image_info[0];
		$image_height = $image_info[1];
		// if ($image_width != 1920 and $image_height != 500)
		// {
			// $msg = "Please Upload image of size 1920 X 500";
		// }
		// else
		// {
				$filename = trim(addslashes($_FILES['banner']['name']));
				$imgslider = str_replace(' ', '_', $filename);
				$imgslider_tmp = $_FILES['banner']['tmp_name'];
				if(file_exists("../uploads/banner/".$imgslider))
				{
					$newimgname = renameimage($imgslider);
					move_uploaded_file($imgslider_tmp,"../uploads/banner/".$newimgname);
				
					$imgpath = "uploads/banner/".$newimgname;
					
					$stmt = $mysqli->prepare("INSERT INTO banner (adminid, imagepath, createdDate ) VALUES (?,?,?)");
					$stmt->bind_param ( "iss", $adminid, $imgpath, $date );
					if($stmt->execute ())
					{
						$msg = "1";
					}
					else
					{
						$msg = "Something went wrong";
					}	
				}
				else
				{
					move_uploaded_file($imgslider_tmp,"../uploads/banner/".$imgslider);
				
					$imgpath = "uploads/banner/".$imgslider;
					
					$stmt = $mysqli->prepare("INSERT INTO banner (adminid, imagepath, createdDate ) VALUES (?,?,?)");
					$stmt->bind_param ( "iss", $adminid, $imgpath, $date );
					if($stmt->execute ())
					{
						$msg = "1";
					}
					else
					{
						$msg = "Something went wrong";
					}
				}
		//}
	}

echo $msg;
?>
<?php
require_once("../class/connect.php");

$s_id = $_POST['s_id'];
$cat = $_POST['cat'];
$subcat = ucwords($_POST['subcat']);

$stmt = $mysqli->prepare("UPDATE subcategory SET catid = ?, subcatname = ? WHERE scatid = ?" );
$stmt->bind_param("isi", $cat, $subcat, $s_id );
if($stmt->execute())
{
	echo "Sub-Category Updated Successfully";

}
else
{
	echo "Something went Wrong";
}


?>
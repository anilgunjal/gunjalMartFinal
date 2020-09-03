<?php
require_once("../class/connect.php");
$dataset1 = "";
for($m = 1; $m <= 12; $m++ )
{
	$stmt = $mysqli->prepare("SELECT COUNT(distinct proid) as ptotal FROM products WHERE MONTH(createdDate) = ? ");
	$stmt->bind_param( 'i', $m );
	$cnt = 0;
	$stmt->execute ();
	$stmt->bind_result ( $ptotal );
	$stmt->store_result ();
	$row = $stmt->fetch ();
	$cnt++;
	/* if($m==12){
		$dataset1.= "[".$m.", ".$ptotal."]";
	}
	else {
		$dataset1.= "[".$m.", ".$ptotal."], ";
	} */
	
	if($m==12){
		$dataset1.=  $ptotal;
	}
	else {
		$dataset1.= $ptotal.", ";
	}
}


echo $dataset1;
?>
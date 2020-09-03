<?php
require_once("class/connect2.php");
//get search term
$searchTerm = $_GET['term'];
//get matched data from skills table
$query = $db->query("SELECT * FROM products WHERE proname LIKE '%".$searchTerm."%' LIMIT 10");
$data = array();
while ($row = $query->fetch_assoc()) {
    $data[] = $row['proname'];
}
//return json data
echo json_encode($data);
?>

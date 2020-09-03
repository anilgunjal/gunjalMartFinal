<?php
require_once("../class/connect.php");

$s_id = $_POST['s_id'];
$stmt = $mysqli->prepare("DELETE FROM subcategory WHERE scatid=?;");
$stmt->bind_param("i", $s_id);
if($stmt->execute())
{
	$stmtw = $mysqli->prepare("DELETE FROM specification WHERE scatid=?;");
	$stmtw->bind_param("i", $s_id);
	if($stmtw->execute())
	{
	
	$sql="SELECT id,proid,scatid,invoice FROM reviewstat WHERE scatid = '$s_id'";
	$stmte = $mysqli->prepare($sql);
	$stmte->execute();
	$stmte->bind_result($rid,$proid,$scatid, $invoice);
	$stmte->store_result();
	while($stmte->fetch())
	{
		unlink('../../'.$invoice);
		$stmtf = $mysqli->prepare("DELETE FROM reviewstat WHERE scatid = ?;");
		$stmtf->bind_param("i", $scatid);
		if($stmtf->execute())
		{
			$stmtg = $mysqli->prepare("DELETE FROM products WHERE scatid = ?;");
			$stmtg->bind_param("i", $scatid);
			if($stmtg->execute())
			{
				$stmth = $mysqli->prepare("DELETE FROM smiley WHERE proid = ?;");
				$stmth->bind_param("i", $proid);
				if($stmth->execute())
				{
					$stmtrr = $mysqli->prepare("DELETE FROM points WHERE reviewid = ?;");
					$stmtrr->bind_param("i", $rid);
					if($stmtrr->execute())
					{
						$msg ="1";
					}
					else
					{
						echo "Something is Wrong";
					}
				}
				else
				{
					echo "Something is Wrong";
				}
			}
			else
			{
				echo "Something is Wrong";
			}
		}
		else
		{
			echo "Something is Wrong";
		}		
	}
	}
	else
	{
		echo "Something is Wrong";
	}
	
}
else
{
	echo "Something is Wrong";
}

echo $msg;

?>
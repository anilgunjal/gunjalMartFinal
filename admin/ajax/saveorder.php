<?php
require_once("../class/connect.php");

$d_id = $_POST['d_id'];
$sc_id = $_POST['sc_id'];
$levelinput = $_POST['levelinput'];

$stmtz = $mysqli->prepare("SELECT level FROM specification WHERE spfid = ? ");
$stmtz->bind_param("i", $d_id );
$stmtz->execute();
$stmtz->bind_result( $oldlevel );
$stmtz->store_result();
$stmtz->fetch ();
	$stmts = $mysqli->prepare("SELECT spfid, specification, level FROM specification WHERE scatid ='$sc_id';");
	$stmts->execute ();
	$stmts->bind_result ( $id, $specification, $levelno );
	$stmts->store_result ();
	while($stmts->fetch ())
	{
		echo "level :".$levelno."/<br>";
			if($levelno == $levelinput && $levelinput < $oldlevel)
			{
				$x = $levelno + 1;
				$stmtu = $mysqli->prepare("UPDATE specification SET level = ? WHERE spfid = ?" );
				$stmtu->bind_param("ii",$x,$id);
				$stmtu->execute();
			}
			
			if($levelno > $oldlevel && $levelno <= $levelinput)
			{
				$x = $levelno - 1;
				$stmtu = $mysqli->prepare("UPDATE specification SET level = ? WHERE spfid = ?" );
				$stmtu->bind_param("ii",$x,$id);
				$stmtu->execute();
			}
			if($levelno > $levelinput)
			{
				if($levelno < $oldlevel)
				{
					$x = $levelno + 1;
					$stmtu = $mysqli->prepare("UPDATE specification SET level = ? WHERE spfid = ?" );
					$stmtu->bind_param("ii",$x,$id);
					$stmtu->execute();
				}
			}
			
		}
		$stmtii = $mysqli->prepare("UPDATE specification SET level = ? WHERE spfid = ?" );
		$stmtii->bind_param("ii", $levelinput, $d_id );
		if($stmtii->execute())
		{
			echo "Designation Updated Successfully";

		}
		else
		{
			echo "Something went Wrong";
		}
		
	

?>
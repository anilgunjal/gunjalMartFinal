<?php
require_once("../class/connect.php");
require_once("../class/function.php");

	date_default_timezone_set("Asia/Kolkata");
	$date = date('Y-m-d H:i:s');
	$status1 = $_POST['statusemp'];
	$comments = $_POST['comments'];
	$status = $_POST['status'];
	$adminid = $_POST['adminid'];
	$scatid = $_POST['scatid'];
	$catid = $_POST['catid'];
	$points = $_POST['points'];
	$revid = $_POST['revid'];
	$sellername = $_POST['sellername'];
	$admincomment = $_POST['admincomment'];
	$userid = $_POST['userid'];
	$invoice_date = $_POST['invoicedate'];
	$bill_number = $_POST['billnumber'];
	$page = $_POST['page'];
	$pname = $_POST['pname'];
	//$pnamecount = $_POST['pnamecount'];
	$temppid = $_POST['temppid'];
	$cnt = 0;
	
	$stmti = $mysqli->prepare("SELECT count(*) as ptotal FROM products WHERE proname = '$pname'");
	$stmti->execute();
	$stmti->bind_result($ptotal);
	$stmti->store_result();
	$stmti->fetch ();
	
	$stmtiii = $mysqli->prepare("SELECT reviewstat.userid, users.username, users.email FROM reviewstat INNER JOIN users ON reviewstat.userid = users.userid WHERE reviewstat.userid = '$userid'");
	$stmtiii->execute();
	$stmtiii->bind_result($ruserid,$username,$uemail);
	$stmtiii->store_result();
	$stmtiii->fetch ();
	
	if($ptotal==0){
		$stmtp = $mysqli->prepare("INSERT INTO products ( proname, catid, scatid, adminid, createdDate) VALUES (?,?,?,?,?)");
				$stmtp->bind_param ( "siiis", $pname, $catid, $scatid,$adminid, $date);
				if($stmtp->execute ())
				{
					$last_id = $stmtp->insert_id;
					$stmtpi = $mysqli->prepare("UPDATE reviewstat SET proid = ?, product_name = ?, sellername= ? , admincomment= ? WHERE id = ?");
					$stmtpi->bind_param ( "isssi", $last_id, $pname, $sellername, $admincomment,$revid );
					$stmtpi->execute ();
					$stmtpii = $mysqli->prepare("UPDATE smiley SET proid = ? WHERE rid = ?");
					$stmtpii->bind_param ( "ii", $last_id, $revid );
					$stmtpii->execute ();
					//$msg = "1";
					$cnt = 0;
				}
				else
				{
					$msg = "Something went wrong. Try again";
					$cnt = 1;
				}
	}
	else{
		$stmti = $mysqli->prepare("SELECT proid FROM products WHERE proname = '$pname'");
		$stmti->execute();
		$stmti->bind_result($proid);
		$stmti->store_result();
		$stmti->fetch ();
		$stmtpi = $mysqli->prepare("UPDATE reviewstat SET proid = ?, product_name = ?, sellername = ? , admincomment= ? WHERE id = ?");
		$stmtpi->bind_param ( "isssi", $proid, $pname, $sellername, $admincomment, $revid );
		$stmtpi->execute ();
		$stmtpii = $mysqli->prepare("UPDATE smiley SET proid = ? WHERE rid = ?");
		$stmtpii->bind_param ( "ii", $proid, $revid );
		$stmtpii->execute ();
		$cnt = 0;
		
	}
	if($cnt==0) {
		$stmt = $mysqli->prepare("UPDATE reviewstat SET comment = ?, status = ?, second_review = ?, upadminid = ?, updatedDate = ?, invoice_date = ?, billnumber = ?, sellername = ? , admincomment = ? WHERE id = ?");
		$stmt->bind_param ( "siiisssssi", $comments, $status, $status1, $adminid, $date, $invoice_date, $bill_number, $sellername, $admincomment, $revid );
		if($stmt->execute ())
		{
			$stmtp = $mysqli->prepare("SELECT count(*) as total FROM points WHERE userid = ? AND reviewid = ?");
			$stmtp->bind_param ( "ii", $userid, $revid );
			$stmtp->execute ();
			$stmtp->bind_result ( $total );
			$stmtp->store_result ();
			$stmtp->fetch ();
			if($total > 0){
				$stmti = $mysqli->prepare("UPDATE points SET status = ?  WHERE userid = ? AND reviewid = ?");
				$stmti->bind_param ( "iii", $status, $userid, $revid);
				if($stmti->execute ())
				{
					$msg = 1;
					if($status == "4")
					{	
						$header = "From: noreply@mails.napreview.com\r\n"; 
						$header .= "Reply-To: $uemail\r\n"; 
						$message = "Hello Mr./Miss $username \n\r";
						$message .= "You Review has been Rejected because of the Following Remark added by ADMIN : $admincomment.\r\n Please make changes in your review according to the review."; 
						$subject = "Review Status(www.napreview.com)";
						$message.="\n\n\n\r Powered by www.ideamagix.com\n\r We are always ready to serve you.";
						$message = wordwrap($message, 200);
						if(mail($uemail, $subject, $message, $header))
						{
							$msg = 1;
						}
						else
						{
							$msg = "mail not send";
						}
					}
					if($status == "1")
					{	
						$header1 = "From: noreply@mails.napreview.com\r\n"; 
						$header1 .= "Reply-To: $uemail\r\n"; 
						$message1 = "Hello Mr./Miss $username \n\r";
						$message1 .= "You Review has been Approved.\r\n Thank you for giving Review."; 
						$subject1 = "Review Status(www.napreview.com)";
						$message1.="\n\n\n\r Powered by www.ideamagix.com\n\r We are always ready to serve you.";
						$message1 = wordwrap($message1, 200);
						if(mail($uemail, $subject1, $message1, $header1))
						{
							$msg = 1;
						}
						else
						{
							$msg = "mail not send";
						}
					}
					
				}
				
			} else {
				$stmti = $mysqli->prepare("INSERT INTO points (userid, reviewid, points, status, adminid, createdDate ) VALUES (?,?,?,?,?,?)");
				$stmti->bind_param ( "iiiiis", $userid, $revid, $points, $status, $adminid, $date );
				if($stmti->execute ())
				{
					$msg = 1;
					if($status == "4")
					{	
						$header = "From: noreply@mails.napreview.com\r\n"; 
						$header .= "Reply-To: $uemail\r\n"; 
						$message = "Hello Mr./Miss $username \n\r";
						$message .= "You Review has been Rejected because of the Following Remark added by ADMIN : $admincomment.\r\n Please make changes in your review according to the review."; 
						$subject = "Review Status(www.napreview.com)";
						$message.="\n\n\n\r Powered by www.ideamagix.com\n\r We are always ready to serve you.";
						$message = wordwrap($message, 200);
						if(mail($uemail, $subject, $message, $header))
						{
							$msg = 1;
						}
						else
						{
							$msg = "mail not send";
						}
					}
					if($status == "1")
					{	
						$header1 = "From: noreply@mails.napreview.com\r\n"; 
						$header1 .= "Reply-To: $uemail\r\n"; 
						$message1 = "Hello Mr./Miss $username \n\r";
						$message1 .= "You Review has been Approved.\r\n Thank you for giving Review."; 
						$subject1 = "Review Status(www.napreview.com)";
						$message1.="\n\n\n\r Powered by www.ideamagix.com\n\r We are always ready to serve you.";
						$message1 = wordwrap($message1, 200);
						if(mail($uemail, $subject1, $message1, $header1))
						{
							$msg = 1;
						}
						else
						{
							$msg = "mail not send";
						}
					}
				}
			}
		}
		else
		{
			$msg = "Something went wrong. Try again";
		}
	}
	
	
echo $msg;
?>

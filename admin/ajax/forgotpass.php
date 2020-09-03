<?php
require_once("../class/connect.php");

$uemail = $_POST['resetemail'];

	$stmt = $mysqli->prepare("SELECT name, email FROM admins where email=?");
	$stmt->bind_param ( "s", $uemail );
	if($stmt->execute())
	{
		$stmt->bind_result ( $name, $email);
		$stmt->store_result ();
		$row = $stmt->fetch ();
		if(!empty($email))
		{
			$chars = "abcdefghijklmnpqrstuvwxyz123456789@";
			$pass = substr( str_shuffle( $chars ), 0, 8 );
			$password = md5($pass);
			$stmti = $mysqli->prepare("UPDATE admins SET password = ? WHERE email = ?");
			$stmti->bind_param ( "ss", $password, $uemail);
			if($stmti->execute())
			{
				$subject = "Your New Password for NAP Review Admin Panel";
				$header = "From: admin@napreview.com\r\n";
				$header .= "Reply-To: admin@napreview.com\r\n";
				$header .= "Content-type: text/html\r\n";
				$message = "Hello $name, <br/><br/>";
				$message.= "Your new password for <b>NAP Review Admin Panel</b> is <b>$pass</b> for E-mail: $uemail\n";
				$message.= "Please Login with this Password and don't forget to change it.\n\r";
				$message.= "Login on clicking this url : <a href='https://napreview.com/admin' target='_blank'>https://napreview.com/admin</a>";
				if(mail($email, $subject, $message, $header))
				{
					echo "1";
				}
				else
				{
					echo "Error...While sending Mail.";
				}

			}
			else
			{
				echo "Error...Something Went Wrong";
			}

		}
		else{

			echo "Email-Id does not match";
		}

	}
	else
	{
		echo "Email-Id is wrong";
	}

?>
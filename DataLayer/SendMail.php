<?php
include_once 'Mailer/class.phpmailer.php';

$companyMail = 'mohan@palmo.co';
$companyName = 'Palmo Industries';

function SendMails($toMailId, $toUserName, $userMobile, $userMessage)
{
	$res = SendThanksMail($toMailId, $toUserName);
	
	$resInquiry = SendInquiryMail($toMailId, $toUserName, $userMobile, $userMessage);
	
	return $res;
}


function GetSmtpMail()
{
	$mail = new PHPMailer;
	try
	{
		//Server settings
		$mail->SMTPDebug = 1;
		$mail->isSMTP(); 
		$mail->Host = 'localhost'; //smtp.office365.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = false;                               // Enable SMTP authentication
		$mail->Username = '1';                 // SMTP username
		$mail->Password = '1';                           // SMTP password
		//$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 25;            
	}
	catch(Exception $e)
	{
		echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
	}
	
	return $mail;
}


function SendThanksMail($toMailId, $toUserName)
{
	$userDetail = " <!DOCTYPE html><html><head>";
	$userDetail .= "<style></style>";
	$userDetail .= "</head><body>";
	$userDetail .= "<p><img src='http://www.palmo.co/images/logo8.jpg' style='width:215px;height:62px'></p>";
	$userDetail .= "<p>Dear " . $toUserName . ",</p>";
	$userDetail .= "<br><p>Thanks for reaching us and we will get back to you as soon as possible</p>";
	$userDetail .= "<br><br><p>Regards,<br>S Gopal<br>for Palmo Industries</p>";
	
	$userDetail .= "</body></html>";
	
	
	$mail = GetSmtpMail();
	
	$mail->SetFrom("mohan@palmo.co", "Palmo Industries");
	
	$mail->AddAddress($toMailId, $toUserName);
	$mail->AddReplyTo("mohan@palmo.co", "Reply-Palmo");
	$mail->IsHTML(true);
	
	/*
	//$mail->WordWrap = 50;                                 // set word wrap to 50 characters
	//$mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
	//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
	*/

	$mail->Subject = "Thanks for your inquiry";
	$mail->Body    = $userDetail;
	$mail->AltBody = "Thanks for reaching Palmo Industries and we would get back to you as soon as possible";

	
	if(!$mail->Send())
	{
		return "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
		exit;
	}
	
	return "Message has been sent";

}


function SendInquiryMail($toMailId, $toUserName, $userMobile, $userMessage)
{
	$userDetail = "<!DOCTYPE html><html><head>";
	$userDetail .= "<style>table, td, th {border: 1px solid #ddd;text-align: left;}table {border-collapse: collapse;width: 70%;}th, td {padding: 15px;}</style>";
	$userDetail .= "</head><body>";
	$userDetail .= "<br><p>We have received an inquiry from " . $toUserName . " as below</p><br>";
	$userDetail .= "<table>";
	$userDetail .= "<tr><td style='width:20%'>Name</td><td>" . $toUserName . "</td></tr>";
	$userDetail .= "<tr><td>Email</td><td>" . $toMailId . "</td></tr>";
	$userDetail .= "<tr><td>Mobile</td><td>" . $userMobile . "</td></tr>";
	$userDetail .= "<tr><td>Message</td><td>" . $userMessage . "</td></tr>";
	$userDetail .= "</table><br>";
	$userDetail .= "</body></html>";
	
	global $companyMail, $companyName; 
	$mail = GetSmtpMail();
	
	$mail->SetFrom($toMailId, $toUserName);
	
	$mail->AddAddress($companyMail, $companyName);
	$mail->AddReplyTo($toMailId, $toUserName);
	$mail->IsHTML(true);
	
	/*
	//$mail->WordWrap = 50;                                 // set word wrap to 50 characters
	//$mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
	//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
	*/

	$mail->Subject = "Received inquiry from " . $toUserName;
	$mail->Body    = $userDetail;
	$mail->AltBody = "Received inquiry from " . $toUserName;

	
	if(!$mail->Send())
	{
		return "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
		exit;
	}
	
	return "Message has been sent from SendInquiryMail ";
}

//$ret = SendMails('mohanaveluk@gmail.com', 'Mohanavelu Kumarasamy', '3343434', 'some message');

//echo "Status: " . $ret;

?>
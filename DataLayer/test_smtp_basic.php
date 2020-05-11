<html>
<head>
<title>PHPMailer - SMTP basic test with authentication</title>
</head>
<body>

<?php

//error_reporting(E_ALL);
error_reporting(E_STRICT);



date_default_timezone_set('America/Toronto');

require_once('Mailer/class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail             = new PHPMailer();

$body             = file_get_contents('contents.html');
$body             = preg_replace("[\]",'',$body);

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "localhost" ;//"smtp.office365.com"; // SMTP server
$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = false;                  // enable SMTP authentication
$mail->Port       = 25;                    // set the SMTP port for the GMAIL server
$mail->Username   = "mohan@palmo.co"; // SMTP account username
$mail->Password   = "blueBonnet@1";        // SMTP account password
$mail->SMTPSecure = '';  
$mail->SetFrom('mohan@palmo.co', 'First Last');

//$mail->AddReplyTo("mohan@palomo.co","First Last");

$mail->Subject    = "PHPMailer Test Subject via smtp, basic with authentication";

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$body    = "This is the HTML message body in bold!";
$mail->MsgHTML($body);

$address = "mohanaveluk@gmail.com";
$mail->AddAddress($address, "John Doe");

echo "Sending mail!";


if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}

?>


</body>
</html>

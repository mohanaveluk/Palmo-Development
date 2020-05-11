<?php

	include_once "SqlConnect.php";
	include_once "SendMail.php";
	
	$blank = '';
	$errors = false;
	$arr = [];
	
	
		
	header('Content-Type: application/json');

	
	
	if(isset($_POST["userName"])) // && !empty($_POST["userName"]))
	{
		$name = json_decode($_POST["userName"]);
		if(!ValidateName($name))
		{
			$arr["errorMessage"] = "Please enter valid name";
			$errors = true;
		}
	}
	else
		$name = $blank;
	

	if(isset($_POST["userEmail"])) // && !empty($_POST["userEmail"]))
	{
		$email = json_decode($_POST["userEmail"]);
		if(!ValidateEmail($email))
		{
			$arr["errorMessage"] = "Please enter valid email id";
			$errors = true;
		}
	}
	else
		$email = $blank;

	if(isset($_POST["userPhone"]) && !empty(json_decode($_POST["userPhone"])))
	{
		$mobile = json_decode($_POST["userPhone"]);
		if($mobile != '' && !ValidatePhone($mobile))
		{
			$arr["errorMessage"] = "Please enter valid mobile number";
			$errors = true;
		}
	}
	else
		$mobile = $blank;

	if(isset($_POST["userMessage"])) // && !empty($_POST["userMessage"]))
	{
		$message = json_decode($_POST["userMessage"]);
		$message = CleanText($message);
		/*$message = $_POST["userMessage"];*/
	}
	else
		$message = $blank;

	if($errors)
	{
		$arr["status"] = false;
		$arr["result"] = null;
		echo json_encode($arr);
		exit;
		return false;
	}

	if(empty($name) && empty($email))
	{
		$arr["status"] = false;
		$arr["errorMessage"] = 'Name and Email Id are required :' . $name ;
		$arr["result"] = null;
	}
	else
	{
		try
		{
			$sql = "insert into CONTACTUS (
					ContactName
					,ContactEmail
					,ContactMobile
					,ContactMessage) 
					values(	'" . $name . "', '" . $email . "', '" . $mobile . "', '" . $message . "');";
			
			//$arr["sql"] = $sql;
			
			$result = mysqli_query($conn, $sql);

			mysqli_close($conn);

			$mailStatus = SendMails($email, $name, $mobile, $message);
			
			$arr["mailStatus"] = $mailStatus;
			
			
			if($result)
			{
				$arr["status"] = true;
				$arr["errorMessage"] = null;
				$arr["result"] = $result;
			}
			else
			{
				$arr["status"] = false;
				$arr["errorMessage"] = "Unable to update inquiry data";
				$arr["result"] = $result;
			}
		}
		catch(Exception $e)
		{
			$arr["status"] = false;
			$arr["errorMessage"] = $e;
			$arr["result"] = null;
			mysqli_close($conn);
		}
	}
	
	echo json_encode($arr);

function CleanText($text)
{
	$text = trim($text);
	$text = stripcslashes($text);
	$text = htmlspecialchars($text);
		
	return $text;
}

function ValidateName($text)
{
	$text = CleanText($text);
	if(!preg_match("/^[a-zA-Z ]*$/", $text))
		return false;	
	return true;
}

function ValidateEmail($emailId)
{
	$email = CleanText($emailId);
	if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		return false;
	}
	return true;
}

function ValidatePhone($mobileNumber)
{
	//if(!preg_match('/^\(?\+?([0-9]{1,4})\)?[-\. ]?(\d{3})[-\. ]?([0-9]{7})$/', trim($mobileNumber))) {
	if(!preg_match('/^[0-9]{10}+$/', trim($mobileNumber))) {		
		 return false;
	} else {
		 return true;
}	
}


?>
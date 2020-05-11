<?php
//$servername = "localhost";
$servername = "35.222.107.95";
$username = "root";
$password = "blueBonnet@1";
$dbname   = "palmodata";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
	$conn = null;
}

?>
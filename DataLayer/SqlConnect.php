<?php
$servername = "localhost";
$username = "palmodata";
$password = "palmodata2018";
$dbname   = "PALMOAPR2018";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
	$conn = null;
}

?>
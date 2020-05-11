<?php
$servername = "35.222.107.95";
$username = "root";
$password = "blueBonnet@1";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
?>
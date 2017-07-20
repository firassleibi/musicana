<?php
	date_default_timezone_set('Asia/Dubai');
	define("HOST","localhost");
	define("DB","firassle_musicana");
	define("USER","firassle_musican");
	define("PASS","rockme/1991");
	$con=mysqli_connect(HOST,USER,PASS);
	if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
	mysqli_select_db($con,DB);
	mysqli_query($con,"set names utf8");
?>
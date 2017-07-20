g<?php

include("../include/db.php");
$userid=$_GET['userid'];
$type=$_GET['type'];
$token=$_GET['token'];
if($type==1)
	$table="owner";
else
	$table="singer";
mysqli_query($con,"update owner set token='' where token='$token'");
mysqli_query($con,"update singer set token='' where token='$token'");
mysqli_query($con,"update $table set token='$token' where id='$userid'");
mysqli_close($con);

?>
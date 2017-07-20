<?php
header('Content-Type: text/html; charset=utf-8');
	include("../include/db.php");
	if(isset($_GET['userid'])&&isset($_GET['message'])&&isset($_GET['type'])){
		$user_id=$_GET['userid'];
		$type=$_GET['type'];
		$message=urldecode ($_GET['message']);
		$date=date("Y-m-d H:i:s");
		if($type==1)
		mysqli_query($con,"insert into message set text='$message',rid=$user_id,rtype=3,notify=1,date_created='$date' ");
		else
		mysqli_query($con,"insert into message set text='$message',rid=$user_id,rtype=4,notify=1,date_created='$date' ");
		
		
		
	}
	else{
		header("location: /");
	}
?>
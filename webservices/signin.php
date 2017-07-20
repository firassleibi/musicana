<?php
	include("../include/db.php");
	if(isset($_GET['username'])&&isset($_GET['password'])&&isset($_GET['type'])){
		$username=$_GET['username'];
		$password=$_GET['password'];
		$type=$_GET['type'];
		if($type==1)
			$table="owner";
		else
			$table="singer";
		$q=mysqli_query($con,"select * from $table where username='$username' and password='$password'");
		if(mysqli_num_rows($q)>0){
			$l=[];
			$user_id=mysqli_fetch_assoc($q);
			array_push($l,$user_id);
			echo json_encode($l);
			
		}
		else
		echo "fail";
	}
	else{
		header("location: /");
	}
?>
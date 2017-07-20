<?php
header('Content-Type: text/html; charset=utf-8');
	include("../include/db.php");
	if(isset($_GET['userid'])&&isset($_GET['type'])){
		$userid=$_GET['userid'];
		$type=$_GET['type'];
		if($type==1)
			$table="owner";
		else
			$table="singer";
		$q=mysqli_query($con,"select image from $table where id='$userid'");
		if(mysqli_num_rows($q)>0){
			
		$l=[];
		while($row=mysqli_fetch_assoc($q)){

			array_push($l,$row);
			
			
		}
		echo json_encode($l);
		
		
	}
		else
			echo "null";
	}
	else{
		header("location: /");
	}
?>
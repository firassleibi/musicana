<?php
header('Content-Type: text/html; charset=utf-8');
	include("../include/db.php");
	if(isset($_GET['singerid'])){
		$year=date("Y");
		$singerid=$_GET['singerid'];
		$q=mysqli_query($con,"select * from videos where singer_id='$singerid'");
		if(mysqli_num_rows($q)>0){
			
		$l=[];
		while($row=mysqli_fetch_assoc($q)){

			array_push($l,$row);
			
			
		}
		echo json_encode($l);
		
		
	}
	}
	else{
		header("location: /");
	}
?>
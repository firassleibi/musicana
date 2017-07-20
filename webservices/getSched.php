<?php
header('Content-Type: text/html; charset=utf-8');
	include("../include/db.php");
	if(isset($_GET['userid'])){
		//$year=date("Y");
        $year=2017;
		$userid=$_GET['userid'];
		$l=[];
		for($i=1;$i<=12;$i++){
		$q=mysqli_query($con,"select * from month where year='$year' and month='$i' and singer_id=$userid");
		if(mysqli_num_rows($q)>0){
			$row=mysqli_fetch_assoc($q);
			$singer_q=mysqli_query($con,"select * from owner where id=".$row['owner_id']);
			$singer=mysqli_fetch_assoc($singer_q);
		}
		else{
			$singer=[];
			$singer["id"]=0;
		}
		array_push($l,$singer);
		}
		
		echo json_encode($l ,JSON_UNESCAPED_UNICODE);
		
	}
	else{
		header("location: /");
	}
?>
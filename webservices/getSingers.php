<?php
header('Content-Type: text/html; charset=utf-8');
	include("../include/db.php");
	if(isset($_GET['userid'])&&isset($_GET['type'])&&isset($_GET['month'])){
		//$year=date("Y");
        $year=2017;
		$userid=$_GET['userid'];
		$type=$_GET['type'];
		$month=$_GET['month'];
		$q=mysqli_query($con,"select * from view where year='$year' and month='$month' and owner_id=$userid  and (select type from singer where id=singer_id)=$type");
		if(mysqli_num_rows($q)>0){
			
		$l=[];
		while($row=mysqli_fetch_assoc($q)){
			$singer_q=mysqli_query($con,"select * from singer where id=".$row['singer_id']);
			$singer=mysqli_fetch_assoc($singer_q);
			array_push($l,$singer);
			
			
		}
		echo json_encode($l ,JSON_UNESCAPED_UNICODE);
		
		
	}
	}
	else{
		header("location: /");
	}
?>
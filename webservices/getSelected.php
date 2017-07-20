<?php
header('Content-Type: text/html; charset=utf-8');
	include("../include/db.php");
	if(isset($_GET['userid'])&&isset($_GET['month'])){
		//$year=date("Y");
        $year=2017;
		$userid=$_GET['userid'];
		$month=$_GET['month'];
		$l=[];
		for($i=1;$i<4;$i++){
		$q=mysqli_query($con,"select * from month where year='$year' and month='$month' and owner_id=$userid and (select type from singer where id=singer_id)=$i");
		if(mysqli_num_rows($q)>0){
			$row=mysqli_fetch_assoc($q);
			$singer_q=mysqli_query($con,"select * from singer where id=".$row['singer_id']." order by type");
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
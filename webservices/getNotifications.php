<?php
	include("../include/db.php");
	if(isset($_GET['userid'])&&isset($_GET['type'])){
		$userid=$_GET['userid'];
		$type=$_GET['type'];
		if($type==1){
			
		$q=mysqli_query($con,"select * from requests where owner_id=$userid and (status=2 or status=3) order by id desc");
		if(mysqli_num_rows($q)>0){
			
		$l=[];
		while($row=mysqli_fetch_assoc($q)){
			$singer_q=mysqli_query($con,"select * from singer where id=".$row['singer_id']);
			$singer=mysqli_fetch_assoc($singer_q);
			if($row['status']==2)
			$s="Your request for '".$singer['name']."' for month '".$row['month']."' has been accepted";
			else if($row['status']==3)
			$s="Your request for '".$singer['name']."' for month '".$row['month']."' has been rejected";
			
			 $z[] = array('z'=>$s );
			array_push($l,$z);
			
			
		}
            // Set seen =1
        mysqli_query($con,"update requests set seen='1' where owner_id=$userid and (status=2 or status=3) ");
		echo json_encode($z);
		
		
	}
		}
		else{
			
		$q=mysqli_query($con,"select * from requests where singer_id=$userid and status=2 order by id desc");
		if(mysqli_num_rows($q)>0){
			
		$l=[];
		while($row=mysqli_fetch_assoc($q)){
			$singer_q=mysqli_query($con,"select * from owner where id=".$row['owner_id']);
			$singer=mysqli_fetch_assoc($singer_q);
			if($row['status']==2)
			$s=$singer['username']."' has booked you for month '".$row['month'];
			
			
			 $z[] = array('z'=>$s );
			array_push($l,$z);
			
			
		}
            mysqli_query($con,"update requests set seen='1' where singer_id=$userid and status=2");
		echo json_encode($z);
		
		
	}
		}
	}
	else{
		header("location: /");
	}
?>
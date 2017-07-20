<?php
	include("../include/db.php");
	if(isset($_GET['userid'])&&isset($_GET['type'])){
		$userid=$_GET['userid'];
		$type=$_GET['type'];
		if($type==1)
		$q=mysqli_query($con,"select * from message where notify=1 and rid=$userid and rtype=1");
		else
		$q=mysqli_query($con,"select * from message where notify=1 and rid=$userid and rtype=2");
		if(mysqli_num_rows($q)>0){
			
		$l=[];
		while($row=mysqli_fetch_assoc($q)){
			$s="You recieved a new message";
			
			 $z[] = array('z'=>$s );
			array_push($l,$z);
			
			
		}
		echo json_encode($z);
		if($type==1)
		mysqli_query($con,"update message set notify=0 where rid=$userid and rtype=1");
		else
		mysqli_query($con,"update message set notify=0 where rid=$userid and rtype=2");
		
		
	}
	}
	else{
		header("location: /");
	}
?>
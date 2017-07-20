<?php
header('Content-Type: text/html; charset=utf-8');
	include("../include/db.php");
	if(isset($_GET['userid'])&&isset($_GET['type'])){
		$user_id=$_GET['userid'];
		$type=$_GET['type'];
		if($type==1){
			$query=mysqli_query($con,"select * from message where (rtype=1 or rtype=3) and rid=$user_id order by date_created asc");
			$l=[];
			while($message=mysqli_fetch_object($query)){
			$owner_q=mysqli_query($con,"select * from owner where id=$user_id");
			$owner=mysqli_fetch_object($owner_q);
			if($message->rtype==3)
				$sender=$owner->username;
			else
				$sender="Musicana :";
			$messagetext=$message->text."\n\n".$message->date_created;
			$z['name']=$sender;
			$z['text']=$messagetext;
			mysqli_query($con,"update message set seen='1' where (rtype=1 or rtype=3) and rid=$user_id order by date_created asc");
			array_push($l,$z);
			}
		}
		else{
			$query=mysqli_query($con,"select * from message where (rtype=2 or rtype=4) and rid=$user_id order by date_created asc");
			$l=[];
			while($message=mysqli_fetch_object($query)){
			$owner_q=mysqli_query($con,"select * from singer where id=$user_id");
			$owner=mysqli_fetch_object($owner_q);
			if($message->rtype==4)
				$sender=$owner->username;
			else
				$sender="Musicana :";
			$messagetext=$message->text."\n\n".$message->date_created;
			$z['name']=$sender;
			$z['text']=$messagetext;
			array_push($l,$z);
			mysqli_query($con,"update message set seen='1' where (rtype=2 or rtype=4) and rid=$user_id ");
			}
		}

		echo json_encode($l ,JSON_UNESCAPED_UNICODE);
		
		
	}
	else{
		header("location: /");
	}
?>
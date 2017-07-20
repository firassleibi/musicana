<?php
	session_start();
	if(@$_SESSION["logged"]!=1)
		header("location: login.php");
?>
<?php include("../include/db.php") ?>
<?php
	if(isset($_GET['id'])&&isset($_GET['oid'])){
		$oid=$_GET['oid'];
		$id=$_GET['id'];
		mysqli_query($con,"delete from month where  id=$id");
			header("location: add.php?id=$oid");
	}
	else{
		header("location:index.php");
	}
	
?>

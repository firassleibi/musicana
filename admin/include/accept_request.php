<?php
include("../../include/db.php");
$id=$_POST['id'];
mysqli_query($con,"update requests set status=2,notify=1,notifys=1 where id=$id");
$data_q=mysqli_query($con,"select * from requests where id=$id");
$data=mysqli_fetch_assoc($data_q);
$owner_id=$data['owner_id'];
$singer_id=$data['singer_id'];
$month=$data['month'];
//$year=date("Y");
$year=2017;
mysqli_query($con,"delete from view where singer_id=$singer_id and month=$month and year=$year");

$singer_q=mysqli_query($con,"select * from singer where id=$singer_id");
$singer=mysqli_fetch_assoc($singer_q);
$type=$singer['type'];
mysqli_query($con,"insert into month set singer_id=$singer_id ,year=$year,month=$month,owner_id=$owner_id, type=$type");

?>
<?php

include("../include/db.php");
$owner_id=$_GET['owner_id'];
$singer_id=$_GET['singer_id'];
$month=$_GET['month'];

mysqli_query($con,"insert into requests set status=1,owner_id=$owner_id,singer_id=$singer_id,month=$month,date_created='".date("Y-m-d H:i:s")."'");

?>
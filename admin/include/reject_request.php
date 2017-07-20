<?php
include("../../include/db.php");
$id=$_POST['id'];
mysqli_query($con,"update requests set status=3,notify=1 where id=$id");


?>
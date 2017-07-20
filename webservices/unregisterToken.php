g<?php

include("../include/db.php");

$token=$_GET['token'];
mysqli_query($con,"update owner set token='' where token='$token'");
mysqli_query($con,"update singer set token='' where token='$token'");


?>
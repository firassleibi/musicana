<?php
include("../include/db.php");
if(isset($_GET['userid'])&&isset($_GET['type'])){
    $userid=$_GET['userid'];
    $type=$_GET['type'];
    if($type==1){

        $q=mysqli_query($con,"select * from requests where owner_id=$userid and seen=0 and (status=2 or status=3) order by id desc");
        echo mysqli_num_rows($q);
    }
    else{

        $q=mysqli_query($con,"select * from requests where singer_id=$userid and seen=0 and status=2 order by id desc");
        echo mysqli_num_rows($q);
    }
}
else{
    header("location: /");
}
?>
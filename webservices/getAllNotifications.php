<?php
header('Content-Type: text/html; charset=utf-8');
include("../include/db.php");
if(isset($_GET['userid'])&&isset($_GET['type'])){
    $user_id=$_GET['userid'];
    $type=$_GET['type'];
    if($type==1){
        $query=mysqli_query($con,"select * from message where (rtype=1 or rtype=3) and rid=$user_id and seen=0 order by date_created asc");
        $z2=mysqli_num_rows($query);
        $q=mysqli_query($con,"select * from requests where owner_id=$user_id and seen=0 and (status=2 or status=3) order by id desc");
        $z1=mysqli_num_rows($q);

        echo ($z1+$z2);
    }
    else{
        $query=mysqli_query($con,"select * from message where (rtype=2 or rtype=4) and rid=$user_id and seen=0 order by date_created asc");
        $z2=mysqli_num_rows($query);
        $q=mysqli_query($con,"select * from requests where singer_id=$user_id and seen=0 and status=2 order by id desc");
        $z1=mysqli_num_rows($q);

        echo ($z1+$z2);
    }




}
else{
    header("location: /");
}
?>
<?php
header('Content-Type: text/html; charset=utf-8');
include("../include/db.php");
if(isset($_GET['userid'])&&isset($_GET['type'])){
    $user_id=$_GET['userid'];
    $type=$_GET['type'];
    if($type==1){
        $query=mysqli_query($con,"select * from message where (rtype=1 or rtype=3) and rid=$user_id and seen=0 order by date_created asc");
        echo mysqli_num_rows($query);
    }
    else{
        $query=mysqli_query($con,"select * from message where (rtype=2 or rtype=4) and rid=$user_id and seen=0 order by date_created asc");
        echo mysqli_num_rows($query);
    }




}
else{
    header("location: /");
}
?>
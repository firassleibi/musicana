<!doctype html>
<html lang="en" dir="rtl">
<? include("include/head.php") ?>

<?php
	$rid=$_GET['rid'];
	$rtype=$_GET['rtype'];
	if($rtype==1){
		$rquery=mysqli_query($con,"select * from owner where id=$rid");
		$robject=mysqli_fetch_object($rquery);
		$rname=$robject->username;
	}
	else{
		$rquery=mysqli_query($con,"select * from singer where id=$rid");
		$robject=mysqli_fetch_object($rquery);
		$rname=$robject->name;
	}
	if(isset($_POST['submit'])){
		$message=$_POST['message'];
		$date=date("Y-m-d H:i:s");
		mysqli_query($con,"insert into message set text='$message',rid=$rid,rtype=$rtype,notify=1,date_created='$date' ");

		
	}
	
?>
<body> 

<div class="wrapper">
	
    <? include("include/sidebar.php") ?> 
    <div class="main-panel">
        
         <? include("include/navbar.php") ?>            
                     
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">إرسال رسالة إلى <?= $rname?></h4>
                            </div>
                            <div class="content">
                            	<div id="message" style="height:300px !important;overflow-y:scroll;overflow-x:hidden;">
                            	<table  id="table" class="table table-striped table-bordered table-hover" data-toggle="table" data-cache="false"  data-search="true">
                              

                            <?
									if($rtype==1){
										$table="owner";
										$realtype="3";
									}
									else{
										$table="singer";
										$realtype="4";
									}
									mysqli_query($con,"update message set notify=0 where rtype=$realtype and rid=$rid");
									$query=mysqli_query($con,"select * from message where rtype=$rtype and rid=$rid UNION select * from message where rtype=$realtype and rid=$rid order by date_created asc");
									while($message=mysqli_fetch_object($query)){
									$owner_q=mysqli_query($con,"select * from $table where id=$rid");
									$owner=mysqli_fetch_object($owner_q);
									if($message->rtype==3||$message->rtype==4)
										$sender=$owner->username;
									else
										$sender="Musicana";
									echo "<tr>";
									echo "<td>$sender</td>";
									echo "<td>".$message->text."</td>";
									echo "<td>".$message->date_created."</td>";
									
					
									echo"</tr>";
									}
									
								
								
							?>
							</table>
                            </div>
                                <form method="post" enctype="multipart/form-data" onSubmit="return validate()">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>نص الرسالة:</label>
                                                <textarea style="height:150px" name="message" class="form-control" required></textarea>
                                            </div>        
                                        </div>
                                         
                                    </div>
                                   
                               

                                    <button name="submit" type="submit" class="btn btn-info btn-fill pull-right">إرسال</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                   
               
                </div>                    
            </div>
        </div>
        
        <? include("include/footer.php") ?> 
        
        
        
    </div>  
    
</div>


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
	
	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>
	
	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>
    
    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
	
    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js"></script>
	
	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>
    <script>
		function validate(){
			var a=document.getElementById("fileToUpload").value;
			if(a==""){
				alert("الرجاء اختيار صورة");
				return false;
			}
			
		
		}
		var objDiv = document.getElementById("message");
objDiv.scrollTop = objDiv.scrollHeight;
	</script>
    
</html>
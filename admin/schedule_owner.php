<?php
	session_start();
	if(@$_SESSION["logged"]!=1)
		header("location: login.php");
?>
<!doctype html>
<html lang="en" dir="rtl">
<? include("include/head.php") ?>

<?php
	$oid=$_GET['oid'];
	
	

	
	

	
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
                                <h4 class="title">جدول مواعيد الفنان</h4>
                            </div>
                            <div class="content">
                            
                                <table id="table" class="table table-striped table-bordered table-hover" data-toggle="table" data-cache="false"  data-search="true">
							<thead>
                            
							<tr>             
                            	<th data-align="center" data-valign="middle" data-field="video" >
									 الشهر
								</th> 
								
                                <th data-align="center" data-valign="middle" data-field="image" >
									 الحجز
								</th>                  
                                <th data-align="center" data-valign="middle" data-field="id">
									 الفنان
								</th>

							</tr>
							</thead>
                            <?
								for($i=1;$i<=12;$i++){
									echo "<tr>";
									echo "<td>$i</td>";
									$query=mysqli_query($con,"select * from month where owner_id='$oid' and year='2016' and month='$i'");
									
									if(mysqli_num_rows($query)>0){
										$query_o=mysqli_fetch_object($query);
										$reserved="<i class='fa fa-check text text-success'><i>";
										$singer_id=$query_o->singer_id;
										$singer_q=mysqli_query($con,"select * from singer where id=$singer_id");
										$singer=mysqli_fetch_object($singer_q);
										$singer_name=$singer->username;
									}
									else{
										$reserved="<i class='fa fa-remove'><i>";
										$singer_name="-";
									}
									echo"<td>$reserved</td>";
									echo"<td>$singer_name</td>";
									echo"</tr>";
								}
								
							?>
							</table>
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
    <script src="bootstraptable/bootstrap-table.js"></script>
    <script>
		function imageOperator(value, row, index) {
		return "<img width='100' style='border-radius:10px' height='100' src='img/uploads/"+value+"'/>";
	}
	function urlOperator(value, row, index) {
		return "<a target='_blank' href='"+value+"'>الرابط</a>";
	}
		function approvedOperator(value, row, index) {
		if(value==0)
			return "<a class='approve' href='javascript:void(0)' title='تفعيل'><i class='fa fa-close text text-danger' ></i></a>";
		else
			return "<a class='disapprove' href='javascript:void(0)' title='إيقاف تفعيل'><i class='fa fa-check text text-success' </i></a>";
	}
		function deleteOperator(value, row, index) {
			return "<a class='delete' href='javascript:void(0)' title='حذف'><i class='fa fa-trash' ></i></a>";
	}
		window.operateEvents = {
        'click .approve': function (e, value, row, index) {
            window.location="?id="+row['id']+"&type=approve";
        },
        'click .disapprove': function (e, value, row, index) {
				window.location="?id="+row['id']+"&type=disapprove";
        },
        'click .delete': function (e, value, row, index) {
            c=confirm('هل أنت متأكد أنك تريد حذف الصورة؟');
			if(c==true){
				window.location="?id="+row['id']+"&sid="+row['singer_id']+"&type=delete";
			}
        },
		'click .ban': function (e, value, row, index) {
				window.location="update.php?id="+row['id'];
        }
    };
	</script>
    
</html>
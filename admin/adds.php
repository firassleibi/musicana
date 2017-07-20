<?php
	session_start();
	if(@$_SESSION["logged"]!=1)
		header("location: login.php");
?>
<?php include("../include/db.php") ?>
<?php
	if(isset($_GET['month'])&&isset($_GET['year'])&&isset($_GET['oid'])&&isset($_GET['type'])){
		$oid=$_GET['oid'];
		$month=$_GET['month'];
		$year=$_GET['year'];
		$type=$_GET['type'];
		if(isset($_GET['sid'])){
			$sid=$_GET['sid'];
			mysqli_query($con,"insert into month set singer_id=$sid ,year=$year,month=$month, owner_id=$oid,type=$type");
			header("location: add.php?id=$oid");
		}
	}
	else{
		header("location:index.php");
	}
	
?>
<!doctype html>
<html lang="en" dir="rtl">
<? include("include/head.php") ?>

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
                                <h4 class="title">قائمة الفنانين</h4>
                            </div>
                            
                            <div class="content">
        
                                <table id="table" class="table table-striped table-bordered table-hover" data-toggle="table"  data-cache="false" data-pagination="true" data-search="true">
							<thead>
                            
							<tr>             
                            	
								<th data-align="center" data-valign="middle"  data-sortable="true">
									الصورة
								</th>
								<th data-align="center" data-valign="middle" >
									 الاسم
								</th>
                                <th data-align="center" data-valign="middle">
									السعر
								</th>
                                              
                                <th data-align="center" data-valign="middle" >
									إضافة 
								</th>

							</tr>
                           
							</thead>
                             <?
							 	$row=mysqli_query($con,"select * from singer where type=$type");
								while($result=mysqli_fetch_object($row)){
									
									echo "<tr>";
									echo "<td><img height=100 src='img/uploads/".$result->image."'/></td>";
									echo "<td>".$result->name."</td>";
									
									echo "<td>".$result->price."</td>";
									echo "<td><a href='adds.php?month=$month&year=$year&oid=$oid&type=$type&sid=".$result->id."'><i class='fa fa-plus text text-success'></i></a></td>";
									echo "</tr>";
									
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
		return "<img width='100' style='border-radius:10px' height='100' src='../img/uploads/"+value+"'/>";
	}
		function approvedOperator(value, row, index) {
		if(value==0)
			return "<a class='approve' href='javascript:void(0)' title='تفعيل'><i class='fa fa-close text text-danger' ></i></a>";
		else
			return "<a class='disapprove' href='javascript:void(0)' title='إيقاف تفعيل'><i class='fa fa-check text text-success' </i></a>";
	}
		function deleteOperator(value, row, index) {
			return "<a class='delete' href='javascript:void(0)' title='حذف'><i class='fa fa-trash' ></i></a>&nbsp;&nbsp;<a class='ban' href='javascript:void(0)' title='تعديل'><i class='fa fa-edit' ></i></a>&nbsp;&nbsp;<a class='schedule' href='javascript:void(0)' title='الحجوزات'><i class='fa fa-table' ></i></a>&nbsp;&nbsp;<a class='message' href='javascript:void(0)' title='إرسال رسالة'><i class='fa fa-envelope' ></i></a>&nbsp;&nbsp;<a class='add' href='javascript:void(0)' title='إضافة فنان'><i class='fa fa-plus' ></i></a>";
	}
		window.operateEvents = {
        'click .approve': function (e, value, row, index) {
            window.location="?id="+row['id']+"&type=approve";
        },
        'click .disapprove': function (e, value, row, index) {
				window.location="?id="+row['id']+"&type=disapprove";
        },
        'click .delete': function (e, value, row, index) {
            c=confirm('تأكيد الحذف؟');
			if(c==true){
				window.location="?id="+row['id']+"&type=delete";
			}
        },
		'click .ban': function (e, value, row, index) {
				window.location="update_owner.php?id="+row['id'];
        },
		'click .schedule': function (e, value, row, index) {
				window.location="schedule_owner.php?oid="+row['id'];
        },
		'click .message': function (e, value, row, index) {
				window.location="message.php?rid="+row['id']+"&rtype=1";
        }
		,
		'click .add': function (e, value, row, index) {
				window.location="add.php?id="+row['id'];
        }
    };
	function changeYear(year){
		window.location.href = "add.php?year="+year.value+"&id="+<?= $id?>;
	}
	</script>
    
</html>
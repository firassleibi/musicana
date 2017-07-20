<?php
	session_start();
	if(@$_SESSION["logged"]!=1)
		header("location: login.php");
?>
<!doctype html>
<html lang="en" dir="rtl">
<? include("include/head.php") ?>

<?php
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		if(isset($_GET['year']))
			$year=$_GET['year'];
		else
			$year=date("Y");
		

	}
	else{
		header("location:index.php");
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
                                <h4 class="title">إضافة فنان إلى جدول مواعيد مالك</h4>
                            </div>
                            
                            <div class="content">
                            <div class="row">
                            <div class="col-md-7" style="height:100%">
                            <span style="display:inline">السنة : </span>
                            <select onchange="changeYear(this);" class="form-control" style="display:inline !important;width:100px">
                            	<option <? if($year==2016)echo"selected"?>>2016</option>
                                <option <? if($year==2017)echo"selected"?>>2017</option>
                                <option <? if($year==2018)echo"selected"?>>2018</option>
                                <option <? if($year==2019)echo"selected"?>>2019</option>
                                <option <? if($year==2020)echo"selected"?>>2020</option>
                                <option <? if($year==2021)echo"selected"?>>2021</option>
                                <option <? if($year==2022)echo"selected"?>>2022</option>
                                <option <? if($year==2023)echo"selected"?>>2023</option>
                                <option <? if($year==2024)echo"selected"?>>2024</option>
                                <option <? if($year==2025)echo"selected"?>>2025</option>
                                <option <? if($year==2026)echo"selected"?>>2026</option>
                            </select>
                            </div>
                            </div>
                                <table id="table" class="table table-striped table-bordered table-hover" data-toggle="table"  data-cache="false" data-search="true">
							<thead>
                            
							<tr>             
                            	
								<th data-align="center" data-valign="middle"  data-sortable="true">
									الشهر
								</th>
								<th data-align="center" data-valign="middle" >
									 المطرب
								</th>
                                <th data-align="center" data-valign="middle">
									المطربة
								</th>
                                              
                                <th data-align="center" data-valign="middle" >
									الراقصة 
								</th>

							</tr>
                           
							</thead>
                             <?
								for($i=1;$i<=12;$i++){
									
									echo "<tr>";
									echo "<td>$i</td>";
									echo "<td>";
										$row=mysqli_query($con,"select * from month where owner_id=$id and year=$year and month=$i and type=1");
									if(mysqli_num_rows($row)==0){
										echo "<a href='adds.php?month=$i&year=$year&oid=$id&type=1'><i class='fa fa-plus'></i></a>";
									}
									else{
										$o=mysqli_fetch_object($row);
										$sid=$o->singer_id;
										$singer_q=mysqli_query($con,"select * from singer where id=$sid");
										$singer=mysqli_fetch_object($singer_q);
										echo "<img height='100' src='img/uploads/".$singer->image."'/><br/>";
										echo "<p style='margin-top:7px'>".$singer->name."</p>";
										echo "<a href='dels.php?id=".$o->id."&year=$year&oid=$id&sid=$sid'><i class='fa fa-trash text text-danger'></i></a>";
									}
									
									echo "</td>";
									
									echo "<td>";
									$row=mysqli_query($con,"select * from month where owner_id=$id and year=$year and month=$i and type=2");
									if(mysqli_num_rows($row)==0){
										echo "<a href='adds.php?month=$i&year=$year&oid=$id&type=2'><i class='fa fa-plus'></i></a>";
									}
									else{
										$o=mysqli_fetch_object($row);
										$sid=$o->singer_id;
										$singer_q=mysqli_query($con,"select * from singer where id=$sid");
										$singer=mysqli_fetch_object($singer_q);
										echo "<img height='100' src='img/uploads/".$singer->image."'/><br/>";
										echo "<p style='margin-top:7px'>".$singer->name."</p>";
										echo "<a href='dels.php?id=".$o->id."&year=$year&oid=$id&sid=$sid'><i class='fa fa-trash text text-danger'></i></a>";
									}
									echo "</td>";
									echo "<td>";
									$row=mysqli_query($con,"select * from month where owner_id=$id and year=$year and month=$i and type=3");
									if(mysqli_num_rows($row)==0){
										echo "<a href='adds.php?month=$i&year=$year&oid=$id&type=3'><i class='fa fa-plus'></i></a>";
									}
									else{
										$o=mysqli_fetch_object($row);
										$sid=$o->singer_id;
										$singer_q=mysqli_query($con,"select * from singer where id=$sid");
										$singer=mysqli_fetch_object($singer_q);
										echo "<img height='100' src='img/uploads/".$singer->image."'/><br/>";
										echo "<p style='margin-top:7px'>".$singer->name."</p>";
										echo "<a href='dels.php?id=".$o->id."&year=$year&oid=$id&sid=$sid'><i class='fa fa-trash text text-danger'></i></a>";
									}
									echo "</td>";
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
<?php
	session_start();
	if(@$_SESSION["logged"]!=1)
		header("location: login.php");
?>
<!doctype html>
<html lang="en" dir="rtl">
<? include("include/head.php") ?>

<?php
	$sid=$_GET['sid'];
	if(isset($_GET['year']))
			$year=$_GET['year'];
		else
			$year=date("Y");
	if(isset($_GET['type'])&& isset($_GET['id'])){
		$type=$_GET['type'];
		$id=$_GET['id'];
		if($type=="approve"){
			mysqli_query($con,"update projects set home=1 where id=$id");
		}
		else if($type=="disapprove"){
			mysqli_query($con,"update projects set home=0 where id=$id");
		}
		else if($type=="delete"){
			mysqli_query($con,"delete from videos where id=$id");			
		}
	}
	
	if(isset($_POST['submit'])){
		$video=$_POST['video'];
		$sid=$_POST['sid'];
		$image_type=explode(".",$_FILES["fileToUpload"]["name"]);
		$image=time().".". $image_type[count($image_type)-1];
		$target_dir = "img/uploads/";
		$target_file = $target_dir . $image;
		$uploadOk = 1;
		$foo = new Upload($_FILES['fileToUpload']); 
			if ($foo->uploaded) {
			   // save uploaded image with a new name,
			   // resized to 100px wide
			   $foo->file_new_name_body = time();
			   $foo->image_resize = true;
			   $foo->image_x = 600;
			   $foo->image_ratio_y = true;
			   $foo->Process($target_dir);
			   if ($foo->processed) {
				 $foo->Clean();
				 mysqli_query($con,"insert into videos set singer_id='$sid',image='$image',video='$video'");
			   } else {
				 echo 'error : ' . $foo->error;
			   } 
			}
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
                                <h4 class="title">جدول مواعيد الفنان</h4>
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
									 المالك
								</th>

							</tr>
							</thead>
                            <?
								for($i=1;$i<=12;$i++){
									echo "<tr>";
									echo "<td>$i</td>";
									$query=mysqli_query($con,"select * from month where singer_id='$sid' and year='$year' and month='$i'");
									
									if(mysqli_num_rows($query)>0){
										$query_o=mysqli_fetch_object($query);
										$reserved="<i class='fa fa-check text text-success'><i>";
										$owner_id=$query_o->owner_id;
										$owner_q=mysqli_query($con,"select * from owner where id=$owner_id");
										$owner=mysqli_fetch_object($owner_q);
										$owner_name=$owner->username;
									}
									else{
										$reserved="<i class='fa fa-remove'><i>";
										$owner_name="-";
									}
									echo"<td>$reserved</td>";
									echo"<td>$owner_name</td>";
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
	function changeYear(year){
		window.location.href = "schedule.php?year="+year.value+"&sid="+<?= $sid?>;
	}
	</script>
    
    
</html>
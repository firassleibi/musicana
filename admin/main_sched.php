<?php
	session_start();
	if(@$_SESSION["logged"]!=1)
		header("location: login.php");
?>
<!doctype html>
<html lang="en" dir="rtl">
<? include("include/head.php") ?>

<?php
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
                     
        <div class="content" style="padding:0 !important">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card fixedtable"  style="width:4250px">
                            <div class="header" style="padding-bottom:10px">
                                <h4 class="title" style="float:right">جدول المواعيد</h4>
                                <span style="float:right;margin-right:50px;padding-top:8px">السنة : </span>
                            <select onchange="changeYear(this);" class="form-control" style="display:inline !important;width:100px;float:right">
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
                            <div class="content" style="padding-top:5px"> 
                         
                                <table  id="table" class="table table-striped table-bordered table-hover" data-toggle="table" data-cache="false"  >
							<thead>
                            
							<tr>   
                            	<th data-align="center" data-valign="middle" >
									 المالك
								</th>  
                                <th data-align="center" data-valign="middle" >
									 الفنان
								</th>          
                            	<th data-align="center" data-valign="middle" >
									 1
								</th> 
								
                                <th data-align="center" data-valign="middle"  >
									 2
								</th>                  
                                <th data-align="center" data-valign="middle" >
									 3
								</th>
                                <th data-align="center" data-valign="middle" >
									 4
								</th> 
								
                                <th data-align="center" data-valign="middle"  >
									 5
								</th>                  
                                <th data-align="center" data-valign="middle" >
									 6
								</th>
                                <th data-align="center" data-valign="middle"  >
									 7
								</th> 
								
                                <th data-align="center" data-valign="middle">
									 8
								</th>                  
                                <th data-align="center" data-valign="middle" >
									 9
								</th>
                                <th data-align="center" data-valign="middle" >
									 10
								</th> 
								
                                <th data-align="center" data-valign="middle"  >
									 11
								</th>                  
                                <th data-align="center" data-valign="middle">
									 12
								</th>

							</tr>
							</thead>
                            <?
								$query=mysqli_query($con,"select * from owner");
								while($row=mysqli_fetch_object($query)){
									echo "<tr>";
									
									echo "<td><table border='0' cellpadding='0'><div style='min-width:200px;'>".$row->username."</div></table></td>";
									echo "<td>
											<div style='height:100px;min-width:200px;display: table;text-align:center;'>
												<span style='vertical-align:middle;display: table-cell;'>مطرب</span>
											</div><hr/>
											<div  style='height:100px;min-width:200px;display: table;text-align:center;'>
												<span style='vertical-align:middle;display: table-cell;'>مطربة</span>
											</div><hr/>
											<div  style='height:100px;min-width:200px;display: table;text-align:center;'>
												<span style='vertical-align:middle;display: table-cell;'>راقصة</span>
											</div></td>";
									for($i=1;$i<=12;$i++){
									//Month Row
									//fetch male singer
									$q=mysqli_query($con,"select * from month where owner_id='".$row->id."' and year='$year' and month='$i' and type=1");
									if(mysqli_num_rows($q)>0){
									
									$r=mysqli_fetch_object($q);
									$z=mysqli_query($con,"select * from singer where id='".$r->singer_id."' ");
										$r=mysqli_fetch_object($z);
										$name=$r->name;
										$image=$r->image;
										$singer="<img src='img/uploads/$image' height='70'/><br/>$name";
									}
									else{
										$singer="-";
									}
									//fetch female singer
									$q=mysqli_query($con,"select * from month where owner_id='".$row->id."' and year='$year' and month='$i' and type=2");
									if(mysqli_num_rows($q)>0){
									$r=mysqli_fetch_object($q);
									$z=mysqli_query($con,"select * from singer where id='".$r->singer_id."' ");
									
										$r=mysqli_fetch_object($z);
										$name=$r->name;
										$image=$r->image;
										$female="<img src='img/uploads/$image' height='70'/><br/>$name";
									}
									else{
										$female="-";
									}
									//fetch female dancer
									$q=mysqli_query($con,"select * from month where owner_id='".$row->id."' and year='$year' and month='$i' and type=3");
									if(mysqli_num_rows($q)>0){
									$r=mysqli_fetch_object($q);
									$z=mysqli_query($con,"select * from singer where id='".$r->singer_id."' ");
									
										$r=mysqli_fetch_object($z);
										$name=$r->name;
										$image=$r->image;
										$dancer="<img src='img/uploads/$image' height='70'/><br/>$name";
									}
									else{
										$dancer="-";
									}
									echo "<td>
											<div style='height:100px;min-width:200px;display: table;text-align:center;'>
												<span style='vertical-align:middle;display: table-cell;'>$singer</span>
											</div><hr/>
											<div  style='height:100px;min-width:200px;display: table;text-align:center;'>
												<span style='vertical-align:middle;display: table-cell;'>$female</span>
											</div><hr/>
											<div  style='height:100px;min-width:200px;display: table;text-align:center;'>
												<span style='vertical-align:middle;display: table-cell;'>$dancer</span>
											</div></td>";
									//End Month Row
									}
									
									
									
									
									
	
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
		window.location.href = "main_sched.php?year="+year.value;
	}
	</script>
    
    
</html>
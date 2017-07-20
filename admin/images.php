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
			mysqli_query($con,"delete from images where id=$id");			
		}
	}
	
	if(isset($_POST['submit'])){
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
				 mysqli_query($con,"insert into images set singer_id='$sid',image='$image'");
			   } else {
				 echo 'error : ' . $foo->error;
			   } 
			}
	}
	
	$query=mysqli_query($con,"select * from images where singer_id='$sid'");
	while($row=mysqli_fetch_assoc($query)){
		$l[]=$row;
	}
	$json=json_encode($l);
	file_put_contents("json/images.json",$json);
	
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
                                <h4 class="title">قائمة صور الفنان</h4>
                            </div>
                            <div class="content">
                            <form method="post" enctype="multipart/form-data">
                            	<div class="row">
                                	<div class="col-md-6">
                                	<label>إضافة صورة</label>
                                    </div>
                                </div>
                                <div class="row">
                                	<div class="col-md-6">
                                	<input name="fileToUpload" type="file" class="form-control" accept="image/*" required/>
                                    <input type="hidden" name="sid" value="<?= $_GET['sid'];?>"/>
                                    </div>
                                    <div class="col-md-6">
                                	<input name="submit" type="submit" class="btn btn-info" value="إضافة صورة"/>
                                   
                                    </div>
                                </div>
                            </form>
                                <table id="table" class="table table-striped table-bordered table-hover" data-toggle="table" data-url="json/images.json"  data-cache="false" data-pagination="true" data-search="true">
							<thead>
                            
							<tr>             
                            	
								
                                <th data-align="center" data-valign="middle" data-field="image" data-formatter="imageOperator">
									 الصورة
								</th>                  
                                <th data-align="center" data-valign="middle" data-field="id" data-formatter="deleteOperator" data-events="operateEvents">
									 
								</th>

							</tr>
							</thead>
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
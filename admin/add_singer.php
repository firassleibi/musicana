<!doctype html>
<html lang="en" dir="rtl">
<? include("include/head.php") ?>

<?php
	if(isset($_POST['submit'])){
		$username=$_POST['username'];
		$password=$_POST['password'];
		$name=$_POST['name'];
		$price=$_POST['price'];
		$type=$_POST['type'];
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
   } else {
     echo 'error : ' . $foo->error;
   } 
} 


		mysqli_query($con,"insert into singer set username='$username',password='$password',name='$name',price='$price',type='$type',image='$image'");
		
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
                                <h4 class="title">إضافة فنان</h4>
                            </div>
                            <div class="content">
                                <form method="post" enctype="multipart/form-data" onSubmit="return validate()">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>اسم المستخدم</label>
                                                <input name="username" type="text" class="form-control" required>
                                            </div>        
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>كلمة المرور</label>
                                                <input name="password" type="text" class="form-control" required>
                                            </div>        
                                        </div>        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>السعر</label>
                                                <input name="price" type="text" class="form-control">
                                            </div>        
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>اسم الظهور</label>
                                                <input name="name" type="text" class="form-control">
                                            </div>        
                                        </div>        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>نوع الفنان</label>
                                                <select name="type" type="text" class="form-control">
                                                	<option value="1">مطرب</option>
                                                    <option value="2">مطربة</option>
                                                    <option value="3">راقصة</option>
                                                    
                                                </select>
                                            </div>        
                                        </div> 
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>الصورة الرئيسية</label>
                                                <input name="fileToUpload" type="file" accept="image/*" class="form-control">
                                            </div>        
                                        </div>        
                                    </div>
                               

                                    <button name="submit" type="submit" class="btn btn-info btn-fill pull-right">إضافة</button>
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
	</script>
    
</html>
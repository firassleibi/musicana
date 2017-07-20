<!doctype html>
<html lang="en" dir="rtl">
<? include("include/head.php") ?>
<?php
	//error_reporting(0);
	$id=$_GET['id'];
	
	if(isset($_POST['submit'])){
		$username=$_POST['username'];
		$password=$_POST['password'];
		$number1=$_POST['number1'];
		$number2=htmlspecialchars($_POST['number2']);
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
	 $newimage=",image='$image'";
   } else {
	   $newimage="";
     echo 'error : ' . $foo->error;
   } 
} 
else{
	$newimage="";
}

		mysqli_query($con,"update owner set username='$username',password='$password',phone1='$number1',phone2='$number2'$newimage where id=$id");

		$msg="<div class='col-md-12 alert alert-success'>تم التعديل بنجاح</div>";
	}
	$owner_q=mysqli_query($con,"select * from owner where id=$id");
	$owner=mysqli_fetch_object($owner_q);
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
                                <h4 class="title">إضافة مالك</h4>
                            </div>
                            <div class="content">
                            <?= $msg?>
                                <form method="post" enctype="multipart/form-data" onSubmit="return validate()">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>اسم المالك</label>
                                                <input name="username" type="text" class="form-control" value="<?= $owner->username?>" required>
                                            </div>        
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>كلمة المرور</label>
                                                <input  name="password" value="<?= $owner->password?>" type="text" class="form-control" required>
                                            </div>        
                                        </div>        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>رقم 1</label>
                                                <input value="<?= $owner->phone1?>" name="number1" type="text" class="form-control">
                                            </div>        
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>رقم 2</label>
                                                <input value="<?= $owner->phone2?>" name="number2" type="text" class="form-control">
                                            </div>        
                                        </div>        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>الصورة الرئيسية</label>
                                                    <input name="fileToUpload" type="file" accept="image/*" class="form-control">
                                                </div>        
                                        </div> 
                                    </div>
                               

                                    <button name="submit" type="submit" class="btn btn-info btn-fill pull-right">تعديل</button>
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
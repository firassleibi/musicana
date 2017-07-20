<!doctype html>
<html lang="en" dir="rtl">
<? include("include/head.php") ?>

<?php
	if(isset($_POST['submit'])){
		$title_ar=$_POST['title_ar'];
		$title_en=$_POST['title_en'];
		$content_ar=htmlspecialchars($_POST['content_ar']);
		$content_en=htmlspecialchars($_POST['content_en']);
		$image_type=explode(".",$_FILES["fileToUpload"]["name"]);
		$image=time().".". $image_type[count($image_type)-1];
		$target_dir = "../img/uploads/";
		$target_file = $target_dir . $image;
		$uploadOk = 1;
		/*
		// Check if image file is a actual image or fake image
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
		// Check if file already exists
		if (file_exists($target_file)) {
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		}		
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				
			} else {
				echo "Sorry, there was an error uploading your file.";
			}}*/
		$foo = new Upload($_FILES['fileToUpload']); 
if ($foo->uploaded) {
   // save uploaded image with a new name,
   // resized to 100px wide
   $foo->file_new_name_body = time();
   $foo->image_resize = true;
   $foo->image_x = 1000;
   $foo->image_ratio_y = true;
   $foo->Process($target_dir);
   if ($foo->processed) {
     $foo->Clean();
   } else {
     echo 'error : ' . $foo->error;
   } 
} 
		$date = date('Y-m-d');
		mysqli_query($con,"insert into news set 	title_ar='$title_ar',title_en='$title_en',content_ar='$content_ar',content_en='$content_en',image='$image',date_created='$date'");
		
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
                                <h4 class="title">إضافة خبر</h4>
                            </div>
                            <div class="content">
                                <form method="post" enctype="multipart/form-data" onSubmit="return validate()">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>عنوان الخبر (انكليزي)</label>
                                                <input name="title_en" type="text" class="form-control" placeholder="عنوان المشروع (انكليزي)">
                                            </div>        
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>عنوان الخبر (عربي)</label>
                                                <input name="title_ar" type="text" class="form-control" placeholder="عنوان المشروع (عربي)">
                                            </div>        
                                        </div>        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>الصورة</label>
                                                <input name="fileToUpload" id="fileToUpload" class="form-control" type="file" accept="image/*" placeholder="الصورة"/>
                                            </div>        
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>الخبر (عربي)</label>
                                                <textarea name="content_ar" rows="5" class="form-control" placeholder="شرح المشروع"></textarea>
                                            </div>        
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>الخبر (انكليزي)</label>
                                                <textarea name="content_en" rows="5" class="form-control" placeholder="Project Description"></textarea>
                                            </div>        
                                        </div>
                                    </div>
                               

                                    <button name="submit" type="submit" class="btn btn-info btn-fill pull-right">إضافة مشروع</button>
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
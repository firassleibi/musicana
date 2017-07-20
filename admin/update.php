<?php
	session_start();
	if(@$_SESSION["logged"]!=1)
		header("location: login.php");
?>
<!doctype html>
<html lang="en" dir="rtl">
<? include("include/head.php") ?>

<?php
	
	if(isset($_POST['submit'])){
		$id=$_GET['id'];
		$type=$_POST['type'];
		$title_ar=$_POST['title_ar'];
		$title_en=$_POST['title_en'];
		$content_ar=htmlspecialchars($_POST['content_ar']);
		$content_en=htmlspecialchars($_POST['content_en']);
		mysqli_query($con,"update projects set type='$type',title_ar='$title_ar',title_en='$title_en',content_ar='$content_ar',content_en='$content_en' where id=$id");
		
	}
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		$query=mysqli_query($con,"select * from projects where id=$id");
		$project=mysqli_fetch_object($query);
	}
	else
		header("location: index.php");
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
                                <h4 class="title">إضافة مشروع</h4>
                            </div>
                            <div class="content">
                                <form method="post" enctype="multipart/form-data" onSubmit="return validate()">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>عنوان المشروع (انكليزي)</label>
                                                <input name="title_en" type="text" class="form-control" placeholder="عنوان المشروع (انكليزي)" value="<?= $project->title_en ?>">
                                            </div>        
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>عنوان المشروع (عربي)</label>
                                                <input name="title_ar" type="text" class="form-control" placeholder="عنوان المشروع (عربي)" value="<?= $project->title_ar ?>">
                                            </div>        
                                        </div>        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>التبويب</label>
                                                <select name="type" type="text" class="form-control" placeholder="التبويب">
                                                	<option value="villas" <? if($project->type=='villas') echo "selected" ?>>Villas</option>
                                                    <option value="industrial" <? if($project->type=='industrial') echo "selected" ?>>Industrial</option>
                                                    <option value="mosques" <? if($project->type=='mosques') echo "selected" ?>>Mosques</option>
                                                    <option value="towers" <? if($project->type=='towers') echo "selected" ?>>Towers</option>
                                                    <option value="adminbuilding" <? if($project->type=='adminbuilding') echo "selected" ?>>Admin Building</option>
                                                    <option value="investments" <? if($project->type=='investments') echo "selected" ?>>Investments</option>
                                                    
                                                </select>
                                            </div>        
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>الصورة</label><br/>
                                                <img width="200px" src="../img/uploads/<?= $project->image ?>" />
                                            </div>        
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>شرح (عربي)</label>
                                                <textarea name="content_ar" rows="5" class="form-control" placeholder="شرح المشروع"><?=  htmlspecialchars_decode($project->content_ar) ?></textarea>
                                            </div>        
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>شرح (انكليزي)</label>
                                                <textarea name="content_en" rows="5" class="form-control" placeholder="Project Description"><?=  htmlspecialchars_decode($project->content_en) ?></textarea>
                                            </div>        
                                        </div>
                                    </div>
                                    

                                    <button name="submit" type="submit" class="btn btn-info btn-fill pull-right">تعديل المشروع</button>
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
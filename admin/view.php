<?php
	session_start();
	if(@$_SESSION["logged"]!=1)
		header("location: login.php");
?>
<!doctype html>
<html lang="en" dir="rtl">
<? include("include/head.php") ?>

<?php
	$oid=$_GET['id'];
	if(isset($_GET['year']))
			$year=$_GET['year'];
		else
			$year=date("Y");
	if(isset($_GET['month']))
			$month=$_GET['month'];
		else
			$month=date("m");
	if(isset($_POST['submit'])){
		mysqli_query($con,"delete from view where owner_id=$oid and month=$month and year=$year");
		if(isset($_POST['check_list']))
		foreach($_POST['check_list'] as $check) {
           mysqli_query($con,"insert into view  set owner_id=$oid , singer_id=$check, month=$month,year=$year ");
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
                                <h4 class="title">قائمة الظهور للمالك</h4>
                            </div>
                            <div class="content">
                            <div class="row">
                            <div class="col-md-7" style="height:100%">
                            <span style="display:inline">السنة : </span>
                            <select id="year" onchange="changeYear(this);" class="form-control" style="display:inline !important;width:100px">
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
                            
                            <span style="margin-top:10px;margin-right:20px;display:inline">الشهر </span>
                            <select id="month" onchange="changeYear(this);" class="form-control" style="display:inline !important;width:100px">
                            	<option <? if($month==1)echo"selected"?>>1</option>
                                <option <? if($month==2)echo"selected"?>>2</option>
                                <option <? if($month==3)echo"selected"?>>3</option>
                                <option <? if($month==4)echo"selected"?>>4</option>
                                <option <? if($month==5)echo"selected"?>>5</option>
                                <option <? if($month==6)echo"selected"?>>6</option>
                                <option <? if($month==7)echo"selected"?>>7</option>
                                <option <? if($month==8)echo"selected"?>>8</option>
                                <option <? if($month==9)echo"selected"?>>9</option>
                                <option <? if($month==10)echo"selected"?>>10</option>
                                <option <? if($month==11)echo"selected"?>>11</option>
                                <option <? if($month==12)echo"selected"?>>12</option>
                            </select>
                            </div>
                            
                            </div>
                            
                            <form method="post">
                                <table id="table" class="table table-striped table-bordered table-hover" data-toggle="table" data-cache="false"  data-search="true">
							<thead>
                            
							<tr>             
                            	<th data-align="center" data-valign="middle"  >
									 النوع
								</th> 
								
                                <th data-align="center" data-valign="middle" >
									 الصورة
								</th>                  
                                <th data-align="center" data-valign="middle" >
									 الاسم
								</th>
                                <th data-align="center" data-valign="middle" >
									 تحديد
								</th>

							</tr>
							</thead>
                            
                            <?
									
									$query=mysqli_query($con,"select * from singer order by type");
									
									if(mysqli_num_rows($query)>0){
										while($singer=mysqli_fetch_object($query)){
										echo "<tr>";
										switch($singer->type){
											case 1: $type="مطرب";break;
											case 2: $type="مطربة";break;
											case 3: $type="راقصة";break;
										}
										$image=$singer->image;
										echo "<td>$type</td>";
										echo "<td><img src='img/uploads/$image' width='50'/></td>";
										echo "<td>".$singer->name."</td>";
										$q=mysqli_query($con,"select * from view where month=$month and year=$year and owner_id=$oid and singer_id=".$singer->id);
										if(mysqli_num_rows($q)>0)
											$checked="checked";
										else
											$checked="";
										echo "<td><input value='".$singer->id."' name='check_list[]' type='checkbox' $checked/></td>";
										echo"</tr>";
									}
									
									
								}
								
							?>
                            
							</table>
                            <input name="submit" value="حفظ" class="btn btn-success" type="submit"/>
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
	function changeYear(){
		year=document.getElementById("year");
		month=document.getElementById("month");
		window.location.href = "view.php?year="+year.value+"&month="+month.value+"&id="+<?= $oid?>;
	}
	
	</script>
    
    
</html>
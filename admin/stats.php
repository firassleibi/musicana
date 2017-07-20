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
                                <h4 class="title">الطلبات الجديدة</h4>
                            </div>
                            <div class="content">
                            	<table class="table table-hover table-striped table-bordered">
                                <?php
									$requests_q=mysqli_query($con,"select * from requests where status=1 order by date_created desc");
									while($requests=mysqli_fetch_object($requests_q)){
										$singer_q=mysqli_query($con,"select * from singer where id=".$requests->singer_id);
										$singer=mysqli_fetch_object($singer_q);
										$owner_q=mysqli_query($con,"select * from owner where id=".$requests->owner_id);
										$owner=mysqli_fetch_object($owner_q);
									echo "<tr>
											<td>قام المالك ".$owner->username." بطلب الفنان ".$singer->name." للشهر ".$requests->month."</td>
											<td>".$requests->date_created."</td>
											<td><button class='btn btn-success' onclick='accept(".$requests->id.")'>قبول</button>
                                        <button class='btn btn-fail' onClick='reject(".$requests->id.")'>رفض</button></td>
										   </tr>";
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
    <script>
		function validate(){
			var a=document.getElementById("fileToUpload").value;
			if(a==""){
				alert("الرجاء اختيار صورة");
				return false;
			}
			
		
		}
		function accept(request_id){
			$.post( 
                  "include/accept_request.php",
                  { id: request_id },
                  function(data) {
                    location.reload();
                  }
               );
		}
		function reject(request_id){
			$.post( 
                  "include/reject_request.php",
                  { id: request_id },
                  function(data) {
                    location.reload();
                  }
               );
		}
	</script>
    
</html>
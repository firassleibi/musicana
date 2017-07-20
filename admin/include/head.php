<?php include("../include/db.php") ?>
<?php include("include/class.upload.php") ?>
<?php
$new_q=mysqli_query($con,"select count(*) as count from message where notify=1 and (rtype=3 or rtype=4) ");
									$new=mysqli_fetch_object($new_q);
								
									?>
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>ميوزيكانا - لوحة التحكم</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    
    <link type="text/css" rel="stylesheet" href="bootstraptable/bootstrap-table.css" />
    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap-rtl.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>
    
    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>
    
    
        <style>
.fixedtable table tbody,.fixedtable table thead
{
    display: block;
	
}

.fixedtable table tbody 
{
   overflow: auto;
   
   overflow-x:hidden;
   height: 500px;
}



.fixedtable th,.fixedtable td
{
    min-width: 300px !important;
}
		</style>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/kaka" type="text/css"/>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
</head>
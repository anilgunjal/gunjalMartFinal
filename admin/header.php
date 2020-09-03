<?php
require_once("class/connect.php");
require_once("class/function.php");
require_once("access.php");
if(isset($_SESSION['SESS_ADMINID']))
{
	$admin_id = $_SESSION['SESS_ADMINID'];
	$status = $_SESSION['SESS_ADMSTAT'];
}
$stmth = $mysqli->prepare("SELECT adminid, name, email, contact, address, dob, avatar, status FROM admins WHERE adminid =?;");
$stmth->bind_param("i", $admin_id);
$stmth->execute ();
$stmth->bind_result ( $adminid, $name, $email, $contact, $address, $dob, $avatar, $statusemp );
$stmth->store_result ();
$rowh = $stmth->fetch ();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Integral - A fully responsive, HTML5 based admin template">
<meta name="keywords" content="Responsive, Web Application, HTML5, Admin Template, business, professional, Integral, web design, CSS3">
<title>NAP Review | Admin Panel</title>
<!-- Site favicon -->
<link rel='shortcut icon' type='image/x-icon' href='images/favicon.ico' />
<!-- /site favicon -->

<!-- Entypo font stylesheet -->
<link href="css/entypo.css" rel="stylesheet">
<!-- /entypo font stylesheet -->

<!-- Font awesome stylesheet -->
<link href="css/font-awesome.min.css" rel="stylesheet">
<!-- /font awesome stylesheet -->

<!-- Bootstrap stylesheet min version -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- /bootstrap stylesheet min version -->

<!-- Integral core stylesheet -->
<link href="css/integral-core.css" rel="stylesheet">
<!-- /integral core stylesheet -->

<!--Jvector Map-->
<link href="css/integral-forms.css" rel="stylesheet">
<link href="plugins/jvectormap/css/jquery-jvectormap-2.0.3.css" rel="stylesheet">
<link href="plugins/datepicker/css/bootstrap-datepicker.css" rel="stylesheet">
<link href="plugins/datatables/css/jquery.dataTables.css" rel="stylesheet">
<link href="plugins/datatables/extensions/Buttons/css/buttons.dataTables.css" rel="stylesheet">

<!--Smiley-->
<!--link rel="stylesheet" href="css/smiley.css"-->
<link rel="stylesheet" href="css/fontello.css">
<link rel="stylesheet" href="css/fontello-codes.css">
<link rel="stylesheet" href="css/animation.css">
<link rel="stylesheet" href="css/fontello-embedded.css">
<link rel="stylesheet" href="css/fontello-ie7.css">
<link rel="stylesheet" href="css/fontello-ie7-codes.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="js/smileyfunction.js">
<style>

</style>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
<![endif]-->

<!--[if lte IE 8]>
	<script src="plugins/flot/js/excanvas.min.js"></script>
<![endif]-->
<script>
	function formsub(id)
	{
		$("#viewform"+id).submit();
	}
</script>
</head>
<body>

<!-- Loader Backdrop -->
	<!--div class="loader-backdrop">
		<div class="loader">
			<div class="bounce-1"></div>
			<div class="bounce-2"></div>
		</div>
	</div-->
<!-- loader backgrop -->
	
<!-- Page container -->
<div class="page-container">

	<!-- Page Sidebar -->
	<div class="page-sidebar">
	
		<!-- Site header  -->
		<header class="site-header">
		  <div class="site-logo"><a href="index.php"><img src="images/napreview_logo.png" alt="NAP Review" title="NAP Review" width="142" height="32"></a></div>
		  <div class="sidebar-collapse hidden-xs"><a class="sidebar-collapse-icon" href="index.php#"><i class="icon-menu"></i></a></div>
		  <div class="sidebar-mobile-menu visible-xs"><a data-target="#side-nav" data-toggle="collapse" class="mobile-menu-icon" href="index.php#"><i class="icon-menu"></i></a></div>
		</header>
		<!-- /site header -->
		
		<!-- Main navigation -->
		<ul id="side-nav" class="main-menu navbar-collapse collapse">
			<li <?php if($page_id == '1'){echo "class = 'active'";}?> ><a href="index.php"><i class="fa fa-tachometer"></i><span class="title">Dashboard</span></a></li>
			<?php
				if($status == 1)
				{
				?>
			<li <?php if($page_id == 3 || $page_id == 4 || $page_id == 6 || $page_id == 7 ){echo "class = 'active'";}?> id="adm"><a href="viewadmins.php"><i class="icon-users"></i><span class="title">Admins</span></a>
				<ul class="nav <?php if($page_id == 3 || $page_id == 4 || $page_id == 6 || $page_id == 7 ){echo "collapse in";} else {echo "collapse";}?>">
				
					<li <?php  if($page_id == '4'){echo "class = 'active'";}?> ><a href="addadmins.php"><span class="title">Add Admins</span></a></li>
					<li <?php  if($page_id == '3'){echo "class = 'active'";}?> ><a href="viewadmins.php"><span class="title">View Admins</span></a></li>
					<li <?php  if($page_id == '6'){echo "class = 'active'";}?> ><a href="addemp.php"><span class="title">Add Employees</span></a></li>
					<li <?php if($page_id == '7'){echo "class = 'active'";}?> ><a href="viewemp.php"><span class="title">View Employees</span></a></li>
				</ul>
			</li>
			<?php
				}
			else
			{
				echo "";
			}
			?>
			<li <?php if($page_id == 9 || $page_id == 10 || $page_id == 8 || $page_id == 12){echo "class = 'active'";}?>><a href="products.php"><i class="fa fa-archive" style="margin-left:2% !important;"></i><span class="title">Products</span></a>
				<ul class="nav <?php if($page_id == 9 || $page_id == 10 || $page_id == 8 || $page_id == 12 ){echo "collapse in";} else {echo "collapse";}?>">
					<li <?php if($page_id == '8'){echo "class = 'active'";}?>><a href="products.php"><span class="title">View Products</span></a></li>
					<li <?php if($page_id == '12'){echo "class = 'active'";}?>><a href="addproducts.php"><span class="title">Add Products</span></a></li>
				</ul>
			</li>
			<li <?php if($page_id == '20'){echo "class = 'active'";}?>><a href="allusers.php"><i class="fa fa-user"></i><span class="title">All Users</span></a></li>
		</ul>
		<!-- /main navigation -->		
  </div>
  <!-- /page sidebar -->
  
  <!-- Main container -->
  <div class="main-container">
  
		<!-- Main header -->
		<div class="main-header row">
		  <div class="col-sm-6 col-xs-7">
		  
			<!-- User info -->
			<ul class="user-info pull-left">          
			  <li class="profile-info dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="index.php#" aria-expanded="false"> 
			  <?php 
				if(!empty($avatar))
					echo "<img src='".$avatar."' class='avatar img-circle'  alt=''>".$name."<span class='caret'></span>";
				else
					echo "<img src='images/noimage.jpg' class='avatar img-circle' alt='noimage'>".$name."<span class='caret'></span>";
					
				?>								
			 
			  </a>
			  
				<!-- User action menu -->
				<ul class="dropdown-menu">
				  
				  <li><a href="myprofile.php"><i class="icon-user"></i>My profile</a></li>
				  <li class="divider"></li>
				  <li><a href="logout.php"><i class="icon-logout"></i>Logout</a></li>
				</ul>
				<!-- /user action menu -->
			  </li>
			</ul>
			<!-- /user info -->
		  </div>
		  
		</div>
		<!-- /main header -->
		<script>
		$(document).ready(function(){
			$("#adm").click(function(){
				$("#ban").removeClass("active");
			});
		});
		</script>
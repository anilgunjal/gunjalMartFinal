<?php require_once('header.php');
$aid = $_POST['aid'];
$stmt = $mysqli->prepare("SELECT adminid, empid, name, contact, address, email, dob, avatar, status, logstatus, lastlogindate, createDate FROM admins WHERE adminid = ?;");
$stmt->bind_param('i', $aid);
$stmt->execute ();
$stmt->bind_result ( $adminid, $empid, $name, $contact, $address, $email, $dob, $avatar, $status, $logstatus, $lastlogindate, $createDate );
$stmt->store_result ();
$row = $stmt->fetch ();
?>

	<!-- Main content -->
	<div class="main-content">
		<h1 class="page-title">Edit Admins</h1>
		<!-- Breadcrumb -->
		<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="index.php"><i class="fa fa-home"></i>Home</a></li> 
			<li><a href="viewadmins.php">Admins</a></li> 
			<li class="active"><strong>View Admin Details</strong></li> 
		</ol>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading clearfix">
						<h4 class="panel-title">Details Panel&nbsp;</h4>
						<ul class="panel-tool-options"> 
							<li><a data-rel="collapse" href="admindetails.php#"><i class="icon-down-open"></i></a></li>
							<li><a data-rel="reload" href="admindetails.php#"><i class="icon-arrows-ccw"></i></a></li>
						</ul>
					</div>
					<div class="panel-body">
						 <form class="form-horizontal" id="addadminform" method="POST">
						 <input type="hidden" name="adminid" value="<?php echo $aid;?>" />
						 	<div class="row"> 
							 	<label class="col-sm-2">Avatar</label>
								<?php if(!empty($avatar)) { ?>
								<div class="col-sm-5"> 
									<img src='<?php echo $avatar;?>' class='avatar'  alt=''>
								</div>
								<?php } else { ?>
								<div class="col-sm-5"> 
									<p>No Avatar</p>
								</div>
								<?php } ?>
							</div>
							<div class="line-dashed"></div>
							<div class="row"> 
								<label class="col-sm-2">Name</label> 
								<div class="col-sm-4"> 
									<b><?php echo $name; ?></b>
								</div>
								<label class="col-sm-2">Employee ID</label> 
								<div class="col-sm-4"> 
									<?php echo $empid;?>
								</div>
							</div>
							<div class="line-dashed"></div>
							<div class="row">
								<label class="col-sm-2">Email</label>
                                <div class="col-sm-4">
									<?php echo $email;?>
                                </div>
								<label class="col-sm-2">Contact</label> 
								<div class="col-sm-4"> 
									<?php echo $contact;?>
								</div>
                            </div>
							<div class="line-dashed"></div>
							<div class="row"> 
							 	<label class="col-sm-2">Address</label> 
								<div class="col-sm-4"> 
									<?php echo $address;?>
								</div>
								<label class="col-sm-2">DOB</label> 
								<div class="col-sm-4">
									<?php echo date('d-m-Y',strtotime($dob));?> 
								</div> 
							</div>
							 <div class="line-dashed"></div>
							 <div class="row"> 
								<label class="col-sm-2">Status</label> 
								<div class="col-sm-4">
									<?php echo $s = $status==1 ? 'Active' : 'Terminated';?> 
								</div>
								<label class="col-sm-2">Lastlogin Date</label> 
								<div class="col-sm-4">
									<?php echo $l = empty($lastlogindate) ? 'N/A' : date('d-m-Y h:m:i',strtotime($lastlogindate));?> 
								</div> 
							 </div>
							 <div class="line-dashed"></div>
							 <div class="row"> 
								<label class="col-sm-2">Created Date</label> 
								<div class="col-sm-5">
									<?php echo date('d-m-Y h:m:i',strtotime($createDate));?> 
								</div> 
							 </div>
							 
						</form>
					</div>
				</div>
			</div>
		</div>
		
		
		<!-- Footer -->
		<footer class="footer-main"> 
			&copy; 2016 <strong>NAP Review</strong> Design by <a target="_blank" href="https://ideamagix.com">Ideamagix</a>
		</footer>	
		<!-- /footer -->
		
	  </div>
	  <!-- /main content -->
	  
  </div>
  <!-- /main container -->
  
</div>
<!-- /page container -->

<!--Load JQuery-->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="plugins/metismenu/js/jquery.metisMenu.js"></script>
<script src="plugins/blockui-master/js/jquery-ui.js"></script>
<script src="plugins/blockui-master/js/jquery.blockUI.js"></script>
<script src="plugins/datepicker/js/bootstrap-datepicker.js"></script>
<script src="js/functions.js"></script>
<script src="js/loader.js"></script>
</body>
</html>

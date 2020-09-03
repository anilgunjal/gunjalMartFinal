<?php 
require_once('header.php'); 
$aid = $_SESSION['SESS_ADMINID'];
$stmt = $mysqli->prepare("SELECT adminid, empid, name, contact, address, email, dob, avatar FROM admins WHERE adminid = '$aid' ORDER BY adminid DESC;");
$stmt->execute ();
$stmt->bind_result ( $adminid, $empid, $name, $contact, $address, $email, $dob, $avatar );
$stmt->store_result ();
$row = $stmt->fetch ();

?>
	<!-- Main content -->
	<div class="main-content">
		<h1 class="page-title">Add Admins for Admin Panel</h1>
		<!-- Breadcrumb -->
		<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="index.php"><i class="fa fa-home"></i>Home</a></li> 
			<li class="active"><strong>My Profile</strong></li> 
		</ol>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading clearfix">
						<h4 class="panel-title">My Profile</h4>
						<ul class="panel-tool-options"> 
							<li><a data-rel="collapse" href="addadmins.php#"><i class="icon-down-open"></i></a></li>
							<li><a data-rel="reload" href="addadmins.php#"><i class="icon-arrows-ccw"></i></a></li>
							<li><a data-rel="close" href="addadmins.php#"><i class="icon-cancel"></i></a></li>
						</ul>
					</div>
					<div class="panel-body">
						 <div class="form-horizontal">
						 	<div class="form-group"> 
								<label class="col-sm-2 control-label">Name</label> 
								<div class="col-sm-10"> 
									<?php echo $name; ?>
								</div> 
							</div>
							<div class="line-dashed"></div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label">Employee ID</label> 
								<div class="col-sm-10"> 
									<?php echo $empid; ?>
								</div> 
							</div>
							<div class="line-dashed"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
									<?php echo $email; ?>
                                </div>
                            </div>
							<div class="line-dashed"></div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label">Contact</label> 
								<div class="col-sm-10"> 
									<?php echo $contact; ?>
								</div> 
							</div>
							<div class="line-dashed"></div>
							<div class="form-group"> 
							 	<label class="col-sm-2 control-label">Address</label> 
								<div class="col-sm-10"> 
									<?php echo $address; ?>
								</div> 
							</div>
							 <div class="line-dashed"></div>
							 <div class="form-group"> 
								<label class="col-sm-2 control-label">DOB</label> 
								<div class="col-sm-5">
									<?php echo $dob; ?>
								</div> 
							 </div>
							 <div class="line-dashed"></div>
							 <div class="form-group"> 
							 	<label class="col-sm-2 control-label">Avatar</label> 
								<div class="col-sm-10"> 
								<?php if(!empty($avatar))
										{		echo "<img src='".$avatar."' class='avatar img-circle'  alt=''>";
										}
									else{
												echo "<img src='images/noimage.jpg' class='avatar img-circle' alt='noimage'>";
									}		
								?>				
								</div> 
							</div>
							<br/>
							<div class="form-group"> 
								<div class="col-sm-offset-2 col-sm-10"> 
									<a class='btn btn-primary btn-sm' data-toggle='tooltip' data-placement='top' title='Edit Admin' type='button' onclick='formsub(<?php echo $adminid; ?>);'><i class='fa fa-edit'></i></a>
								</div> 
							</div>
							<form id='viewform<?php echo $adminid; ?>' style='display: none' method='post' action='editadmin.php'>
								<input type='hidden' name='aid' value='<?php echo $adminid; ?>'/>
							</form>
						</div>	
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
<script>
function formsub(id){
	alert("fgfdgd");
	$("#viewform"+id).submit();
}
	$('.digit').keyup(function(){
		var val = $(this).val();
		if(isNaN(val)){
			 val = val.replace(/[^0-9]/g,'');
		}
		$(this).val(val);
	});
	
	$('#date-popup').datepicker({
		keyboardNavigation: false,
		forceParse: false,
		todayHighlight: true,
		endDate: "+0d",
		format: "dd-mm-yyyy"
	});
	
	$('#email').blur(function(){
		var x=$('#email').val();
		if($('#email').val()!="")
		{
			var ajaxdata = {};
			ajaxdata['email'] = x;
			$.ajax({
				type:'post',
				url:'ajax/unique_email.php',
				data:ajaxdata,
				success:function(res)
				{
					if(res != "")
					{
						alert(res);
						$('#email').val('');
						$('#email').focus();
					}
				}
			});
		}
		
	});
	
	$("#addadminform").on('submit',(function(e) {
		e.preventDefault();
		$("#addbtn").prop('disabled', true);
		$("#loading").css('display','all');
		$("#loading").show();
		$.ajax({
			type:"POST",
			data:new FormData(this),
			contentType: false,
			cache: false,
			processData:false,
			url:"ajax/addadmins.php",
			success: function(response){
				if(response == 1)
				{
					$("#successbox").css('display','all');
					$("#successbox").show();
					$("#loading").css('display','none');
					$("#loading").hide();
					$("#addbtn").prop('disabled', false);
					$("#addadminform").trigger('reset');
					$("html, body").animate({ scrollTop: 0 }, "slow");
					setTimeout(function () {
						$("#successbox").css('display','none');
						$("#successbox").hide();
					}, 5000);
				}
				else
				{
					$("#loading").css('display','none');
					$("#loading").hide();
					$("#error").html(response);
					$("#error").css('display','all');
					$("#error").show();
					setTimeout(function () {
						$("#error").css('display','none');
						$("#error").hide();
					}, 5000);
					$("#addbtn").prop('disabled', false);
				}
			},
			error: function(){
				alert("Error Occured");
			}
		
		});
	}));
	
</script>
</body>
</html>

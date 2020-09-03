<?php 
$page_id = "4";
require_once('header.php'); ?>
	<!-- Main content -->
	<div class="main-content">
		<h1 class="page-title">Add Admins for Admin Panel</h1>
		<!-- Breadcrumb -->
		<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="index.php"><i class="fa fa-home"></i>Home</a></li> 
			<li><a href="viewadmins.php">Admins</a></li> 
			<li class="active"><strong>Add Admins</strong></li> 
		</ol>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading clearfix">
						<h4 class="panel-title">Add Admins Form</h4>
						<ul class="panel-tool-options"> 
							<li><a data-rel="collapse" href="addadmins.php#"><i class="icon-down-open"></i></a></li>
							<li><a data-rel="reload" href="addadmins.php#"><i class="icon-arrows-ccw"></i></a></li>
							<li><a data-rel="close" href="addadmins.php#"><i class="icon-cancel"></i></a></li>
						</ul>
					</div>
					<div class="panel-body">
						<div id="successbox" class="alert alert-dismissable alert-success col-sm-offset-2" style="width:30%; display:none">
							<i class="ion-checkmark"></i>&nbsp; Admin Added Successfully
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						</div>
						 <form class="form-horizontal" id="addadminform" method="POST">
						 	<div class="form-group"> 
								<label class="col-sm-2 control-label">Name</label> 
								<div class="col-sm-10"> 
									<input type="text" name="name" placeholder="Enter Admin Fullname" class="form-control" required>
									<input type="hidden" name="status" value="1" class="form-control" required>
								</div> 
							</div>
							<div class="line-dashed"></div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label">Employee ID</label> 
								<div class="col-sm-10"> 
									<input type="text" name="empid" placeholder="Enter Admin's ID" class="form-control">
								</div> 
							</div>
							<div class="line-dashed"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
									<input type="text" class="form-control" name="email" id="email" placeholder="Enter Admin Email-Id" required> 
                                </div>
                            </div>
							<div class="line-dashed"></div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label">Password</label> 
								<div class="col-sm-10"> 
									<input type="text" name="password" placeholder="Enter Admin Password" class="form-control" required>
								</div> 
							</div>
							<div class="line-dashed"></div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label">Contact</label> 
								<div class="col-sm-10"> 
									<input type="text" name="contact" placeholder="Enter Admin Mobile no." class="form-control digit" required>
								</div> 
							</div>
							<div class="line-dashed"></div>
							<div class="form-group"> 
							 	<label class="col-sm-2 control-label">Address</label> 
								<div class="col-sm-10"> 
									<textarea placeholder="Enter Admin Address" class="form-control" name="address"></textarea> 
								</div> 
							</div>
							 <div class="line-dashed"></div>
							 <div class="form-group"> 
								<label class="col-sm-2 control-label">DOB</label> 
								<div class="col-sm-5">
									<div id="date-popup" class="input-group date"> 
										<input type="text" name="dob" placeholder="Enter Admin DOB." class="form-control"> 
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
									</div>
								</div> 
							 </div>
							 <div class="line-dashed"></div>
							 <div class="form-group"> 
							 	<label class="col-sm-2 control-label">Avatar</label> 
								<div class="col-sm-10"> 
									<input type="file" id="field-file" name="avatar" class="form-control" placeholder="Upload Admin's Avatar" accept="image/jpeg, image/png">
									<span class="help-block">You can upload PNG/JPEG image file</span>
								</div> 
							</div>
							<div class="col-sm-offset-2" style="color:red !important; display:none; margin-top:1%" id="error"></div><br/>
							<div class="form-group"> 
								<div class="col-sm-offset-2 col-sm-10"> 
									<button class="btn btn-success btn-outline" id="addbtn" type="submit">Submit <span style="display:none;" id="loading">&nbsp;<i class="fa fa-spinner fa-spin"></i></span></button>
									<button class="btn btn-default btn-outline"  type="reset">Reset</button>
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
<script>
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

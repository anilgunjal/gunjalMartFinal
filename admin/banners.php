<?php 
$page_id = "2";
require_once('header.php'); ?>
	<!-- Main content -->
	<div class="main-content">
		<h1 class="page-title">Add Banners for Website</h1>
		<!-- Breadcrumb -->
		<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="index.php"><i class="fa fa-home"></i>Home</a></li> 
			<li class="active"><strong>Banners</strong></li> 
		</ol>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading clearfix">
						<h4 class="panel-title">Add Banner</h4>
						<ul class="panel-tool-options"> 
							<li><a data-rel="collapse" href="banners.php#"><i class="icon-down-open"></i></a></li>
							<li><a data-rel="reload" href="banners.php#"><i class="icon-arrows-ccw"></i></a></li>
							<li><a data-rel="close" href="banners.php#"><i class="icon-cancel"></i></a></li>
						</ul>
					</div>
					<div class="panel-body">
						<div id="successbox" class="alert alert-dismissable alert-success col-sm-offset-2" style="width:30%; display:none">
							<i class="ion-checkmark"></i>&nbsp; Banner Added Successfully
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						</div>
						 <form class="form-horizontal" id="addbannerform" method="POST">
						 <input type="hidden" name="adminid" value="<?php echo $admin_id;?>">
						 	<div class="form-group"> 
								<label class="col-sm-2 control-label">Banner Image<br/><!--(1350 X 420)--></label>
								<div class="col-sm-6"> 
									<input type="file" name="banner" class="form-control" accept="image/*" required>
									<span class="help-block">Please upload JPEG/PNG images</span>
								</div> 
							</div>
							<div class="line-dashed"></div>
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
		<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<h4 class="panel-title">Banners List</h4>
							<ul class="panel-tool-options"> 
								<li><a data-rel="collapse" href="banners.php#"><i class="icon-down-open"></i></a></li>
								<li><a data-rel="reload" href="banners.php#"><i class="icon-arrows-ccw"></i></a></li>
							</ul>
						</div>
						<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover dataTables-example" id="bannertable">
									<thead>
										<tr>
											<th>Sr. no</th>
											<th>Banner</th>
											<th>CreatedBy</th>
											<th>Created Date</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$row_count = 1;
										$stmt = $mysqli->prepare("SELECT bannerid, adminid, imagepath, createdDate FROM banner ORDER BY bannerid DESC;");
										$stmt->execute ();
										$stmt->bind_result ( $bannerid, $adminid, $imagepath, $createdDate );
										$stmt->store_result ();
										while($row = $stmt->fetch ())
										{
											echo "<tr id='banner".$bannerid."'>";
											echo "<td>". $row_count."</td>";
											echo "<td><img src='".$imagepath."' height='100' width='200'><input type='hidden' value ='".$imagepath."' id='banimg".$bannerid."'></td>";
											$stmta = $mysqli->prepare("SELECT name as aname FROM admins WHERE adminid ='$adminid';");
											$stmta->execute ();
											$stmta->bind_result ( $aname );
											$stmta->store_result ();
											$stmta->fetch ();
											echo "<td>". $aname ."</td>";
											echo "<td>". date('d-m-Y h:m:i a',strtotime($createdDate))."</td>";
											echo "<td><button id='deletebtn".$bannerid."' class='btn btn-danger btn-sm' type='button' onclick='javascript: return deletebanner(".$bannerid.");'><i class='fa fa-trash-o'></i></button></td></tr>";
											$row_count++;
										}
										?>
									</tbody>
								</table>
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

<script src="plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/js/dataTables.bootstrap.min.js"></script>
<script src="plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables/js/jszip.min.js"></script>
<script src="plugins/datatables/js/pdfmake.min.js"></script>
<script src="plugins/datatables/js/vfs_fonts.js"></script>
<script src="plugins/datatables/extensions/Buttons/js/buttons.html5.js"></script>
<script src="plugins/datatables/extensions/Buttons/js/buttons.colVis.js"></script>
<script src="plugins/datatables/js/dataTables-script.js"></script>
<script>
		
	$("#addbannerform").on('submit',(function(e) {
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
			url:"ajax/addbanner.php",
			success: function(response){
				if(response == 1)
				{
					$("#successbox").css('display','all');
					$("#successbox").show();
					$("#loading").css('display','none');
					$("#loading").hide();
					$("#addbtn").prop('disabled', false);
					$("#addbannerform").trigger('reset');
					$("html, body").animate({ scrollTop: 0 }, "slow");
					$("#bannertable").load(location.href+" #bannertable>*","");
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
	
	function deletebanner(id)
	{
		var b_id = id;
		var imgpath = $("#banimg"+id).val();
		var x = confirm("Are you sure you want to Delete this Category?");
		if (x==true)
		{
			
			$.ajax({
				type:"POST",
				url:"ajax/deletebanner.php",
				data: {'b_id':b_id,'imgpath':imgpath},
				success: function(response){
					if(response == 1)
					{
						$("#banner"+id).fadeOut(1000);
						$("#bannertable").load(location.href+" #bannertable>*","");
					}
					else
					{
						alert("Something went wrong try again");
					}
				},
				error: function () {
					alert("Error Occurred.");
				}
				
			});
			
		}
		else
		{
			return false;
		}
	}
</script>
</body>
</html>

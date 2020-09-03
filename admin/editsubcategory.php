<?php 
$page_id = "10";
require_once('header.php'); ?>
	<!-- Main content -->
	<div class="main-content">
		<h1 class="page-title">Edit Sub-Categories</h1>
		<!-- Breadcrumb -->
		<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="index.php"><i class="fa fa-home"></i>Home</a></li> 
			<li><a href="products.php">Products</a></li> 
			<li class="active"><strong>Edit Sub-Categories</strong></li> 
		</ol>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading clearfix">
						<h4 class="panel-title">Edit Sub-Categories</h4>
					</div>
					<?php 
					$sid = $_POST['scatid'];
					$stmt = $mysqli->prepare("SELECT scatid, catid as cid, adminid, subcatname, createdDate FROM subcategory WHERE scatid = ?;");
					$stmt->bind_param('i',$sid);
					$stmt->execute ();
					$stmt->bind_result ( $scatid, $cid, $adminid, $subcatname, $createdDate );
					$stmt->store_result ();
					while($row = $stmt->fetch ())
					
					?>
					<div class="panel-body">
						<div id="successbox" class="alert alert-dismissable alert-success col-sm-offset-2" style="width:30%; display:none">
							<i class="ion-checkmark"></i>&nbsp; Sub-Categories Edited Successfully
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						</div>
						 <form class="form-horizontal" id="addsubcatform" method="POST">
						 <input type="hidden" name="adminid" value="<?php echo $admin_id;?>">
						 <input type="hidden" name="scatid" value="<?php echo $scatid;?>">
						 <input type="hidden" name="addeditmore" id="addeditmore" value="0">
						 	<div class="form-group"> 
								<label class="col-sm-2 control-label">Category</label> 
								<div class="col-sm-6"> 
									<select class="form-control" name="cname" required> 
										<option value="">Select Category</option>
										<?php
										$stmt = $mysqli->prepare("SELECT catid, catname FROM category");
										$stmt->execute();
										$stmt->bind_result($catid, $catname);
										$stmt->store_result();
										while($stmt->fetch())
										{
											if($catid==$cid)
											{
												echo "<option value='".$catid."' selected>".$catname."</option>";
											}
											else
											{
												echo "<option value='".$catid."'>".$catname."</option>";
											}
											
										}
										
										?>
									</select>
								</div> 
							</div>
							<div class="line-dashed"></div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label">Sub-Category Name</label> 
								<div class="col-sm-6"> 
									<input type="text" name="subcname" placeholder="Enter Sub-Category Name" class="form-control" value="<?php echo $subcatname; ?>" required>
								</div> 
							</div>
							<div class="line-dashed"></div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label">Specifications</label>
								<div class="col-sm-6">
								<?php
									$stmts = $mysqli->prepare("SELECT spfid, specification FROM specification WHERE scatid ='$scatid' ORDER BY level;");
									$stmts->execute ();
									$stmts->bind_result ( $spfid, $specification );
									$stmts->store_result ();
									$i = 1;
									while($stmts->fetch ())
									{
								?> <div class="col-sm-10">
									<input id="s<?php echo $spfid;?>" type="text" name="specif[]" placeholder="Enter Specifications of Sub-Category" value="<?php echo $specification; ?>" class="form-control" required>
									<input id="v<?php echo $spfid;?>" type="hidden" name="specifid[]" value="<?php echo $spfid; ?>">
									</div>
									<?php 
										if($i > 1)
										{
									?>
									<div class="col-sm-2"><button id="b<?php echo $spfid;?>" class="btn btn-xs btn-danger" type="button" onclick="removeexistElement('<?php echo $spfid; ?>')"><i class="fa fa-minus"></i></button></div>
								<?php
										}
										$i++;
								} ?>
								</div>
								<div class="col-sm-4">
								<button type="button" id="plusButton" style="margin-top: 1%;" class="btn btn-sm btn-success">Add More <i class="fa fa-plus"></i></button>	
								</div>
							</div>
							<div id="insertBefore"></div>
							<div class="line-dashed"></div>
							<div class="col-sm-offset-2" style="color:red !important; display:none; margin-top:1%" id="error"></div><br/>
							<div class="form-group"> 
								<div class="col-sm-offset-2 col-sm-10"> 
									<button class="btn btn-success btn-outline" id="addbtn" type="submit">Save <span style="display:none;" id="loading">&nbsp;<i class="fa fa-spinner fa-spin"></i></span></button>
									<a class="btn btn-default btn-outline"  type="button" href="subcategories.php">Cancel</a>
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
	function formsub(id)
	{
		$("#viewform"+id).submit();
	}
	var $insertBefore = $('#insertBefore');
			var $i = 0;
            $('#plusButton').click(function(){
              $i = $i+1;
              $('<div class="form-group addspec'+$i+'" style="margin-bottom:5px;"> ' + '<label class="col-sm-2 control-label">&nbsp;</label><div class="col-sm-6"><input type="text" name="editspecif[]" class="form-control" placeholder="Enter Specifications of Sub-Category"></div><div class="col-sm-2"><button class="btn btn-xs btn-danger" type="button" onclick="removeElement('+$i+')"><i class="fa fa-minus"></i></button> ' + ' </div> ').insertBefore($insertBefore);
			  $("#addeditmore").val($i);
		});
	
	function removeElement(id)
	{
		$( ".addspec"+id ).remove();
		$val = $("#addeditmore").val();
		$cnt =  $val - 1;
		$("#addeditmore").val($cnt);
	}
	function removeexistElement(id)
	{
		var spefid = $( "#v"+id ).val();
		$( "#s"+id ).remove();
		$( "#v"+id ).remove();
		$val = $("#addeditmore").val();
		$cnt =  $val - 1;
		$("#addeditmore").val($cnt);
		$( "#b"+id ).remove();
		$('<input type="text" style="display:none;" name="deletespe[]" class="form-control" value = "'+spefid+'">').insertBefore($insertBefore);
	}
	
	$("#addsubcatform").on('submit',(function(e) {
		e.preventDefault();
		var specifs = document.getElementsByName('specif[]');
		for (var spec in specifs){
			if (specifs[spec].value=="") {
				
				$("#error").css('display','all');
				$("#error").show();
				$("#error").html("Please Enter Specifications");
				setTimeout(function () {
					$("#error").css('display','none');
					$("#error").hide();
				}, 5000);
				return false;
			}
		}
		$("#addbtn").prop('disabled', true);
		$("#loading").css('display','all');
		$("#loading").show();
		$.ajax({
			type:"POST",
			data:$("#addsubcatform").serialize(),
			url:"ajax/editsubcategory.php",
			success: function(response){
				if(response == 1)
				{
					$("#successbox").css('display','all');
					$("#successbox").show();
					$("#loading").css('display','none');
					$("#loading").hide();
					$("#addbtn").prop('disabled', false);
					$("html, body").animate({ scrollTop: 0 }, "slow");
					setTimeout(function () {
						window.location.href='subcategories.php';
					}, 3000);
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

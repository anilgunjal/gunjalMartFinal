<?php 
$page_id = "9";
require_once('header.php'); ?>
	<!-- Main content -->
	<div class="main-content">
		<h1 class="page-title">Add Categories of Product</h1>
		<!-- Breadcrumb -->
		<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="index.php"><i class="fa fa-home"></i>Home</a></li> 
			<li><a href="products.php">Products</a></li> 
			<li class="active"><strong>Add Categories</strong></li> 
		</ol>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading clearfix">
						<h4 class="panel-title">Add Categories</h4>
						<ul class="panel-tool-options"> 
							<li><a data-rel="collapse" href="categories.php#"><i class="icon-down-open"></i></a></li>
							<li><a data-rel="reload" href="categories.php#"><i class="icon-arrows-ccw"></i></a></li>
							<li><a data-rel="close" href="categories.php#"><i class="icon-cancel"></i></a></li>
						</ul>
					</div>
					<div class="panel-body">
						<div id="successbox" class="alert alert-dismissable alert-success col-sm-offset-2" style="width:30%; display:none">
							<i class="ion-checkmark"></i>&nbsp; Category Added Successfully
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						</div>
						 <form class="form-horizontal" id="addcatform" method="POST" enctype="multipart/form-data">
						 <input type="hidden" name="adminid" value="<?php echo $admin_id;?>">
						 	<div class="form-group"> 
								<label class="col-sm-2 control-label">Category Name</label> 
								<div class="col-sm-6"> 
									<input type="text" name="cname" placeholder="Enter Category Name" class="form-control" required>
								</div> 
							</div>
							<div class="line-dashed"></div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label">Product Image.</label> 
								<div class="col-sm-8"> 
								<div class="col-sm-9"> 
									<input type="file" name="files" id="files" class="form-control" style="float:left;" required />
								</div>
								<div class="col-sm-3"> 
									<img src="#" id="pimage" class="form-control" style="height:100px; width:100px; float:right;"/>
								</div>
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
							<h4 class="panel-title">Categories List</h4>
							<ul class="panel-tool-options"> 
								<li><a data-rel="collapse" href="data-tables.html#"><i class="icon-down-open"></i></a></li>
								<li><a data-rel="reload" href="data-tables.html#"><i class="icon-arrows-ccw"></i></a></li>
							</ul>
						</div>
						<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover dataTables-example" id="cattable">
									<thead>
										<tr>
											<th>Sr. no</th>
											<th>Category</th>
											<th>Image</th>
											<th>CreatedBy</th>
											<th>Created Date</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$row_count = 1;
										$stmt = $mysqli->prepare("SELECT catid, adminid, catname, cat_img, createdDate FROM category ORDER BY catid DESC;");
										$stmt->execute ();
										$stmt->bind_result ( $catid, $adminid, $catname, $cat_img, $createdDate );
										$stmt->store_result ();
										while($row = $stmt->fetch ())
										{
											echo "<tr id='cat".$catid."'>";
											echo "<td>". $row_count."</td>";
											echo "<td><span id='cname".$catid."'>". $catname."</span><input type='text' style='display:none' value='".$catname."' id='cattxt".$catid."' class='form-control'></td>";
											echo "<td><input type='file' id='catimg".$catid."' class='form-control' style='display:none'><img src='".$cat_img."' id='catimage".$catid."'><input type='hidden' id='catimage1".$catid."' name='catimage1".$catid."' value='".$cat_img."' class='form-control' ></td>";
											$stmta = $mysqli->prepare("SELECT name as aname FROM admins WHERE adminid ='$adminid';");
											$stmta->execute ();
											$stmta->bind_result ( $aname );
											$stmta->store_result ();
											$stmta->fetch ();
											echo "<td>". $aname ."</td>";
											echo "<td>". date('d-m-Y h:m:i a',strtotime($createdDate))."</td>";
											echo "<td><a id='editcatbtn".$catid."' class='btn btn-info btn-sm' type='button' onclick='javascript: return editcat(".$catid.")'><i class='fa fa-edit'></i></a><a id='savecatbtn".$catid."' class='btn btn-success btn-sm' style='display:none' type='button' onclick='javascript: return savecat(".$catid.")'><i class='fa fa-check'></i></a>&nbsp;&nbsp;<a id='cancelcatbtn".$catid."' class='btn btn-danger btn-sm' style='display:none' type='button' onclick='javascript: return cancelcat(".$catid.")'><i class='fa fa-times'></i></a><button id='deletecatbtn".$catid."' class='btn btn-danger btn-sm' type='button' onclick='javascript: return deletecat(".$catid.");'><i class='fa fa-trash-o'></i></button></td></tr>";
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
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#pimage').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#files").change(function(){
		readURL(this);
	});
	
	$('#cname').blur(function(){
		var x=$('#cname').val();
		if($('#cname').val()!="")
		{
			var ajaxdata = {};
			ajaxdata['cname'] = x;
			$.ajax({
				type:'post',
				url:'ajax/unique_cat.php',
				data:ajaxdata,
				success:function(res)
				{
					if(res != "")
					{
						alert(res);
						$('#cname').val('');
						$('#cname').focus();
					}
				}
			});
		}
		
	});
	
	$("#addcatform").on('submit',(function(e) {
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
			url:"ajax/addcategory.php",
			success: function(response){
				if(response == 1)
				{
					$("#successbox").css('display','all');
					$("#successbox").show();
					$("#loading").css('display','none');
					$("#loading").hide();
					$("#addbtn").prop('disabled', false);
					$("#pimage").css('display','none');
					$("#addcatform").trigger('reset');
					$("html, body").animate({ scrollTop: 0 }, "slow");
					setTimeout(function () {
						$("#successbox").css('display','none');
						$("#successbox").hide();
						
						$("#pimage").show();
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
	
	function editcat(id)
	{
		$('#cattxt'+id).css('display','all');
		$('#cattxt'+id).show();
		$('#cname'+id).css('display','none');
		$('#cname'+id).hide();
		$('#editcatbtn'+id).css('display','none');
		$('#editcatbtn'+id).hide();
		$('#deletecatbtn'+id).css('display','none');
		$('#deletecatbtn'+id).hide();
		$('#savecatbtn'+id).css('display','all');
		$('#savecatbtn'+id).show();
		$('#cancelcatbtn'+id).css('display','all');
		$('#cancelcatbtn'+id).show();
		$('#cattxt'+id).focus();
		$('#catimg'+id).css('display','all');
		$('#catimg'+id).show();
		$('#catimg'+id).focus();
	}
		
	function cancelcat(id)
	{
		$('#cattxt'+id).css('display','none');
		$('#cattxt'+id).hide();
		$('#cname'+id).css('display','all');
		$('#cname'+id).show();
		$('#editcatbtn'+id).css('display','all');
		$('#editcatbtn'+id).show();
		$('#deletecatbtn'+id).css('display','all');
		$('#deletecatbtn'+id).show();
		$('#savecatbtn'+id).css('display','none');
		$('#savecatbtn'+id).hide();
		$('#cancelcatbtn'+id).css('display','none');
		$('#cancelcatbtn'+id).hide();
		$('#catimg'+id).css('display','none');
		$('#catimg'+id).hide();
	}
	
	function savecat(id)
	{
		var dataimg = new FormData();
		dataimg.append('c_id', id);
		dataimg.append('cattxt', $("#cattxt"+id).val());
		
		dataimg.append('catimg', $("#catimg"+id)[0].files[0]);
		dataimg.append('catimage1', $("#catimage1"+id).val());
				
		$.ajax({
			type:"POST",
			//data:new FormData(this),
			data: dataimg,
			contentType: false,
			cache: false,
			processData:false,
			url:"ajax/savecatdata.php",
			success: function(response){
				alert(response);
				$("#cattable").load(location.href+" #cattable>*","");
			},
			error: function(){
				alert("Error occurred");
			}
		});
	}
	
	function deletecat(id)
	{
		var c_id = id;
		var x = confirm("Are you sure you want to Delete this Category? This will delete all Product/Sub-Category related to it.");
		if (x==true)
		{
			
			$.ajax({
				type:"POST",
				url:"ajax/deletecat.php",
				data: {'c_id':c_id},
				success: function(response){
					if(response == 1)
					{
						$("#cat"+id).fadeOut(1000);
						$("#cattable").load(location.href+" #cattable>*","");
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

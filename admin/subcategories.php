<?php 
$page_id = "10";
require_once('header.php'); ?>
	<!-- Main content -->
	<div class="modal hide fade" id="createFormId">
		<div class="modal-header">
			<a href="#" class="close" data-dismiss="modal">&times;</a>
			<h3>Create Announcement</h3>
		</div>
		<div class="modal-body">
			<form class="form-horizontal" method="POST" commandName="announceBean" action="/announce" >
				<input type="hidden" name="cafeId" value="104" />
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="cafeName">Where I am Coding</label>
						<div class="controls">
							<input id="cafeName" name="cafeName" class="input-xlarge disabled" type="text" readonly="readonly" type="text" value="B&amp;Js"/>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="date">Date</label>
						<div class="controls">
							<input type="text" class="input-xlarge" id="date" name="date" />
							<p class="help-block"></p>
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
							<input type="submit" class="btn btn-primary" value="create" />
							<input type="button" class="btn" value="Cancel" onclick="closeDialog ();" />
						</div>
					</div>
				</fieldset>
			</form>
		</div></div>
	<div class="main-content">
		<h1 class="page-title">Add Sub-Categories of Product</h1>
		<!-- Breadcrumb -->
		<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="index.php"><i class="fa fa-home"></i>Home</a></li> 
			<li><a href="products.php">Products</a></li> 
			<li class="active"><strong>Add Sub-Categories</strong></li> 
		</ol>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading clearfix">
						<h4 class="panel-title">Add Sub-Categories</h4>
						<ul class="panel-tool-options"> 
							<li><a data-rel="collapse" href="subcategories.php#"><i class="icon-down-open"></i></a></li>
							<li><a data-rel="reload" href="subcategories.php#"><i class="icon-arrows-ccw"></i></a></li>
							<li><a data-rel="close" href="subcategories.php#"><i class="icon-cancel"></i></a></li>
						</ul>
					</div>
					<div class="panel-body">
						<div id="successbox" class="alert alert-dismissable alert-success col-sm-offset-2" style="width:30%; display:none">
							<i class="ion-checkmark"></i>&nbsp; Sub-Categories Added Successfully
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						</div>
						 <form class="form-horizontal" id="addsubcatform" method="POST">
						 <input type="hidden" name="adminid" value="<?php echo $admin_id;?>">
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
											echo "<option value='".$catid."'>".$catname."</option>";
										}
										
										?>
									</select>
								</div> 
							</div>
							<div class="line-dashed"></div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label">Sub-Category Name</label> 
								<div class="col-sm-6"> 
									<input type="text" name="subcname" placeholder="Enter Sub-Category Name" class="form-control" required>
								</div> 
							</div>
							<div class="line-dashed"></div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label">Specifications</label>
								<div class="col-sm-6"> 
									<input type="text" name="specif[]" placeholder="Enter Specifications of Sub-Category" class="form-control" required>
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
							<h4 class="panel-title">Sub-Categories List</h4>
							<ul class="panel-tool-options"> 
								<li><a data-rel="collapse" href="data-tables.html#"><i class="icon-down-open"></i></a></li>
								<li><a data-rel="reload" href="data-tables.html#"><i class="icon-arrows-ccw"></i></a></li>
							</ul>
						</div>
						<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover dataTables-example" id="subcattable">
									<thead>
										<tr>
											<th>Sr. no</th>
											<th>Category</th>
											<th>Sub-Category</th>
											<th>Specs.</th>
											<th>CreatedBy</th>
											<th>Created Date</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$row_count = 1;
										$stmt = $mysqli->prepare("SELECT scatid, catid, adminid, subcatname, createdDate FROM subcategory ORDER BY scatid DESC;");
										$stmt->execute ();
										$stmt->bind_result ( $scatid, $catid, $adminid, $subcatname, $createdDate );
										$stmt->store_result ();
										while($row = $stmt->fetch ())
										{
											echo "<tr id='scat".$scatid."'>";
											echo "<td>". $row_count."</td>";
											$stmta = $mysqli->prepare("SELECT catname FROM category WHERE catid ='$catid';");
											$stmta->execute ();
											$stmta->bind_result ( $catname );
											$stmta->store_result ();
											$stmta->fetch ();
											echo "<td><span id='cattxt".$scatid."'>". $catname."</span>
											<select class='form-control' id='cname".$scatid."' class='form-control' style='display:none;'>";
												$stmtai = $mysqli->prepare("SELECT catid as cid, catname as cname FROM category;");
												$stmtai->execute ();
												$stmtai->bind_result ( $cid, $cname );
												$stmtai->store_result ();
												while($stmtai->fetch ())
												{
													if($catid==$cid){
														echo "<option value='".$cid."' selected>".$cname."</option>";
													} else {
														echo "<option value='".$cid."'>".$cname."</option>";
													}
												}
											echo "</select>
											</td>";
											echo "<td><span id='subtxt".$scatid."'>". $subcatname ."</span><input type='text' style='display:none' value='".$subcatname."' id='sname".$scatid."' class='form-control'></td>";
											echo "<td>";
											$stmts = $mysqli->prepare("SELECT spfid, specification, level FROM specification WHERE scatid ='$scatid' ORDER By level;");
											$stmts->execute ();
											$stmts->bind_result ( $spfid, $specification, $level );
											$stmts->store_result ();
											while($stmts->fetch ())
											{
												if(!empty($specification)) {
													echo "<p>".$specification."</p>";
												}
											}
											echo "</td>";
											$stmta = $mysqli->prepare("SELECT name as aname FROM admins WHERE adminid ='$adminid';");
											$stmta->execute ();
											$stmta->bind_result ( $aname );
											$stmta->store_result ();
											$stmta->fetch ();
											echo "<td>". $aname ."</td>";
											echo "<td>". date('d-m-Y h:i:s a',strtotime($createdDate))."</td>";
											echo "<td><a id='editcatbtn".$scatid."' class='btn btn-info btn-sm' type='button' onclick='formsub(".$scatid.");'><form id='viewform".$scatid."' style='display: none' method='post' action='editsubcategory.php'><input type='hidden' name='scatid' value='".$scatid."'/></form><i class='fa fa-edit'></i></a>&nbsp;<button id='deleteprobtn".$scatid."' class='btn btn-danger btn-sm' type='button' onclick='javascript: return deletecat(".$scatid.");'><i class='fa fa-trash-o'></i></button>
											
											<a style= 'margin-top:10px;' id='ordercatbtn".$scatid."' class='btn btn-info btn-sm' type='button' onclick='orderformsub(".$scatid.");'><form id='orderviewform".$scatid."' style='display: none' method='post' action='ordersubcategory.php'><input type='hidden' name='scatid' value='".$scatid."'/></form><i class='fa fa-info-circle'></i></a>
										
											</td></tr>";
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
$(document).ready(function(){
   $(".order").click(function(){ // Click to only happen on announce links
		$("#scat").val(this.id);
   });
});
	function formsub(id)
	{
		$("#viewform"+id).submit();
	}
	function orderformsub(id)
	{
		$("#orderviewform"+id).submit();
	}
	var $insertBefore = $('#insertBefore');
			var $i = 1;
            $('#plusButton').click(function(){
              $i = $i+1;
              $('<div class="form-group addspec'+$i+'" style="margin-bottom:5px;"> ' + '<label class="col-sm-2 control-label">&nbsp;</label><div class="col-sm-6"><input type="text" name="specif[]" class="form-control" placeholder="Enter Specifications of Sub-Category"></div><div class="col-sm-2"><button class="btn btn-xs btn-danger" type="button" onclick="removeElement('+$i+')"><i class="fa fa-minus"></i></button> ' + ' </div> ').insertBefore($insertBefore);
		});
	
	function removeElement(id)
	{
		$( ".addspec"+id ).remove();
	}
	
	$('#subcname').blur(function(){
		var x=$('#subcname').val();
		var y=$('#cname').val();
		if($('#subcname').val()!="" && $('#cname').val()!="")
		{
			var ajaxdata = {};
			ajaxdata['subcname'] = x;
			ajaxdata['cname'] = x;
			$.ajax({
				type:'post',
				url:'ajax/unique_subcat.php',
				data:ajaxdata,
				success:function(res)
				{
					if(res != "")
					{
						alert(res);
						$('#subcname').val('');
						$('#subcname').focus();
					}
				}
			});
		}
		
	});
	
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
			url:"ajax/addsubcategory.php",
			success: function(response){
				if(response == 1)
				{
					$("#successbox").css('display','all');
					$("#successbox").show();
					$("#loading").css('display','none');
					$("#loading").hide();
					$("#addbtn").prop('disabled', false);
					$("#addsubcatform").trigger('reset');
					$("html, body").animate({ scrollTop: 0 }, "slow");
					//$("#cattable").load(location.href+" #cattable>*","");
					setTimeout(function () {
						$("#successbox").css('display','none');
						$("#successbox").hide();
					}, 5000);
					window.location.href = "subcategories.php";
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
	
	/* function editcat(id)
	{
		$('#cname'+id).css('display','all');
		$('#cname'+id).show();
		$('#cattxt'+id).css('display','none');
		$('#cattxt'+id).hide();
		$('#sname'+id).css('display','all');
		$('#sname'+id).show();
		$('#subtxt'+id).css('display','none');
		$('#subtxt'+id).hide();
		$('#editcatbtn'+id).css('display','none');
		$('#editcatbtn'+id).hide();
		$('#deletecatbtn'+id).css('display','none');
		$('#deletecatbtn'+id).hide();
		$('#savecatbtn'+id).css('display','all');
		$('#savecatbtn'+id).show();
		$('#cancelcatbtn'+id).css('display','all');
		$('#cancelcatbtn'+id).show();
		$('#sname'+id).focus();
		
	}
		
	function cancelcat(id)
	{
		$('#cname'+id).css('display','none');
		$('#cname'+id).hide();
		$('#cattxt'+id).css('display','all');
		$('#cattxt'+id).show();
		$('#sname'+id).css('display','none');
		$('#sname'+id).hide();
		$('#subtxt'+id).css('display','all');
		$('#subtxt'+id).show();
		$('#editcatbtn'+id).css('display','all');
		$('#editcatbtn'+id).show();
		$('#deletecatbtn'+id).css('display','all');
		$('#deletecatbtn'+id).show();
		$('#savecatbtn'+id).css('display','none');
		$('#savecatbtn'+id).hide();
		$('#cancelcatbtn'+id).css('display','none');
		$('#cancelcatbtn'+id).hide();
		
	}
	
	function savecat(id)
	{
		var s_id = id;
		
		var txtinput = $("#sname"+id).val();
		var optinput = $("#cname"+id).val();
		
		var ajaxdata = {};
		
		ajaxdata['s_id'] = s_id;
		ajaxdata['subcat'] = txtinput;
		ajaxdata['cat'] = optinput;
		
		$.ajax({
			type:"POST",
			url:"ajax/savesubcatdata.php",
			data:ajaxdata,
			success: function(response){
				alert(response);
				$("#subcattable").load(location.href+" #subcattable>*","");
			},
			error: function(){
				alert("Error occurred");
			}
		});
	} */
	
	function deletecat(id)
	{
		var c_id = id;
		var x = confirm("Are you sure you want to Delete this Sub-Category? This will delete all Product related to it.");
		if (x==true)
		{
			
			$.ajax({
				type:"POST",
				url:"ajax/deletesubcat.php",
				data: {'s_id':c_id},
				success: function(response){
					if(response == 1)
					{
						$("#scat"+id).fadeOut(1000);
						$("#subcattable").load(location.href+" #subcattable>*","");
					}
					else
					{
						$("#scat"+id).fadeOut(1000);
						$("#subcattable").load(location.href+" #subcattable>*","");
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

<?php 
$page_id = "10";
$scatid = $_POST['scatid'];
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
						<h4 class="panel-title">Bordered table</h4>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table id="desigtable" class="table table-bordered">
								<thead> 
									<tr> 
										<th>#</th> 
										<th>Specification</th> 
										<th>Level</th> 
										<th>Action</th> 
									</tr> 
								</thead> 
								<tbody> 
									
										<?php
											$stmts = $mysqli->prepare("SELECT spfid, specification, level FROM specification WHERE scatid ='$scatid' ORDER BY level;");
											$stmts->execute ();
											$stmts->bind_result ( $spfid, $specification, $level );
											$stmts->store_result ();
											$i = 1;
											while($stmts->fetch ())
											{
												
												?>
												<tr> 
												<th scope="row"><?php echo $i;?></th> 
												<td><?php echo $specification;?><input type="hidden" value="<?php echo $scatid;?>" id="scid"></td> 
												<td>
												<?php 
													echo "Order : ".$level." ";
													echo "<select id='optlevel".$spfid."' style='display:none'>";
															$stmti = $mysqli->prepare("SELECT count(*) as total FROM specification where scatid = '$scatid'");
															$stmti->execute();
															$stmti->bind_result($total);
															$stmti->store_result();
															$stmti->fetch ();
															for ( $x = 1; $x <= $total; $x ++)
															{
																if($level==$x)
																{
																	echo "<option value='".$x."' selected>Level ".$x."</option>";
																}
																else
																{
																	echo "<option value='".$x."'>Level ".$x."</option>";
																}
																//echo "<option value='".$x."' ".$a = $level==$x ? 'selected' : ''. ">Level ".$x."</option>";
															}
														echo "</select>";
												?></td>
												<td>
												<?php
													echo "<a id='editdesgbtn".$spfid."' class='btn btn-info btn-sm' type='button' onclick='javascript: return editdesg(".$spfid.")'>Edit <i class='fa fa-edit'></i></a><a id='savedesgbtn".$spfid."' class='btn btn-success btn-sm' style='display:none' type='button' onclick='javascript: return savedesg(".$spfid.")'>Save <i class='fa fa-check'></i></a>&nbsp;&nbsp;<a id='canceldesgbtn".$spfid."' class='btn btn-danger btn-sm' style='display:none' type='button' onclick='javascript: return canceldesg(".$spfid.")'>Cancel <i class='fa fa-times'></i></a>";
												?>
												</td>
													</tr> 
												<?php
												$i++;
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
	function editdesg(id)
	{
		$('#desgntxt'+id).prop("type", "text");
		$('#desgn'+id).css('display','none');
		$('#desgn'+id).hide();
		$('#optlevel'+id).css('display','all');
		$('#optlevel'+id).show();
		$('#level'+id).css('display','none');
		$('#level'+id).hide();
		$('#editdesgbtn'+id).css('display','none');
		$('#editdesgbtn'+id).hide();
		$('#deletedesgbtn'+id).css('display','none');
		$('#deletedesgbtn'+id).hide();
		$('#savedesgbtn'+id).css('display','all');
		$('#savedesgbtn'+id).show();
		$('#canceldesgbtn'+id).css('display','all');
		$('#canceldesgbtn'+id).show();
		$('#desgntxt'+id).focus();
	}
	
	function canceldesg(id)
	{
		$('#desgntxt'+id).prop("type", "hidden");
		$('#desgn'+id).css('display','all');
		$('#desgn'+id).show();
		$('#optlevel'+id).css('display','none');
		$('#optlevel'+id).hide();
		$('#level'+id).css('display','all');
		$('#level'+id).show();
		$('#editdesgbtn'+id).css('display','all');
		$('#editdesgbtn'+id).show();
		$('#deletedesgbtn'+id).css('display','all');
		$('#deletedesgbtn'+id).show();
		$('#savedesgbtn'+id).css('display','none');
		$('#savedesgbtn'+id).hide();
		$('#canceldesgbtn'+id).css('display','none');
		$('#canceldesgbtn'+id).hide();
		
	}
	function savedesg(id)
	{
		var d_id = id;
		var sc_id = $("#scid").val();;
		var levelinput = $("#optlevel"+id).val();
		
		var ajaxdata = {};
		
		ajaxdata['d_id'] = d_id;
		ajaxdata['sc_id'] = sc_id;
		ajaxdata['levelinput'] = levelinput;
		
		$.ajax({
			type:"POST",
			url:"ajax/saveorder.php",
			data:ajaxdata,
			success: function(response){
				window.location.href = "subcategories.php";
			},
			error: function(){
				alert("Error occurred");
			}
		});
	}
</script>
</body>
</html>

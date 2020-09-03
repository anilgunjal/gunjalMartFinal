<?php 
$page_id = "3";
require_once('header.php'); ?>
	 <!-- Main content -->
	 <div class="main-content">
			<h1 class="page-title">List of Admins</h1>
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
							<h4 class="panel-title">Admin List</h4>
							<ul class="panel-tool-options"> 
								<li><a data-rel="collapse" href="data-tables.html#"><i class="icon-down-open"></i></a></li>
								<li><a data-rel="reload" href="data-tables.html#"><i class="icon-arrows-ccw"></i></a></li>
							</ul>
						</div>
						<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover dataTables-example" id="admintable">
									<thead>
										<tr>
											<th>Sr. no</th>
											<th>EMPID</th>
											<th>Name</th>
											<th>Email</th>
											<th>Avatar</th>
											<th>Lastlogin Date</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$row_count = 1;
										$stmt = $mysqli->prepare("SELECT adminid, empid, name, contact, address, email, dob, avatar, status, empstat, logstatus, lastlogindate FROM admins WHERE status = '1';");
										$stmt->execute ();
										$stmt->bind_result ( $adminid, $empid, $name, $contact, $address, $email, $dob, $avatar, $status, $empstat, $logstatus, $lastlogindate );
										$stmt->store_result ();
										while($row = $stmt->fetch ())
										{
											if($status==0):
												echo "<tr id='adm".$adminid."' style='background-color: rgba(231, 28, 33, 0.18); color: rgb(110, 102, 102);'>";
											else:
												echo "<tr id='adm".$adminid."'>";
											endif;
											if($logstatus==1) {
												echo "<td><i class='fa fa-circle' style='color:green;font-size:0.8em;'></i>&nbsp;". $row_count."</td>";
											} else {
												echo "<td><i class='fa fa-circle' style='color:red;font-size:0.8em;'></i>&nbsp;". $row_count."</td>";
											}
											echo "<td>". $empid."</td>";
											echo "<td>". $name."</td>";
											echo "<td>". $email."</td>";
											if(!empty($avatar)):
												echo "<td><img src='".$avatar."' class='avatar img-circle'  alt=''></td>";
											else:
												echo "<td><img src='images/noimage.jpg' class='avatar img-circle' alt='noimage'></td>";
											endif;
											echo "<td>". $l = empty($lastlogindate) ? 'N/A' : date('d-m-Y h:i:s a',strtotime($lastlogindate));"</td>";
											echo "<td><a class='btn btn-info btn-sm' data-toggle='tooltip' data-placement='top' title='View Details' type='button' onclick='formsub1(".$adminid.");' herf='#' ><i class='fa fa-eye'></i><form id='detailform".$adminid."' style='display: none' method='post' action='admindetails.php'><input type='hidden' name='aid' value='".$adminid."'/></form></a>&nbsp;<a class='btn btn-primary btn-sm' data-toggle='tooltip' data-placement='top' title='Edit Admin' type='button' onclick='formsub(".$adminid.");'><i class='fa fa-edit'></i><form id='viewform".$adminid."' style='display: none' method='post' action='editadmin.php'><input type='hidden' name='aid' value='".$adminid."'/></form></a>&nbsp;";
											if($empstat==0):
												echo "<button id='deletebtn".$adminid."' data-toggle='tooltip' data-placement='top' title='Terminate Admin' class='btn btn-danger btn-sm' onclick='javascript: return terminate(".$adminid.");' type='button'><i class='fa fa-trash'></i></button></td>";
											else:
												echo '<button id="activebtn'.$adminid.'" data-toggle="tooltip" data-placement="top" title="Continue Admin" class="btn btn-success btn-sm" onclick="javascript: return activeadmin('.$adminid.',\''.$name.'\');" type="button"><i class="fa fa-check-circle"></i></button></td>';
											endif;
											$row_count++;
										}
										?>
									</tbody>
									<!--tfoot>
										<tr>
											<th>Rendering engine</th>
											<th>Browser</th>
											<th>Platform(s)</th>
											<th>Engine version</th>
											<th>CSS grade</th>
										</tr>
									</tfoot-->
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
<script src="js/functions.js"></script>

<script src="plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/js/dataTables.bootstrap.min.js"></script>
<script src="plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables/js/jszip.min.js"></script>
<script src="plugins/datatables/js/pdfmake.min.js"></script>
<script src="plugins/datatables/js/vfs_fonts.js"></script>
<script src="plugins/datatables/extensions/Buttons/js/buttons.html5.js"></script>
<script src="plugins/datatables/extensions/Buttons/js/buttons.colVis.js"></script>
<script src="plugins/datatables/js/dataTables-script.js"></script>
<script src="js/loader.js"></script>
<script>
function formsub(id){
	$("#viewform"+id).submit();
}

function formsub1(id){
	$("#detailform"+id).submit();
}

function terminate(id)
{
	var x = confirm("Are you sure you want to Delete this Staff?");
	if (x==true)
	{
		$.ajax({
			type:"POST",
			url: 'ajax/terminateadmin.php',
			data:{'adminid':id},
			success: function(response){
				if(response == 1)
				{
					
					$("#admintable").load(location.href+" #admintable>*","");
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

function activeadmin(id,name)
{
	var x = confirm("Are you sure you want to Continue this Staff?");
	if (x==true)
	{
		$.ajax({
			type:"POST",
			url: 'ajax/activeadmin.php',
			data:{'adminid':id},
			success: function(response){
				if(response == 1)
				{
					alert(name+" is active from now onwards");
					$("#admintable").load(location.href+" #admintable>*","");
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

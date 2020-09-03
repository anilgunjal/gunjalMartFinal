<?php 
$page_id = "20";
require_once('header.php'); ?>
	<!-- Main content -->
	<div class="main-content">
		<h1 class="page-title">View Users</h1>
		<!-- Breadcrumb -->
		<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
			<li class="active"><a href="allusers.php">Reviews</a></li> 
			
		</ol>
		<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<h4 class="panel-title">All Users</h4>
							<ul class="panel-tool-options"> 
								<li><a data-rel="collapse" href="products#"><i class="icon-down-open"></i></a></li>
								<li><a data-rel="reload" href="products#"><i class="icon-arrows-ccw"></i></a></li>
							</ul>
						</div>
						<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover dataTables-example" id="producttable">
									<thead>
										<tr>
											<th>Sr. no</th>
											<th>User Name</th>
											<th>Email</th>
											<th>Contact</th>
											<th>Number Of Review</th>
											<th>Total Points</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									
										<?php
										$row_count = 1;
										$stmt = $mysqli->prepare("SELECT userid, username, email, contact from users;");
										$stmt->execute ();
										$stmt->bind_result ( $u_id, $username, $email, $contact);
										$stmt->store_result ();
										while($row = $stmt->fetch ())
										{
											$stmti = $mysqli->prepare("SELECT count(id) as review from reviewstat where userid = '$u_id';");
											$stmti->execute ();
											$stmti->bind_result ($review);
											$stmti->store_result ();
											$stmti->fetch ();
											
											$stmtii = $mysqli->prepare("SELECT SUM(points) as points from points where userid = '$u_id';");
											$stmtii->execute ();
											$stmtii->bind_result ($points);
											$stmtii->store_result ();
											$stmtii->fetch ();
											
											echo "<tr id='product".$u_id."'>";
											echo "<td>".$row_count."</td>";
											echo "<td>".$username."</td>";
											echo "<td>".$email."</td>";
											echo "<td>".$contact."</td>";
											echo "<td>".$review."</td>";
											echo "<td>".$points."</td>";
											echo "<td><button id='deletebtn".$u_id."' data-toggle='tooltip' data-placement='top' title='Terminate Admin' class='btn btn-danger btn-sm' onclick='javascript: return terminate(".$u_id.");' type='button'><i class='fa fa-trash'></i></button></td>";
											echo "<tr>";
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
	function formsub(id)
	{
		$("#viewform"+id).submit();
	}
	function usersub(id)
	{
		$("#userform"+id).submit();
	}
	
	function deletepro(id)
	{
		var p_id = id;
		var x = confirm("Are you sure you want to Delete this Product?");
		if (x==true)
		{
			
			$.ajax({
				type:"POST",
				url:"ajax/deleteproduct.php",
				data: {'p_id':p_id},
				success: function(response){
					if(response == 1)
					{
						$("#product"+id).fadeOut(1000);
						$("#producttable").load(location.href+" #producttable>*","");
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
	function terminate(id)
{
	var x = confirm("Are you sure you want to Delete this User?");
	if (x==true)
	{
		$.ajax({
			type:"POST",
			url: 'ajax/terminateuser.php',
			data:{'userid':id},
			success: function(response){
				if(response == 1)
				{
					
					$("#producttable").load(location.href+" #producttable>*","");
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

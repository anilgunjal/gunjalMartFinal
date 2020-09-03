<?php 
$page_id = "16";
require_once('header.php'); ?>
	<!-- Main content -->
	<div class="main-content">
		<h1 class="page-title">Approved(Review not Included) Reviews</h1>
		<!-- Breadcrumb -->
		<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
			<li class="active"><a href="reviews.php">Reviews</a></li> 
			<li class="active"><strong>Approved(Review not Included) Reviews</strong></li> 
		</ol>
		<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<h4 class="panel-title">Approved(Review not Included) Reviews</h4>
							<ul class="panel-tool-options"> 
								<li><a data-rel="collapse" href="products#"><i class="icon-down-open"></i></a></li>
								<li><a data-rel="reload" href="products#"><i class="icon-arrows-ccw"></i></a></li>
							</ul>
						</div>
						<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover dataTables-example" id="reviewtable">
									<thead>
										<tr>
											<th>Sr. no</th>
											<th>Product</th>
											<th>User</th>
											<th>Store</th>
											<th>Comment</th>
											<th>Invoice</th>
											<th>Status</th>
											<th>Date</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$row_count = 1;
										$stmt = $mysqli->prepare("SELECT reviewstat.id,reviewstat.product_name, users.userid, users.username, reviewstat.store,reviewstat.comment,reviewstat.invoice,reviewstat.status,reviewstat.createdDate FROM reviewstat INNER JOIN users ON reviewstat.userid = users.userid WHERE reviewstat.status = '2' ORDER BY reviewstat.id DESC;");
										$stmt->execute ();
										$stmt->bind_result ( $r_id, $product_name, $userid, $username, $store, $comments, $invoice, $status, $createdDate);
										$stmt->store_result ();
										while($row = $stmt->fetch ())
										{
											echo "<tr id='review".$r_id."'>";
											echo "<td>".$row_count."</td>";
											echo "<td>".$product_name."</td>";
											echo "<td><a href='#' onclick='usersub(".$r_id.");'><form id='userform".$r_id."' style='display: none' method='post' action='userdetails.php' target='_blank'><input type='hidden' name='uid' value='".$userid."'/></form>".$username."</a></td>";
											echo "<td>".$store."</td>";
											echo "<td>".$comments."</td>";
											echo "<td><a href='../".$invoice."' target='_blank' class='btn btn-xs btn-info btn-outline'> View Invoice</a></td>";
											echo "<td>";
												if($status==0){ echo '<b>Pending</b>'; } elseif($status==1) { echo '<b>Approved</b>'; } elseif($status==2) { echo '<b>Approved(Review not Included)</b>'; } elseif($status==3) { echo '<b>Second Review</b>'; } else { echo '<b>Rejected</b>';}
											echo "</td>";
											echo "<td>". date('d-m-Y h:i:s a',strtotime($createdDate));"</td>";
											echo "<td><a id='editbtn".$r_id."' class='btn btn-info btn-xs' type='button' onclick='formsub(".$r_id.");'><form id='viewform".$r_id."' style='display: none' method='post' action='editreview.php'><input type='hidden' name='rid' value='".$r_id."'/><input type='hidden' name='page' value='appprovednotreviews.php'/><input type='hidden' name='page_id' value='".$page_id."'/></form><i class='fa fa-edit'></i></a>&nbsp;<button id='deleterevbtn".$r_id."' class='btn btn-danger btn-xs' type='button' onclick='javascript: return deletereviews(".$r_id.");'><i class='fa fa-trash-o'></i></button></td></tr>";
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
	
	function deletereviews(id)
	{
		var r_id = id;
		var x = confirm("Are you sure you want to Delete this Review?");
		if (x==true)
		{
			
			$.ajax({
				type:"POST",
				url:"ajax/deletereview.php",
				data: {'r_id':r_id},
				success: function(response){
					if(response == 1)
					{
						$("#review"+id).fadeOut(1000);
						$("#reviewtable").load(location.href+" #reviewtable>*","");
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

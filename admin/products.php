<?php 
$page_id = "8";
require_once('header.php'); ?>
	<!-- Main content -->
	<div class="main-content">
		<h1 class="page-title">View Products</h1>
		<!-- Breadcrumb -->
		<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
			<li class="active"><strong>Products</strong></li> 
		</ol>
		<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<h4 class="panel-title">Product List</h4>
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
											<th>Category</th>
											<th>P. Name(En) </th>
											<th>P. Name(Mt) </th>
											<th>P. Descrip(En) </th>
											<th>P. Descrip(Mt) </th>
											<th>Price</th>
											<th>Discount Price</th>
											<th>Unit</th>
											<th>Size</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$row_count = 1;
										$stmt = $mysqli->prepare("SELECT id, category, name_english, name_marathi, details_english, details_marathi, proimage, final_price, discount_price, unit, size, status FROM products ORDER BY id DESC;");
										$stmt->execute ();
										$stmt->bind_result ( $id, $category, $name_english, $name_marathi, $details_english, $details_marathi, $proimage, $final_price, $discount_price, $unit, $size, $status );
										$stmt->store_result ();
										while($row = $stmt->fetch ())
										{
											echo "<tr id='product".$id."'>";
											echo "<td>".$row_count."</td>";
											echo "<td>".$category."</td>";
											echo "<td>". $name_english ."</td>";
											echo "<td>". $name_marathi ."</td>";
											echo "<td>". substr($details_english,0,50)."..."."</td>";
											echo "<td>". substr($details_marathi,0,50)."..."."</td>";
											echo "<td>".$final_price."</td>";
											echo "<td>".$discount_price."</td>";
											echo "<td>".$unit."</td>";
											echo "<td>".$size."</td>";
											echo "<td>".$status."</td>";
											echo "<td><a id='editbtn".$id."' class='btn btn-info btn-sm' type='button' onclick='formsub(".$id.");'><form id='viewform".$id."'  style='display: none' method='post' action='editproduct.php'><input type='hidden' name='id' value='".$id."'/></form><i class='fa fa-edit'></i></a><button id='deleteprobtn".$id."' class='btn btn-danger btn-sm' type='button' onclick='javascript: return deletepro(".$id.");'><i class='fa fa-trash-o'></i></button></td>";
											echo "</tr>";
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
</script>
</body>
</html>

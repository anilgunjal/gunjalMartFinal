<?php 
$page_id = "1";
require_once('header.php'); ?>
		<!-- Main content -->
		<div class="main-content">
		
			<h1 class="page-title">Dashboard</h1>
			<br>
			
			<!-- Row-->
			<?php
			$stmth = $mysqli->prepare("SELECT count(*) as product_total FROM products;");
			$stmth->execute ();
			$stmth->bind_result ( $product_total);
			$stmth->store_result ();
			$stmth->fetch ();
			
			
			$stmthiii = $mysqli->prepare("SELECT count(*) as users_total FROM users;");
			$stmthiii->execute ();
			$stmthiii->bind_result ( $users_total);
			$stmthiii->store_result ();
			$stmthiii->fetch ();
			?>
			<div class="row">
				<div class="col-lg-4 col-sm-6">
					<div class="panel minimal secondary-bg">
						<div class="panel-body">
							<h2 class="no-margins"><strong><?php echo $product_total;?></strong></h2>
							<p>No Of products.</p>
							<div class="float-chart-sm pt-15">
								<div id="online-signup" class="flot-chart-content"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-sm-6">
					<div class="panel minimal info-bg">
						<div class="panel-body">
							<h2 class="no-margins"><strong><?php echo $users_total;?></strong></h2>
							<p>Total Users</p>
							<div class="float-chart-sm pt-15">
								<div id="online-signup4" class="flot-chart-content"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /row-->
			
			<!-- Row -->
			
			<!-- Row-->
			
			<!-- Row-->
			
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

<!--Knob Charts-->
<script src="plugins/knob/js/jquery.knob.min.js"></script>

<!--Jvector Map-->
<script src="plugins/jvectormap/js/jquery-jvectormap-2.0.3.min.js"></script>
<script src="plugins/jvectormap/js/jquery-jvectormap-world-mill-en.js"></script>

<!--ChartJs-->
<script src="plugins/chartjs/js/Chart.min.js"></script>

<!--Morris Charts-->
<script src="plugins/morris/js/raphael-min.js"></script>
<script src="plugins/morris/js/morris.min.js"></script>

<!--Float Charts-->
<script src="plugins/flot/js/jquery.flot.min.js"></script>
<script src="plugins/flot/js/jquery.flot.tooltip.min.js"></script>
<script src="plugins/flot/js/jquery.flot.resize.min.js"></script>
<script src="plugins/flot/js/jquery.flot.pie.min.js"></script>
<script src="plugins/flot/js/jquery.flot.time.min.js"></script>

<!--Functions Js-->
<script src="js/functions.js"></script>

<!--Dashboard Js-->
<script src="js/dashboard.js"></script>

<script src="js/loader.js"></script>

</body>
</html>

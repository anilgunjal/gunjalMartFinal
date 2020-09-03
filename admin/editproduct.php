<?php 
$page_id = "8";
require_once('header.php'); ?>
	<!-- Main content -->
	<div class="main-content">
		<h1 class="page-title">Edit Products</h1>
		<!-- Breadcrumb -->
		<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="index.php"><i class="fa fa-home"></i>Home</a></li> 
			<li><a href="products.php">Products</a></li> 
			<li class="active"><strong>Edit Products</strong></li> 
		</ol>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading clearfix">
						<h4 class="panel-title">Edit Products</h4>
						<ul class="panel-tool-options"> 
							<li><a data-rel="collapse" href="subcategories.php#"><i class="icon-down-open"></i></a></li>
							<li><a data-rel="reload" href="subcategories.php#"><i class="icon-arrows-ccw"></i></a></li>
							<li><a data-rel="close" href="subcategories.php#"><i class="icon-cancel"></i></a></li>
						</ul>
					</div>
					<?php
						$pid = $_POST['id'];
						$stmt = $mysqli->prepare("SELECT id, category, name_english, name_marathi, details_english, details_marathi, proimage, final_price, discount_price, unit, size, status FROM products WHERE id = ?;");
						$stmt->bind_param('i',$pid);
						$stmt->execute ();
						$stmt->bind_result ( $id, $category, $name_english, $name_marathi, $details_english, $details_marathi, $proimage, $final_price, $discount_price, $unit, $size, $status);
						$stmt->store_result ();
						$stmt->fetch ();
					?>
					<div class="panel-body">
						<div id="successbox" class="alert alert-dismissable alert-success col-sm-offset-2" style="width:30%; display:none">
							<i class="ion-checkmark"></i>&nbsp; Product Edited Successfully
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						</div>
						 <form class="form-horizontal" id="editproductform" method="POST">
						 <input type="hidden" name="pid" value="<?php echo $id;?>">
						 <input type="hidden" name="addeditmore" id="addeditmore" value="0">
						 	<div class="form-group"> 
								<label class="col-sm-2 control-label">Category</label> 
								<div class="col-sm-6"> 
									<select class="form-control" name="cname" required> 
										<option value="">Select Category</option>
										<option value="Vegetables">Vegetables</option>
										<option value="Fruits">Fruits</option>
										<option value="Milk">Milk</option>
									</select>
								</div> 
							</div>
							<div class="line-dashed"></div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label">Product Name (English)</label> 
								<div class="col-sm-6"> 
									<input type="text" name="product_name_english" placeholder="Enter Product Name (English)" value="<?php echo $name_english;?>" class="form-control">
								</div>
							</div>
							<div class="line-dashed"></div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label">Product Name (Marathi)</label> 
								<div class="col-sm-6"> 
									<input type="text" name="product_name_marathi" placeholder="Enter Product Name (Marathi)" value="<?php echo $name_marathi;?>" class="form-control">
								</div>
							</div>
							<div class="line-dashed"></div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label">Product Price.</label> 
								<div class="col-sm-6"> 
									<input type="text" name="proPrice" placeholder="Enter Price" class="form-control" value="<?php echo $final_price;?>"> 
								</div>
							</div>
							<div class="line-dashed"></div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label">Product Discount Price.</label> 
								<div class="col-sm-6"> 
									<input type="text" name="proDiscountPrice" placeholder="Enter Product Discount Price" value="<?php echo $discount_price;?>" class="form-control">
								</div>
							</div>
							<div class="line-dashed"></div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label">Product Unit.</label> 
								<div class="col-sm-6"> 
									<input type="text" name="proUnit" placeholder="Enter Product Unit" class="form-control" value="<?php echo $unit;?>">
								</div>
							</div>
							<div class="line-dashed"></div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label">Product Size</label> 
								<div class="col-sm-6"> 
									<input type="text" name="proSize" placeholder="Enter Product Size" class="form-control" value="<?php echo $size;?>">
								</div>
							</div>
							<div class="line-dashed"></div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label">Product Image.</label> 
								<div class="col-sm-8"> 
								<div class="col-sm-9"> 
									<input type="file" name="files" id="files" class="form-control" style="float:left;" />
								</div>
								<div class="col-sm-3"> 
									<img src="<?php echo $proimage;?>" id="pimage" class="form-control" style="height:100px; width:100px; float:right;"/>
								</div>
								</div>
							</div>
							<div class="line-dashed"></div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label">Product Description (English)</label> 
								<div class="col-sm-6"> 
									<textarea type="text" name="prodescpEnglish" placeholder="Enter Product Description(English)" class="form-control ckeditor"><?php echo $details_english;?></textarea>
								</div>
							</div>
							<div class="line-dashed"></div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label">Product Description (Marathi)</label> 
								<div class="col-sm-6"> 
									<textarea type="text" name="prodescpMarathi" placeholder="Enter Product Description(Marathi)" class="form-control ckeditor"><?php echo $details_marathi;?></textarea>
								</div>
							</div>
							<div class="line-dashed"></div>
							<div class="col-sm-offset-2" style="color:red !important; display:none; margin-top:1%" id="error"></div><br/>
							<div class="form-group"> 
								<div class="col-sm-offset-2 col-sm-10"> 
									<button class="btn btn-success btn-outline" id="addbtn" type="submit">Save <span style="display:none;" id="loading">&nbsp;<i class="fa fa-spinner fa-spin"></i></span></button>
									<a class="btn btn-default btn-outline"  type="button" href="products.php">Cancel</a>
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

<script type="text/javascript" src="plugins/ckeditor/ckeditor.js"></script>
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
$("#file").change(function(){
    readURL(this);
});

	var $insertBefore = $('#insertBefore');
			var $i = 0;
            $('#plusButton').click(function(){
              $i = $i+1;
              $('<div class="form-group addspec'+$i+'" style="margin-bottom:5px;"> ' + '<label class="col-sm-2 control-label">&nbsp;</label><div class="col-sm-6"><input type="text" name="editspecif[]" class="form-control" placeholder="Enter Specifications of Product"></div><div class="col-sm-2"><button class="btn btn-xs btn-danger" type="button" onclick="removeElement('+$i+')"><i class="fa fa-minus"></i></button> ' + ' </div> ').insertBefore($insertBefore);
			  $("#addeditmore").val($i);
		});
	
	function removeElement(id)
	{
		$( ".addspec"+id ).remove();
		$val = $("#addeditmore").val();
		$cnt =  $val - 1;
		$("#addeditmore").val($cnt);
	}
		
	$("#editproductform").on('submit',(function(e) {
		e.preventDefault();
		for ( instance in CKEDITOR.instances ) {
			CKEDITOR.instances[instance].updateElement();
		}
		
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
			data:new FormData(this),
			contentType: false,
			cache: false,
			processData:false,
			url:"ajax/editproduct.php",
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
						window.location.href='products.php';
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
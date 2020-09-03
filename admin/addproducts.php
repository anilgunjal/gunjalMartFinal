<?php
$page_id = "12";
 require_once('header.php'); ?>
	<!-- Main content -->
	<div class="main-content">
		<h1 class="page-title">Add Products</h1>
		<!-- Breadcrumb -->
		<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="index.php"><i class="fa fa-home"></i>Home</a></li> 
			<li><a href="products.php">Products</a></li> 
			<li class="active"><strong>Add Products</strong></li> 
		</ol>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading clearfix">
						<h4 class="panel-title">Add Products</h4>
						<ul class="panel-tool-options"> 
							<li><a data-rel="collapse" href="subcategories.php#"><i class="icon-down-open"></i></a></li>
							<li><a data-rel="reload" href="subcategories.php#"><i class="icon-arrows-ccw"></i></a></li>
							<li><a data-rel="close" href="subcategories.php#"><i class="icon-cancel"></i></a></li>
						</ul>
					</div>
					<div class="panel-body">
						<div id="successbox" class="alert alert-dismissable alert-success col-sm-offset-2" style="width:30%; display:none">
							<i class="ion-checkmark"></i>&nbsp; Product Added Successfully
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						</div>
						 <form class="form-horizontal" id="addproductform" method="POST">
						 <input type="hidden" name="adminid" value="<?php echo $admin_id;?>">
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
									<input type="text" name="product_name_english" placeholder="Enter Product Name (English)" class="form-control">
								</div>
							</div>
							<div class="line-dashed"></div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label">Product Name (Marathi)</label> 
								<div class="col-sm-6"> 
									<input type="text" name="product_name_marathi" placeholder="Enter Product Name (Marathi)" class="form-control">
								</div>
							</div>
							<div class="line-dashed"></div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label">Product Price.</label> 
								<div class="col-sm-6"> 
									<input type="text" name="proPrice" placeholder="Enter Price" class="form-control">
								</div>
							</div>
							<div class="line-dashed"></div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label">Product Discount Price.</label> 
								<div class="col-sm-6"> 
									<input type="text" name="proDiscountPrice" placeholder="Enter Product Discount Price" class="form-control">
								</div>
							</div>
							<div class="line-dashed"></div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label">Product Unit.</label> 
								<div class="col-sm-6"> 
									<input type="text" name="proUnit" placeholder="Enter Product Unit" class="form-control">
								</div>
							</div>
							<div class="line-dashed"></div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label">Product Size</label> 
								<div class="col-sm-6"> 
									<input type="text" name="proSize" placeholder="Enter Product Size" class="form-control">
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
									<img src="#" id="pimage" class="form-control" style="height:100px; width:100px; float:right;"/>
								</div>
								</div>
							</div>
							<div class="line-dashed"></div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label">Product Description (English)</label> 
								<div class="col-sm-6"> 
									<textarea type="text" name="prodescpEnglish" placeholder="Enter Product Description(English)" class="form-control ckeditor"></textarea>
								</div>
							</div>
							<div class="line-dashed"></div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label">Product Description (Marathi)</label> 
								<div class="col-sm-6"> 
									<textarea type="text" name="prodescpMarathi" placeholder="Enter Product Description(Marathi)" class="form-control ckeditor"></textarea>
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

$("#files").change(function(){
    readURL(this);
});

	var $insertBefore = $('#insertBefore');
			var $i = 1;
            $('#plusButton').click(function(){
              $i = $i+1;
              $('<div class="form-group addspec'+$i+'" style="margin-bottom:5px;"> ' + '<label class="col-sm-2 control-label">&nbsp;</label><div class="col-sm-6"><input type="text" name="specif[]" class="form-control" placeholder="Enter Specifications of Product"></div><div class="col-sm-2"><button class="btn btn-xs btn-danger" type="button" onclick="removeElement('+$i+')"><i class="fa fa-minus"></i></button> ' + ' </div> ').insertBefore($insertBefore);
		});
	
	function removeElement(id)
	{
		$( ".addspec"+id ).remove();
	}
		
	$("#addproductform").on('submit',(function(e) {
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
			url:"ajax/addproduct.php",
			success: function(response){
				if(response == 1)
				{
					$("#successbox").css('display','all');
					$("#successbox").show();
					$("#loading").css('display','none');
					$("#loading").hide();
					$("#addbtn").prop('disabled', false);
					$("#addproductform").trigger('reset');
					$("html, body").animate({ scrollTop: 0 }, "slow");
					$("#addproductform").load(location.href+" #addproductform>*","");
					setTimeout(function () {
						$("#successbox").css('display','none');
						$("#successbox").hide();
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
	
</script>
</body>
</html>
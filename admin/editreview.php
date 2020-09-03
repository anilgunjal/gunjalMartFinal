<?php 
$page_id = $_POST['page'];
require_once('header.php');
?>
	<style type="text/css">
	#ui-id-1{
		background-color:#dedee4;;
		z-index : 999;
		width : 298px;
	}
	.ui-menu-item {
		list-style-type: none;
		left:250px;
	}
	</style>
	<!-- Main content -->
	<div class="main-content">
		<h1 class="page-title">Edit Review</h1>
		<!-- Breadcrumb -->
		<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="index.php"><i class="fa fa-home"></i>Home</a></li> 
			<li><a href="reviews.php">Reviews</a></li> 
			<li class="active"><strong>Edit Review</strong></li> 
		</ol>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading clearfix">
						<h4 class="panel-title">Edit Review</h4>
						<ul class="panel-tool-options"> 
							<li><a data-rel="collapse" href="subcategories.php#"><i class="icon-down-open"></i></a></li>
							<li><a data-rel="reload" href="subcategories.php#"><i class="icon-arrows-ccw"></i></a></li>
							<li><a data-rel="close" href="subcategories.php#"><i class="icon-cancel"></i></a></li>
						</ul>
					</div>
					<?php
						$rid = $_POST['rid'];
						//echo "rid".$rid;
						//$page = $_POST['page'];
						$i = 0;
						$stmtu = $mysqli->prepare("UPDATE reviewstat SET read_by = '1' WHERE id ='$rid';");
						$stmtu->execute ();
		
						$stmt = $mysqli->prepare("SELECT reviewstat.id, reviewstat.scatid, reviewstat.catid, reviewstat.proid, users.userid, users.username, reviewstat.store,reviewstat.comment,reviewstat.invoice,reviewstat.invoice_date,reviewstat.product_name,reviewstat.sellername, reviewstat.status, reviewstat.admincomment, reviewstat.billnumber, reviewstat.createdDate FROM reviewstat INNER JOIN users ON reviewstat.userid = users.userid WHERE reviewstat.id = ?;");
						$stmt->bind_param('i',$rid);
						$stmt->execute ();
						$stmt->bind_result ( $r_id, $scatid, $catid, $proid, $userid, $username, $store, $comments, $invoice, $invoice_date, $product_name, $sellername, $status1, $admincomment,$bill_number, $createdDate);
						$stmt->store_result ();
						$stmt->fetch ();
						$seconds = date('s',strtotime($createdDate));
						$temppid = $scatid.$userid.$seconds;
						
							$stmti = $mysqli->prepare("SELECT count(*) as ptotal FROM products WHERE proname = '$product_name'");
							$stmti->execute();
							$stmti->bind_result($ptotal);
							$stmti->store_result();
							$stmti->fetch ();
					?>
					<div class="panel-body">
						<div id="successbox" class="alert alert-dismissable alert-success row" style="width:100%; display:none">
							<i class="ion-checkmark"></i>&nbsp; Review Edited Successfully
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						</div>
						 <form class="form-horizontal " id="editreviewform" method="POST">
						 <input type="hidden" name="adminid" value="<?php echo $admin_id;?>">
						 <input type="hidden" name="catid" value="<?php echo $catid;?>">
						 <input type="hidden" name="scatid" value="<?php echo $scatid;?>">
						 <input type="hidden" name="revid" value="<?php echo $rid;?>">
						 <input type="hidden" name="userid" value="<?php echo $userid;?>">
						 <input type="hidden" name="statusemp" value="<?php echo $status;?>">
						 <!--input type="hidden" name="page" value="<?php echo $page;?>"-->
						 <input type="hidden" name="temppid" value="<?php echo $temppid;?>">
						 <!--input type="hidden" name="pnamecount" value="<?php echo $n = $ptotal > 0 ? '1' : '0';?>"-->
						 
						 	<div class="form-group"> 
								<label class="col-sm-2 control-label">Product : </label> 
								<!--div class="col-sm-4">
									<?php if($ptotal > 0 ) {?>
									<input type="text" name="pname" class="form-control" value="<?php echo $product_name; ?>">
									<?php } else { ?>
									<input type="text" name="pname" id="pname" class="form-control" value="<?php echo $product_name; ?>" xonkeyup="hidebrow();">
									<input type="file" name="proimage" id="proimage" class="form-control" required>
									<?php } ?>
								</div--> 
								<div class="col-sm-4">
									<input type="text" name="pname" id="pname" class="form-control" value="<?php echo $product_name; ?>">
								</div> 
								<label class="col-sm-2 control-label">User name : </label>
								<div class="col-sm-4">
									<p style="margin-top:6px"><?php echo $username;?>
								</div> 
							</div>
							<div class="line-dashed"></div>
						 	<div class="form-group"> 
								<label class="col-sm-2 control-label">Seller Name : </label>
								<div class="col-sm-4"> 
									<?php 
									if($sellername == "")
									{
									?>
									<input type="text" name="sellername" id="sellername" placeholder="Please Enter Seller Name" class="form-control" required />
									<?php
									}
									else
									{
									?>
									<input type="text" name="sellername" id="sellername" placeholder="Please Enter Seller Name" class="form-control" value="<?php echo $sellername;?>" required/>
									<?php
									}
									?>
								</div> 
								<label class="col-sm-2 control-label">Comment : </label>
								<div class="col-sm-4"> 
									<textarea class="form-control" name="comments"><?php echo $comments;?></textarea>
								</div> 
							</div>
							<div class="line-dashed"></div>
							<div class="form-group"> 
                                <label class="col-sm-2 control-label">Invoice Date:</label> 
                                <div class="col-sm-4">
                                    <div id="date-popup" class="input-group date">
										<?php if($invoice_date == "")
										{
											?>
												<input type="text" name="invoicedate" placeholder="Choose Invoice Date" class="form-control" required > 
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
											<?php
										}
										else
										{
											?>
												<input type="text" name="invoicedate" placeholder="Choose Invoice Date" class="form-control" value ="<?php echo $invoice_date; 	?>"required > 
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
											<?php
										}
										?>
                                        
                                    </div>
                                </div> 
								<label class="col-sm-2 control-label">Bill Number : </label>
								<div class="col-sm-4"> 
								<?php 
								if($bill_number == "")
								{
								?>
								<input type="text" name="billnumber" id="billnumber" placeholder="Please Enter Bill Number" class="form-control" required />
								<?php
								}
								else
								{
								?>
								<input type="text" name="billnumber" id="billnumber" placeholder="Please Enter Bill Number" class="form-control" value="<?php echo $bill_number;?>" />
								<?php
								}
								?>
								</div>
                             </div>
							<div class="line-dashed"></div>
						 	<div class="form-group"> 
								<label class="col-sm-2 control-label">Admin Comment:</label> 
                                <div class="col-sm-10">
										<?php if($admincomment == "")
										{
											?>
												<textarea class="form-control" rows="5" cols= "4" name="admincomment"></textarea>
											<?php
										}
										else
										{
											?>
												<textarea class="form-control" rows="5" cols= "4" name="admincomment"><?php echo $admincomment;?></textarea>
											<?php
										}
										?>
                                </div>								
							</div>
							<div class="line-dashed"></div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label">Invoice : </label>
								<div class="col-sm-4"> 
									<p style="margin-top:6px"><a href='../<?php echo $invoice;?>' target='_blank' class='btn btn-xs btn-info btn-outline'> View Invoice</a></p>
								</div>
								<label class="col-sm-2 control-label">Review Date : </label> 
								<div class="col-sm-4"> 
									<p style="margin-top:6px"><?php echo date('d-m-Y h:i:s a',strtotime($createdDate));?></p>
								</div>
								<label class="col-sm-2 control-label">Store : </label>
								<div class="col-sm-4"> 
									<p style="margin-top:6px"><?php echo $store;?></p>
								</div>								
							</div>
							<div class="line-dashed"></div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label">Status : </label>
								<div class="col-sm-4"> 
									<select class="form-control" id= "statusid" name="status" onchange="checkstatus()" required> 
										<option value="">Select Status</option>
										<option value="0" <?php echo $s= $status1==0 ? 'selected' : '';?> >Pending</option>
										<?php
										if($status == 1){
										?>
										<option value="1" <?php echo $s= $status1==1 ? 'selected' : '';?> >Approved</option>
										<?php
										}else{echo "";}
										?>
										<option value="2" <?php echo $s= $status1==2 ? 'selected' : '';?> >Approved(Review not Included)</option>
										<option value="3" <?php echo $s= $status1==3 ? 'selected' : '';?> >Second Review</option>
										<option value="4" <?php echo $s= $status1==4 ? 'selected' : '';?> >Rejected</option>
									</select>	
								</div>
								 
								<label class="col-sm-2 control-label">Points Earned : </label>
								<?php
									$stmtp = $mysqli->prepare ( "SELECT count(*) as point FROM specification WHERE scatid = ?" );
									$stmtp->bind_param ( "i", $scatid);
									$stmtp->execute();
									$stmtp->bind_result ( $point );
									$stmtp->store_result ();
									$stmtp->fetch ();
									$point = $point * 10;
								?>
								<div class="col-sm-3"> 
									<input type="text" name="points" class="form-control" value="<?php echo $point;?>" readonly />
								</div>
								<div id = "checkstatusdiv">
								<label class="col-sm-2 control-label">Rejection Reason : </label>
								<div class="col-sm-4"> 
									<textarea class="form-control" id= "rejectcomment" name="comments"></textarea>
								</div> 
								</div>
							</div>
							<div class="line-dashed"></div>
							<div class="row">
								<div class="col-sm-4"><center><label class="control-label">Specifications</label></center></div>
								<div class="col-sm-4"><center><label class="control-label">Review</label></center></div>
								<div class="col-sm-4"><center><label class="control-label">Comment</label></center></div>
							</div>
							<div class="line-dashed"></div>
							<div class="form-group ratingg "> 
								<?php
								
								$stmti = $mysqli->prepare ( "SELECT spfid,specification FROM specification WHERE scatid = ?" );
								$stmti->bind_param ( "i", $scatid);
								if($stmti->execute())
								{
									
									$stmti->bind_result ($spfid,$specification);
									$stmti->store_result ();
									$specno = $stmti->num_rows;
									?><input type="hidden" class="star-input" id="spno" name="spno" value="<?php echo $specno;?>" /><?php
									$i = 1;
									
									while($stmti->fetch ())
									{
									/* echo "proid". $proid;
									echo "spfid". $spfid;
									echo "userid". $userid;
									 */	
										$stmtii = $mysqli->prepare ( "SELECT val,commentme FROM smiley WHERE proid = ? AND speid = ? AND userid = ? AND rid = ? " );
										$stmtii->bind_param ( "iiii", $proid, $spfid, $userid, $rid );
										$stmtii->execute();
										$stmtii->bind_result ( $val, $commentme );
										$stmtii->store_result ();
										while($stmtii->fetch ()) {
											
										?>
											<div class="row">
											<div class="col-sm-3" >
											   <label><strong><?php echo $specification;?></strong></label>
											</div>
											<div class="col-sm-9">
											   <input type="radio" class="input-hidden" id="<?php echo $spfid.'1';?>" name="<?php echo $i;?>" value="1" <?php echo $s = $val==1 ? 'checked' : 'disabled';?> />
											   <label  for="<?php echo $spfid.'1';?>" data-toggle="popover" data-content=Pathetic data-placement="auto">
											    <img 
											 src="images/23.png" 	
											 />
											   </label>
											   <input type="radio" class="input-hidden"  id="<?php echo $spfid.'2';?>" name="<?php echo $i;?>" value="2" <?php echo $s = $val==2 ? 'checked' : 'disabled';?> />
											   <label  for="<?php echo $spfid.'2';?>" data-toggle="popover" data-content="I didn't like it!" data-placement="auto">
											   <img 
											 src="images/37.png"  />
										  
											   </label>
											   <input type="radio" class="input-hidden"  id="<?php echo $spfid.'3';?>" name="<?php echo $i;?>" value="3" <?php echo $s = $val==3 ? 'checked' : 'disabled';?> />
											   <label  for="<?php echo $spfid.'3';?>" data-toggle="popover" data-content="It was Okay!" data-placement="auto">
											   <img 
											 src="images/88.png" />
										 
											   </label>
											   <input type="radio" class="input-hidden"  id="<?php echo $spfid.'4';?>" name="<?php echo $i;?>" value="4" <?php echo $s = $val==4 ? 'checked' : 'disabled';?> />
											   <label  for="<?php echo $spfid.'4';?>" data-toggle="popover" data-content="It was Good!" data-placement="auto">
											    <img src="images/01.png" />
											   </label>
											   <input type="radio"  class="input-hidden" id="<?php echo $spfid.'5';?>" name="<?php echo $i;?>" value="5" <?php echo $s = $val==5 ? 'checked' : 'disabled';?> />
											   <label  for="<?php echo $spfid.'5';?>" data-toggle="popover" data-content="Absolutely Loved it!" data-placement="auto">
											   <img 
											 src="images/25.png" 
											  />
											   </label>
											   <input type="radio"  class="input-hidden" id="<?php echo $spfid.'6';?>" name="<?php echo $i;?>" value="0" <?php echo $s = $val==0 ? 'checked' : 'disabled';?> />
											   <label  for="<?php echo $spfid.'6';?>" data-toggle="popover" data-content="N/A!" data-placement="auto">
											   <img 
											 src="images/89.png" 
											  />
											   </label>
											</div>
											<div class="col-sm-4" >
											   <label><strong><?php echo $commentme;?></strong></label>
											</div>
											</div>
										<?php
										}
										$i++;
								} } 
									?>
							</div>
							<div class="line-dashed"></div>
							<div class="col-sm-offset-2" style="color:red !important; display:none; margin-top:1%" id="error"></div><br/>
							<div class="form-group"> 
								<div class="col-sm-offset-2 col-sm-10"> 
									<button class="btn btn-success btn-outline" id="addbtn" type="submit">Save <span style="display:none;" id="loading">&nbsp;<i class="fa fa-spinner fa-spin"></i></span></button>
									<a class="btn btn-default btn-outline"  type="button" href="reviews.php">Cancel</a>
								</div> 
							</div>
						</form>
						<div id="pointsmodal" class="modal fade" tabindex="-1" role="dialog">
						  <div class="modal-dialog modal-md">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">Give Points to Users for this Review</h4>
							  </div>
							  <div class="modal-body">
								<div class="row">
									<form class="form-horizontal" id="pointsform" method="POST">
									<input type="hidden" name="userid" value="<?php echo $userid;?>">
									<input type="hidden" name="adminid" value="<?php echo $admin_id;?>">
									<input type="hidden" name="reviewid" value="<?php echo $rid;?>">
										<div class="form-group"> 
											<label class="col-sm-2 control-label">Points</label> 
											<div class="col-sm-4"> 
												<select class="form-control" name="points" required>
													<option value="">Select Points</option>
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
													<option value="6">6</option>
													<option value="7">7</option>
													<option value="8">8</option>
													<option value="9">9</option>
													<option value="10">10</option>
												</select>
											</div> 
										</div>
										<div class="form-group"> 
											<div class="col-sm-offset-2 col-sm-10">
												<button class="btn btn-success btn-outline" id="pointbtn" type="submit">Submit</button>
											</div>
										</div>
									</form>
								</div>
							  </div>
							  <div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								
							  </div>
							</div>
						  </div>
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

<script type="text/javascript">
 $('#date-popup').datepicker({
        keyboardNavigation: false,
        forceParse: false,
        todayHighlight: true,
        endDate: "+0d",
        format: "dd-mm-yyyy"
    });
	$(function() {
		$( "#pname" ).autocomplete({
			source: 'pnames.php',
			autoFocus:true
		});
	});
	
		/* $('#pname').on(function(){
			/* $("#proimage").css('display','none');
			$("#proimage").hide(500);
			alert('hello');
		}); */
	/* function hidebrow(){
		alert('hello');
	} */
	$('#billnumber').blur(function(){
		var x=$('#billnumber').val();
		if($('#billnumber').val()!="")
		{
			var ajaxdata = {};
			ajaxdata['billnumber'] = x;
			$.ajax({
				type:'post',
				url:'ajax/unique_bill.php',
				data:ajaxdata,
				success:function(res)
				{
					if(res != "")
					{
						alert(res);
						$('#billnumber').val('');
						$('#billnumber').focus();
					}
				}
			});
		}
		
	});
  
	$("#editreviewform").on('submit',(function(e) {
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
			url:"ajax/pendingedit.php",
			success: function(response){
				if(response = 1)
				{
					
					$("#successbox").css('display','all');
					$("#successbox").show();
					$("#loading").css('display','none');
					$("#loading").hide();
					$("#addbtn").prop('disabled', false);
					$("html, body").animate({ scrollTop: 0 }, "slow");
					setTimeout(function () {
						window.location.href = "reviews.php";
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
	
	$("#pointsform").on('submit',(function(e) {
		e.preventDefault();
		$("#pointbtn").prop('disabled', true);
		$.ajax({
			type:"POST",
			data:$("#pointsform").serialize(),
			url:"ajax/addpoints.php",
			success: function(response){
				if(response == 1)
				{
					alert('Points Added Successfully');
					location.reload();
				}
				else
				{
					alert(response);
					$("#pointbtn").prop('disabled', false);
				}
			},
			error: function(){
				alert("Error Occured");
			}
		
		});
	}));
	function checkstatus() 
	{
		var review_status = $("#statusid").val();
		if(review_status == "4")
		{
			$("#checkstatusdiv").show();
			$("#rejectcomment").prop('required',true);
		}
		else
		{
			$("#checkstatusdiv").hide();
			$("#rejectcomment").prop('required',false);
		}
	}
</script>
<script>
$(document).ready(function(){
    $("input:checked  + label>img").css("filter", "contrast(100%)");
    $("input:not(:checked)  + label>img").css("filter", "opacity(30%)");
	$("#checkstatusdiv").hide();
	$("#rejectcomment").prop('required',false);
});
</script>

</body>
</html>
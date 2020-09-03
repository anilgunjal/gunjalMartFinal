<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="NAP Reviews">
<meta name="keywords" content="Responsive, Web Application, HTML5, Admin Template, business, professional, Integral, web design, CSS3">
<title>NAP Review | Login</title>
<!-- Site favicon -->
<link rel='shortcut icon' type='image/x-icon' href='images/favicon.ico' />
<!-- /site favicon -->

<!-- Entypo font stylesheet -->
<link href="css/entypo.css" rel="stylesheet">
<!-- /entypo font stylesheet -->

<!-- Font awesome stylesheet -->
<link href="css/font-awesome.min.css" rel="stylesheet">
<!-- /font awesome stylesheet -->

<!-- Bootstrap stylesheet min version -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- /bootstrap stylesheet min version -->

<!-- Integral core stylesheet -->
<link href="css/integral-core.css" rel="stylesheet">
<!-- /integral core stylesheet -->

<link href="css/integral-forms.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
<![endif]-->


</head>
<body class="login-page">

<!-- Loader Backdrop -->
	<div class="loader-backdrop">           
	  <!-- Loader -->
		<div class="loader">
			<div class="bounce-1"></div>
			<div class="bounce-2"></div>
		</div>
	  <!-- /loader -->
	</div>
<!-- loader backgrop -->

<div class="login-container">
	<div class="login-branding">
		<a href="index.html"><img src="images/napreview_logo.png"alt="NAP Review" title="NAP Review" width="142" height="32"></a>
	</div>
	<div class="login-content">
		<div id="loginpart">
			<h2><strong>Welcome</strong>, please login<span class="pull-right"><a href="../" data-toggle="tooltip" data-placement="top" title="" data-original-title="Back to Website"><i class="fa fa-home"></i></a></span></h2>
			<form method="post" id="loginform" data-toggle="validator">                        
				<div class="form-group">					
					<input type="email" placeholder="Email" name="emailid" class="form-control" required>
				</div>                        
				<div class="form-group">
					<input type="password" placeholder="Password" name="password" class="form-control" required>
				</div>
				<!--div class="form-group">
					 <div class="checkbox checkbox-replace">
						<input type="checkbox" id="remeber">
						<label for="remeber">Remeber me</label>
					  </div>
				 </div-->
				 <div class="input-group" id="errormsg" style="display:none; padding-top:5px; padding-bottom:5px;color:#E82829; font-size:1.1em;text-align:center;"></div>
				<div class="form-group">
					<button class="btn btn-primary btn-block" type="submit" id="loginbtn">Login</button>
				</div>
				<p class="text-center"><a href="#" onclick="showforgot();">Forgot your password?</a></p>                        
			</form>
		</div>
		<div id="forwardpart" style="display:none;">
			<h2>Forgot your password?<span class="pull-right"><a href="../" data-toggle="tooltip" data-placement="top" title="" data-original-title="Back to Website"><i class="fa fa-home"></i></a></span></h2>
			<p>Don't worry, we'll send you an email to reset your password.</p>
			<form method="post" id="forgotform">                        
				<div class="form-group">
					<input type="text" placeholder="Your Email" name="resetemail" id="resetemail" class="form-control" required>
				</div>
				<div class="input-group" style="display:none; padding-top:5px; padding-bottom:5px;color:#E82829; font-size:1.1em;text-align:center;" id="error">Hello</div>
				<div class="form-group">
					<button class="btn btn-primary btn-block">Reset Password <span style="display:none;" id="loading">&nbsp;<i class="fa fa-spinner fa-spin"></i></span></button>
				</div>
			</form>
			<div class="panel panel-success" id="successbox" style="display:none;">
			  <div class="panel-heading">Login with new Password Mailed to You.</div>
			</div>
			<p>Get back to <a href="#" onclick="hideforgot();">Login</a>.</p>
		</div>
	</div>
</div>

<!--Load JQuery-->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/loader.js"></script>
<script>
	$('[data-toggle="tooltip"]').tooltip();
</script>
<script>
	function showforgot(){
		$("#forwardpart").css('display','all');
		$("#forwardpart").fadeIn(500);
		$("#loginpart").css('display','none');
		$("#loginpart").fadeOut(500);
	}
	
	function hideforgot(){
		$("#forwardpart").css('display','none');
		$("#forwardpart").fadeOut(500);
		$("#loginpart").css('display','all');
		$("#loginpart").fadeIn(500);
	}
	
	$("#loginform").on('submit',(function(e) {
		e.preventDefault();
		
		var formdata = $("#loginform").serialize();
		
		$.ajax({
			type:"POST",
			data:formdata,
			url:"ajax/checklogin.php",
			success: function(response){
				if(response == 1)
				{
					
					window.location.href="index.php";
				}
				else
				{
					$("#errormsg").html(response);
					$("#errormsg").css('display','all');
					$("#errormsg").show();
					setTimeout(function () {
						$("#errormsg").css('display','none');
						$("#errormsg").fadeOut(500);
					}, 8000);
				}
			},
			error: function(){
				alert("Error Occured");
			}
		
		});
	}));
	
	$("#forgotform").on('submit',(function(e) {
		e.preventDefault();
		$("#loading").css('display','all');
		$("#loading").show();
		var formdata = $("#forgotform").serialize();
		$.ajax({
			type:"POST",
			data:formdata,
			url:"ajax/forgotpass.php",
			success: function(response){
				if(response == 1)
				{
					$("#loading").css('display','none');
					$("#loading").hide();
					$("#forgotform").css('display','none');
					$("#forgotform").fadeOut(1000);
					$("#successbox").css('display','all');
					$("#successbox").fadeIn(1000);
				}
				else
				{
					$("#loading").css('display','none');
					$("#loading").hide();
					$("#error").html(response);
					$("#error").css('display','all');
					$("#error").show();
					$("#resetemail").val("");
					setTimeout(function () {
						$("#error").css('display','none');
						$("#error").fadeOut(500);
					}, 7000);
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

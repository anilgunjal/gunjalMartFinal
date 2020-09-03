$(document).ready(function () {
	$('#mobile').keyup(function(){
	var val = $(this).val();
	if(isNaN(val)){
		 val = val.replace(/[^0-9]/g,'');
	}
	$(this).val(val);
});
$("#mobile").blur(function(){
	var val = $(this).val();
	if(val.length >= 15){
		$(this).val('');
		$(".error").html("Mobile No should be less than 15 digits");
		$(".error").css('display','block');
		setTimeout(function () {
			$(".error").css('display','none');
			$(".error").hide();
		}, 5000);
	}
	
})
$("#email").blur(function(){
	var val = $(this).val();
	if(val.length >= 50){
		$(this).val('');
		$(".error").html("Email value should be less than 50 characters");
		$(".error").css('display','block');
		setTimeout(function () {
			$(".error").css('display','none');
			$(".error").hide();
		}, 5000);
	}
	
})
$("#name").blur(function(){
	var val = $(this).val();
	if(val.length >= 50){
		$(this).val('');
		$(".error").html("Name should be less than 50 characters");
		$(".error").css('display','block');
		setTimeout(function () {
			$(".error").css('display','none');
			$(".error").hide();
		}, 5000);
	}
	
})
	
$("#register").on('submit',(function(e) {
	e.preventDefault();
	var name_length = $('#name').val().length;
	var email_length = $('#email').val().length;
	var password_length = $('#password').val().length;
	var mobile_length = $('#mobile').val().length;
	if(name_length == 0 || password_length == 0 || mobile_length == 0){
		$(".error").html("All fields are required");
		$(".error").css('display','block');
		setTimeout(function () {
			$(".error").css('display','none');
			$(".error").hide();
		}, 5000);
	}
	else{
		$("#regbtn").prop('disabled', true);
		$("#loading").css('display','all');
		$("#loading").fadeIn(500);
		$.ajax({
			type:"POST",
			data:$("#register").serialize(),
			url:"http://localhost:8000/api/register",
			success: function(response){
				if(response.status)
				{
					$("#register").trigger('reset');	
					$("#regbtn").prop('disabled', false);
					$("#loading").css('display','none');
					$("#loading").fadeOut(500);
					$(".success").html("You have registerd successfully");
					$(".success").css('display','block');
					setTimeout(function () {
						$(".success").css('display','none');
						$(".success").hide();
					}, 5000);
					/* setTimeout(function () {
						$("#successmsg").css('display','none');
						$("#successmsg").fadeOut(500);
					}, 5000); */
				}
				else
				{
					$("#errmsg").html(response);
					$("#error").css('display','all');
					$("#error").fadeIn();
					$("#regbtn").prop('disabled', false);
					$("#loading").css('display','none');
					$("#loading").fadeOut(500);
					setTimeout(function () {
						$("#error").css('display','none');
						$("#error").hide();
					}, 6000);
					$(".error").html(response.error);
					$(".error").css('display','block');
					setTimeout(function () {
						$(".error").css('display','none');
						$(".error").hide();
					}, 5000);
				}
			},
			error: function(){
				$("#regbtn").prop('disabled', false);
				$(".error").html("Something went wrong");
				$(".error").css('display','block');
				setTimeout(function () {
					$(".error").css('display','none');
					$(".error").hide();
				}, 5000);
			}
		
		});
	}	
	}));
});

$(document).ready(function () {
$("#login").on('submit',(function(e) {
	e.preventDefault();
	var email_length = $('#email').val().length;
	var password_length = $('#password').val().length;
	if(email_length == 0 || password_length == 0){
		$(".error").html("All fields are required");
		$(".error").css('display','block');
		setTimeout(function () {
			$(".error").css('display','none');
			$(".error").hide();
		}, 5000);
	}
	else{
		$("#loginbtn").prop('disabled', true);
		$("#loading").css('display','all');
		$("#loading").fadeIn(500);
		$.ajax({
			type:"POST",
			data:$("#login").serialize(),
			url:"http://localhost:8000/api/login",
			success: function(response){
				console.log(response);
				if(response.status)
				{
					$("#login").trigger('reset');	
					$("#loginbtn").prop('disabled', false);
					$("#loading").css('display','none');
					$("#loading").fadeOut(500);
					$(".success").html("You have registerd successfully");
					$(".success").css('display','block');
					setTimeout(function () {
						$(".success").css('display','none');
						$(".success").hide();
					}, 5000);
				}
				else
				{
					$("#errmsg").html(response);
					$("#error").css('display','all');
					$("#error").fadeIn();
					$("#loginbtn").prop('disabled', false);
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
				$("#loginbtn").prop('disabled', false);
				$("#loading").css('display','none');
				$("#loading").fadeOut(500);
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

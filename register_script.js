$(document).ready(function () {
	$("#submit").click(function(){
		//Verify entered passwords match
		if($("#password1").val() != $("#password2").val()) {
			$("#response").html("Passwords do not match.");
		} else {
			var formData = {
				username: $("#username").val(),
				password1: $("#password1").val(),
				password2: $("#password2").val(),
				is_ajax: 1
			};

			//post to validateReg.php
			$.ajax({
				type: "POST",
				url: "validateReg.php",
				data: formData,
				success: function(response) {
					console.log(response);
					if(response == "registered") {
						//Registration successful
						$("#success").html("Registration successful. Redirecting to login page.<p><a href=\"login.php\">Click here to go back.</a></p>");
						$("#response").html("");
						//Redirect to login page
						setTimeout(function() {
							window.location.href = "login.php";
						}, 2000);
					} else if(response == "duplicate") {
						//Username already exists
						$("#response").html("A user with that name already exists.");
						$("#success").html("");
					}
				}
			});
		}

		return false;
	});
});
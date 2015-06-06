$(document).ready(function () {
	$("#submit").click(function(){
		//Check for blank entries
		if($("#username").val() == "") {
			$("#response").html("Enter a username.");
		} else if($("#firstname").val() == "") {
			$("#response").html("Enter your first name.");
		} else if($("#lastname").val() == "") {
			$("#response").html("Enter your last name.");
		} else if($("#password1").val() == "") {
			$("#response").html("Enter a password.");
		} else if($("#password1").val() != $("#password2").val()) { //Verify entered passwords match
			$("#response").html("Passwords do not match.");
		} else { //All info is entered
			var formData = {
				username: $("#username").val(),
				password1: $("#password1").val(),
				password2: $("#password2").val(),
				firstname: $("#firstname").val(),
				lastname: $("#lastname").val(),
				is_ajax: 1
			};

			//post to validateReg.php
			$.ajax({
				type: "POST",
				url: "validateReg.php",
				data: formData,
				success: function(response) {
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
						$("#response").html("The specified username already exists.");
						$("#success").html("");
					}
				}
			});
		}

		return false;
	});
});
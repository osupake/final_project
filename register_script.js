$(document).ready(function () {
	$("#submit").click(function(){
		if($("#password1").val() != $("#password2").val()) {
			$("#response").html("Passwords do not match.");
		} else {
			var formData = {
				username: $("#username").val(),
				password1: $("#password1").val(),
				password2: $("#password2").val(),
				is_ajax: 1
			};

			console.log(formData);

			$.ajax({
				type: "POST",
				url: "validateReg.php",
				data: formData,
				success: function(response) {
					if(response == "registered") {
						
						$("#success").html("Registration complete. Click <a href=\"login.php\">here</a> to login.");
					} else {
						//Username already exists
						$("#response").html("A user with that name already exists.");
					}
				}
			});
		}

		return false;
	});
});
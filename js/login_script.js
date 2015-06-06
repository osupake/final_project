$(document).ready(function () {
	$("#submit").click(function(){
		var formData = {
			username: $("#username").val(),
			password: $("#password").val(),
			is_ajax: 1
		};

		$.ajax({
			type: "POST",
			url: "validate.php",
			data: formData,
			success: function(response) {
				if(response == "correct") {
					//Successful login redirect 
					window.location = "index.php";
				} else {
					$("#response").html("Login failed. Please try again");
				}
			}
		});

		return false;
	});
});
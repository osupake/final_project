$(document).ready(function () {
	$("#submitLoc").click(function(){
		//Check for blank entries
		if($("#locName").val() == "") {
			$("#responseLoc").html("Enter a venue name.");
		} else if($("#locAdd").val() == "") {
			$("#responseLoc").html("Enter an address.");
		} else if($("#locCity").val() == "") {
			$("#responseLoc").html("Enter a city.");
		} else if($("#locState").val() == "") {
			$("#responseLoc").html("Enter a state.");
		} else { //All info is entered
			var formData = {
				locName: $("#locName").val(),
				locAdd: $("#locAdd").val(),
				locCity: $("#locCity").val(),
				locState: $("#locState").val(),
				is_ajax: 1
			};

			//post to addLocation.php
			$.ajax({
				type: "POST",
				url: "addLocation.php",
				data: formData,
				success: function(response) {
					if(response == "added") {
						//entry added
						$("#successLoc").html("Location successfully added.");
						$("#responseLoc").html("");
					} else if(response == "duplicate") {
						//duplicate entry
						$("#responseLoc").html("That venue already exists");
						$("#successLoc").html("");
					}
				}
			});
		}

		return false;
	});
});
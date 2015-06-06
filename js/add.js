$(document).ready(function () {
	//add location
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
						$("#successLoc").html("Location successfully added.").delay(3000).fadeOut(400);
						$("#responseLoc").html("");
					} else if(response == "duplicate") {
						//duplicate entry
						$("#responseLoc").html("That venue already exists.").delay(3000).fadeOut(400);
						$("#successLoc").html("");
					}
				}
			});
		}

		return false;
	});

	//add event
	$("#submitEvent").click(function(){
		//Check for blank entries
		if($("#eventName").val() == "") {
			$("#responseEvent").html("Enter an event name.");
		} else if($("#eventCost").val() == "") {
			$("#responseEvent").html("Enter a cost.");
		} else if($("#eventDate").val() == "") {
			$("#responseEvent").html("Enter a date.");
		} else { //All info is entered
			var formData = {
				eventName: $("#eventName").val(),
				eventLoc: $("#eventLoc").val(),
				eventCost: $("#eventCost").val(),
				eventDate: $("#eventDate").val(),
				eventManager: $("#eventManager").val(),
				is_ajax: 1
			};

			//post to addEvent.php
			$.ajax({
				type: "POST",
				url: "addEvent.php",
				data: formData,
				success: function(response) {
					if(response == "added") {
						//entry added
						$("#successEvent").html("Event successfully added.").delay(3000).fadeOut(400);
						$("#responseEvent").html("");
					} else if(response == "duplicate") {
						//duplicate entry
						$("#responseEvent").html("That event already exists.").delay(3000).fadeOut(400);
						$("#successEvent").html("");
					}
				}
			});
		}

		return false;
	});

	//add volunteer
	$("#submitVol").click(function(){
		//Check for blank entries
		if($("#volLname").val() == "") {
			$("#responseVol").html("Enter a last name.");
		} else if($("#volFname").val() == "") {
			$("#responseVol").html("Enter a first name.");
		} else { //All info is entered
			var formData = {
				volFname: $("#volFname").val(),
				volLname: $("#volLname").val(),
				volManager: $("#volManager").val(),
				is_ajax: 1
			};

			//post to addVolunteer.php
			$.ajax({
				type: "POST",
				url: "addVolunteer.php",
				data: formData,
				success: function(response) {
					if(response == "added") {
						//entry added
						$("#successVol").html("Volunteer successfully added.").delay(3000).fadeOut(400);
						$("#responseVol").html("");
					} else if(response == "duplicate") {
						//duplicate entry
						$("#responseVol").html("That volunteer already exists.").delay(3000).fadeOut(400);
						$("#successVol").html("");
					}
				}
			});

		}

		return false;
	});


	//add donor
	$("#submitDonor").click(function(){
		//Check for blank entries
		if($("#donorLname").val() == "") {
			$("#responseDonor").html("Enter a last name.");
		} else if($("#donorFname").val() == "") {
			$("#responseDonor").html("Enter a first name.");
		} else if($("#donorPhone").val() == "") {
			$("#responseDonor").html("Enter a phone number.");
		} else if($("#donorCity").val() == "") {
			$("#responseDonor").html("Enter a city.");
		} else if($("#donorState").val() == "") {
			$("#responseDonor").html("Enter a state.");
		} else { //All info is entered
			var formData = {
				donorFname: $("#donorFname").val(),
				donorLname: $("#donorLname").val(),
				donorPhone: $("#donorPhone").val(),
				donorCity: $("#donorCity").val(),
				donorState: $("#donorState").val(),
				is_ajax: 1
			};

			//post to addDonor.php
			$.ajax({
				type: "POST",
				url: "addDonor.php",
				data: formData,
				success: function(response) {
					if(response == "added") {
						//entry added
						$("#successDonor").html("Donor successfully added.").delay(3000).fadeOut(400);
						$("#responseDonor").html("");
					} else if(response == "duplicate") {
						//duplicate entry
						$("#responseDonor").html("That donor already exists.").delay(3000).fadeOut(400);
						$("#successDonor").html("");
					}
				}
			});
		}

		return false;
	});

});
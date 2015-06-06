<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once('storedInfo.php');
require_once('db.php');
require_once('session.php');

$username = $_SESSION['loggedIn'];

$eventLocation = "SELECT venue, location_id FROM Location ORDER BY venue ASC";
$eventLocResult = $mysqli->query($eventLocation);

$eventManager = "SELECT fname, lname, manager_id FROM Managers ORDER BY lname ASC";
$eventManResult = $mysqli->query($eventManager);
$volManResult = $mysqli->query($eventManager);
?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>FreeNP - Nonprofit Management System</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/main.css">
		<meta name="viewport" content="width=device-width, intial-scale=1.0">
	</head>
	<body>
		<header>
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<a class="navbar-brand" href="index.php">FreeNP</a>
					<button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<div class="collapse navbar-collapse navHeaderCollapse">
						<ul class="nav navbar-nav navbar-right">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Add <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
								    <li><a href="add.php#addEvent">Add Event</a></li>
								    <li><a href="add.php#addLocation">Add Location</a></li>
									<li><a href="add.php#addDonor">Add Donor</a></li>
									<li><a href="add.php#addVolunteer">Add Volunteer</a></li>
						       	</ul>
							</li>
							<li class="dropdown">
					       	<a href="#" class="dropdown-toggle" data-toggle="dropdown">View <span class="caret"></span></a>
						       	<ul class="dropdown-menu" role="menu">
						       		<li><a href="index.php">Your Events</a></li>
						       		<li class="divider"></li>
								    <li><a href="events.php">View All Events</a></li>
									<li><a href="donors.php">View Donors</a></li>
									<li><a href="volunteers.php">View Volunteers</a></li>
									<li><a href="locations.php">View Locations</a></li>
						       	</ul>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</header>
		<section>
			<div class="container">
				<div class="col-md-3">
					<p>Hello, <?php echo "{$_SESSION['loggedIn']}"; ?>!</p>
					<p><a href="index.php?logout=true"><button type="button" class="btn btn-danger">Log Out</button></a></p>
				</div>
				<div class="col-md-4">
					<div id="addEvent">
						<h2>Add Event</h2>
						<form action="addEvent.php" method="post">
							<div class="form-group">
								<label for="eventName">Name: </label><input type="text" name="eventName" id="eventName" class="form-control" required>
								<label for="eventLoc">Location: </label>
								<select class="form-control" id="eventLoc">
								<?php
								while($row = $eventLocResult->fetch_assoc()){
								    echo "<option value=\"" . $row['location_id'] . "\">" . $row['venue'] . "</option>";
								}
								?>
								</select>
								<label for="eventCost">Cost: </label><input type="number" min="0" name="eventCost" id="eventCost" class="form-control" required>
								<label for="eventDate">Date: </label><input type="date" name="eventDate" id="eventDate" class="form-control" required>
								<label for="eventManager">Manager: </label>
								<select class="form-control" id="eventManager">
								<?php
								while($row2 = $eventManResult->fetch_assoc()){
								    echo "<option value=\"" . $row2['manager_id'] . "\">" . $row2['fname'] . " " . $row2['lname'] . "</option>";
								}
								?>
								</select>
							</div>
							<button type="submit" name="submitEvent" id="submitEvent" class="btn btn-primary">Add Event</button>
						</form>
						<div id="responseEvent"></div>
						<div id="successEvent"></div>
					</div>
					<hr>
					<div id="addLocation">
						<h2>Add Location</h2>
						<form action="addLocation.php" method="post">
							<div class="form-group">
								<label for="locName">Venue Name: </label><input type="text" name="locName" id="locName" class="form-control" required>
								<label for="locAdd">Street Address: </label><input type="text" name="locAdd" id="locAdd" class="form-control" required>
								<label for="locCity">City: </label><input type="text" name="locCity" id="locCity" class="form-control" required>
								<label for="locState">State: </label><input type="text" name="locState" id="locState" class="form-control" required>
							</div>
							<button type="submit" name="submitLoc" id="submitLoc" class="btn btn-primary">Add Location</button>
						</form>
						<div id="responseLoc"></div>
						<div id="successLoc"></div>
					</div>
					<hr>
					<div id="addDonor">
						<h2>Add Donor</h2>
						<form action="addDonor.php" method="post">
							<div class="form-group">
								<label for="donorFname">First Name: </label><input type="text" name="donorFname" id="donorFname" class="form-control" required>
								<label for="donorLname">Last Name: </label><input type="text" name="donorLname" id="donorLname" class="form-control" required>
								<label for="donorPhone">Phone: </label><input type="text" name="donorPhone" id="donorPhone" class="form-control" required>
								<label for="donorCity">City: </label><input type="text" name="donorCity" id="donorCity" class="form-control" required>
								<label for="donorState">State: </label><input type="text" name="donorState" id="donorState" class="form-control" required>
							</div>
							<button type="submit" name="submitDonor" id="submitDonor" class="btn btn-primary">Add Donor</button>
						</form>
						<div id="responseDonor"></div>
						<div id="successDonor"></div>
					</div>
					<hr>
					<div id="addVolunteer">
						<h2>Add Volunteer</h2>
						<form action="addVolunteer.php" method="post">
							<div class="form-group">
								<label for="volFname">First Name: </label><input type="text" name="volFname" id="volFname" class="form-control" required>
								<label for="volLname">Last Name: </label><input type="text" name="volLname" id="volLname" class="form-control" required>
								<label for="volManager">Manager: </label>
								<select class="form-control" id="volManager">
								<?php
								while($row3 = $volManResult->fetch_assoc()){
								    echo "<option value=\"" . $row3['manager_id'] . "\">" . $row3['fname'] . " " . $row3['lname'] . "</option>";
								}
								?>
								</select>
							</div>
							<button type="submit" name="submitVol" id="submitVol" class="btn btn-primary">Add Volunteer</button>
						</form>
						<div id="responseVol"></div>
						<div id="successVol"></div>
					</div>
				</div>
				</div>
				<div class="col-md-1">
				</div>
				<div class="col-md-4">

			</div>
		</section>
		<footer>
		</footer>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	    <script src="js/add.js" type="text/javascript"></script>
	</body>
</html>
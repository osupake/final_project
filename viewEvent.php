<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once('storedInfo.php');
require_once('db.php');
require_once('session.php');

$username = $_SESSION['loggedIn'];

$event_id = $_GET['id'];

//Prepared statement to get details for selected event
if (!($viewEvent = $mysqli->prepare("SELECT Events.event_id, Events.name, Events.cost, Events.event_date, Location.venue, Location.location_id, Managers.fname, Managers.lname FROM Events
									INNER JOIN Managers ON Events.manager = Managers.manager_id
									INNER JOIN Location ON Events.location = Location.location_id WHERE Events.event_id=?"))){
	     echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}
$viewEvent->bind_param("i", $event_id);
$viewEvent->execute();
$result = $viewEvent->get_result();
$viewEvent->close();

//Prepared statement to get volunteers for selected event
if (!($viewVols = $mysqli->prepare("SELECT Volunteers.fname, Volunteers.lname FROM Volunteers
									INNER JOIN VolunteerEvents ON Volunteers.volunteer_id = VolunteerEvents.volunteer_id
									INNER JOIN Events ON Events.event_id = VolunteerEvents.event_id WHERE Events.event_id = ?
									ORDER BY Volunteers.lname ASC"))){
	     echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}
$viewVols->bind_param("i", $event_id);
$viewVols->execute();
$result2 = $viewVols->get_result();
$viewVols->close();

//Prepared statement to view donations for selected event
if (!($viewDons = $mysqli->prepare("SELECT DonorEvents.amount_donated, DonorEvents.donation_date, Donors.fname, Donors.lname, Donors.donor_id FROM DonorEvents
									INNER JOIN Donors ON DonorEvents.donor_id = Donors.donor_id
									INNER JOIN Events ON DonorEvents.event_id = Events.event_id
									WHERE Events.event_id = ? ORDER BY DonorEvents.amount_donated DESC"))){
	     echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}
$viewDons->bind_param("i", $event_id);
$viewDons->execute();
$result3 = $viewDons->get_result();
$viewDons->close();

//Prepared statement to view total donation for selected event
if (!($viewTotal = $mysqli->prepare("SELECT SUM( amount_donated ) AS total FROM DonorEvents WHERE event_id = ?"))){
	     echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}
$viewTotal->bind_param("i", $event_id);
$viewTotal->execute();
$result4 = $viewTotal->get_result();
$viewTotal->close();

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
									<li><a href="add.php#enterDonation">Enter Donation</a></li>
									<li><a href="add.php#assignVolunteer">Assign Volunteer</a></li>
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
					<div class="text-center">
						<p>Hello, <?php echo $username; ?>!</p>
					</div>
					<div class="list-group">
						<a href="add.php#addEvent" class="list-group-item list-group-item-success">Add Event</a>
					    <a href="add.php#addLocation" class="list-group-item">Add Location</a>
						<a href="add.php#addDonor" class="list-group-item list-group-item-success">Add Donor</a>
						<a href="add.php#addVolunteer" class="list-group-item">Add Volunteer</a>
						<a href="add.php#enterDonation" class="list-group-item list-group-item-success">Enter Donation</a>
						<a href="add.php#assignVolunteer" class="list-group-item">Assign Volunteer</a>
					</div>
					<div class="list-group">
						<a href="events.php" class="list-group-item list-group-item-success">View All Events</a>
						<a href="donors.php" class="list-group-item">View Donors</a>
						<a href="volunteers.php" class="list-group-item list-group-item-success">View Volunteers</a>
						<a href="locations.php" class="list-group-item">View Locations</a>
					</div>
					<div class="text-center">
						<p><a href="index.php?logout=true"><button type="button" class="btn btn-danger">Log Out</button></a></p>
					</div>
				</div>
				<div class="col-md-9">
					<table class="table table-bordered">
						<tbody>
							<?php while($row = $result->fetch_assoc()) {
								echo "<tr><th>Event</th><td>" . $row['name'] . "</td></tr>";
								echo "<tr><th>Cost</th><td>" . $row['cost'] . "</td></tr>";
								echo "<tr><th>Date</th><td>" . $row['event_date'] . "</td></tr>";
								echo "<tr><th>Venue</th><td><a href=\"viewLocation.php?id=" . $row['location_id'] . "\">" . $row['venue'] . "</a></td></tr>";
								echo "<tr><th>Manager</th><td>" . $row['fname'] . " " . $row['lname'] . "</td></tr>";
							}
							?>
						</tbody>
					</table>
					<div class="col-md-8">
						<h4 class="text-center">Donors</h4>
						<table class="table table-bordered">
							<thead>
								<th>Name</th>
								<th>Donation Date</th>
								<th>Amount</th>
							</thead>
							<tbody>
								<?php while($row3 = $result3->fetch_assoc()) {
									echo "<td><a href=\"viewDonor.php?id=" . $row3['donor_id'] . "\">" . $row3['fname'] . " " . $row3['lname'] . "</a></td>";
									echo "<td>" . $row3['donation_date'] . "</td>";
									echo "<td>" . $row3['amount_donated'] . "</td></tr>";
								}
								?>
							</tbody>
					</table>
					</div>
					<div class="col-md-4">
						<h4 class="text-center">Total Amount Raised:</h4>
						<ul>
							<?php while($row4 = $result4->fetch_assoc()) {
								echo "<li>" . $row4['total'] . "</li>";
							}
							?>
						</ul>
						<br>
						<h4 class="text-center">Volunteers</h4>
						<ul>
							<?php while($row2 = $result2->fetch_assoc()) {
								echo "<li>" . $row2['fname'] . " " . $row2['lname'] . "</li>";
							}
							?>
						</ul>
					</div>
				</div>
			</div>
		</section>
		<footer>
		</footer>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	</body>
</html>
<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once('storedInfo.php');
require_once('db.php');
require_once('session.php');

$username = $_SESSION['loggedIn'];

$donor_id = $_GET['id'];

//Prepared statement to get details for selected location
if (!($viewDonor = $mysqli->prepare("SELECT * FROM Donors WHERE donor_id=?"))) {
	     echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}
$viewDonor->bind_param("i", $donor_id);
$viewDonor->execute();
$result = $viewDonor->get_result();
$viewDonor->close();

//Prepared statement to get previous donations
if (!($donations = $mysqli->prepare("SELECT Events.name, Events.event_id, DonorEvents.amount_donated, DonorEvents.donation_date FROM Events
									INNER JOIN DonorEvents ON Events.event_id = DonorEvents.event_id
									INNER JOIN Donors ON Donors.donor_id = DonorEvents.donor_id WHERE Donors.donor_id =?
									ORDER BY DonorEvents.donation_date ASC"))) {
	     echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}
$donations->bind_param("i", $donor_id);
$donations->execute();
$result2 = $donations->get_result();
$donations->close();

//Prepared statement to view total donation for donor
if (!($viewTotal = $mysqli->prepare("SELECT SUM( amount_donated ) AS total FROM DonorEvents
									INNER JOIN Donors ON DonorEvents.donor_id = Donors.donor_id
									WHERE Donors.donor_id = ?"))){
	     echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}
$viewTotal->bind_param("i", $donor_id);
$viewTotal->execute();
$result3 = $viewTotal->get_result();
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
								echo "<tr><th>Name</th><td>" . $row['fname'] . " " . $row['lname'] . "</td></tr>";
								echo "<tr><th>Phone</th><td>" . $row['phone'] . "</td></tr>";
								echo "<tr><th>City</th><td>" . $row['city'] . "</td></tr>";
								echo "<tr><th>State</th><td>" . $row['state'] . "</td></tr>";
							}
							?>
						</tbody>
					</table>
					<div class="col-md-8">
						<h4 class="text-center">Previous Donations</h4>
						<table class="table table-bordered">
							<thead>
								<th>Event</th>
								<th>Donation Date</th>
								<th>Amount</th>
							</thead>
							<tbody>
								<?php while($row2 = $result2->fetch_assoc()) {
									echo "<td><a href=\"viewEvent.php?id=" . $row2['event_id'] . "\">" . $row2['name'] . "</a></td>";
									echo "<td>" . $row2['donation_date'] . "</td>";
									echo "<td>" . $row2['amount_donated'] . "</td></tr>";
								}
								?>
							</tbody>
					</table>
					</div>
					<div class="col-md-4">
						<h4 class="text-center">Total Amount Donated:</h4>
						<ul>
							<?php while($row3 = $result3->fetch_assoc()) {
								echo "<li>" . $row3['total'] . "</li>";
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
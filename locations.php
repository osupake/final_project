<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once('storedInfo.php');
require_once('db.php');
require_once('session.php');

$username = $_SESSION['loggedIn'];

$locQuery = "SELECT * FROM Location ORDER BY venue ASC";
$locResult = $mysqli->query($locQuery);
//$row = $locResult->fetch_assoc();

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
					<h2 class="text-center">Locations</h2>
					<table class="table table-bordered">
						<thead>
							<th>Venue</th>
							<th>Address</th>
							<th>City</th>
							<th>State</th>
						</thead>
						<tbody>
							<?php while($row = $locResult->fetch_assoc()) {
								echo "<tr>";
								echo "<td><a href=\"viewLocation.php?id=" . $row['location_id'] . "\">" . $row['venue'] . "</a></td>";
								echo "<td>" . $row['address'] . "</td>";
								echo "<td>" . $row['city'] . "</td>";
								echo "<td>" . $row['state'] . "</td>";
								echo "</tr>";
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</section>
		<footer>
		</footer>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	</body>
</html>
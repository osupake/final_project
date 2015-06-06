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
								    <li><a href="addEvent.php">Add Event</a></li>
									<li><a href="addDonor.php">Add Donor</a></li>
									<li><a href="addVolunteer.php">Add Volunteer</a></li>
									<li><a href="addLocation.php">Add Location</a></li>
						       	</ul>
							</li>
							<li class="dropdown">
					       	<a href="#" class="dropdown-toggle" data-toggle="dropdown">View <span class="caret"></span></a>
						       	<ul class="dropdown-menu" role="menu">
						       		<li><a href="myevents.php">Your Events</a></li>
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
					<p>Hello, <?php echo $username; ?>!</p>
					<p>Update your profile</p>
					<p><a href="index.php?logout=true"><button type="button" class="btn btn-danger">Log Out</button></a></p>
				</div>
				<div class="col-md-9">
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
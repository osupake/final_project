<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once('storedInfo.php');
require_once('db.php');
require_once('session.php');

$username = $_SESSION['loggedIn'];

$location_id = $_GET['id'];

//Prepared statement to get details for selected location
if (!($viewLoc = $mysqli->prepare("SELECT * FROM Location WHERE location_id=?"))) {
	     echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}
$viewLoc->bind_param("i", $location_id);
$viewLoc->execute();
$result = $viewLoc->get_result();
$viewLoc->close();

//Delete location
if(isset($_GET['delete'])){
	if (!($checkLoc = $mysqli->prepare("SELECT * FROM Events WHERE location=?"))) {
	     echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
	$checkLoc->bind_param("i", $location_id);
	$checkLoc->execute();
	$checkLoc->store_result();
	$rowsLoc = $checkLoc->num_rows;
	$checkLoc->close();

	if($rowsLoc > 0){
		//Matching event entry found
		echo "Cannot delete location because an event with that location exists.";
	} else {
		if (!($deleteLoc = $mysqli->prepare("DELETE FROM Location WHERE location_id=? LIMIT 1"))) {
		     echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		$deleteLoc->bind_param("i", $location_id);
		$deleteLoc->execute();
		$filePath = explode('/', $_SERVER['PHP_SELF'], -1);
		$filePath = implode('/', $filePath);
		$redirect = "http://" . $_SERVER['HTTP_HOST'] . $filePath;
		header("Location: {$redirect}/locations.php" , true);
		die();
	}
}

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
					<p>Hello, <?php echo $username; ?>!</p>
					<p>Update your profile</p>
					<p><a href="index.php?logout=true"><button type="button" class="btn btn-danger">Log Out</button></a></p>
				</div>
				<div class="col-md-9">
					<table class="table table-bordered">
						<tbody>
							<?php while($row = $result->fetch_assoc()) {
								echo "<tr><td>Venue</td><td>" . $row['venue'] . "</td></tr>";
								echo "<tr><td>Address</td><td>" . $row['address'] . "</td></tr>";
								echo "<tr><td>City</td><td>" . $row['city'] . "</td></tr>";
								echo "<tr><td>State</td><td>" . $row['state'] . "</td></tr>";
							}
							?>
						</tbody>
					</table>
					<a href="<?php echo "viewLocation.php?id=$location_id&delete=true" ?>"><button class="btn btn-danger">Delete Entry</button></a>
					<div id="delete"></div>
				</div>
			</div>
		</section>
		<footer>
		</footer>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	</body>
</html>
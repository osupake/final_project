<?php
ini_set('display_errors', 'On');
include 'storedInfo.php';
include 'db.php';
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
				<div class="container">
					<a class="navbar-brand" href="#">FreeNP</a>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Add <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
							    <li><a href="#">Add Event</a></li>
								<li><a href="#">Add Donor</a></li>
								<li><a href="#">Add Volunteer</a></li>
								<li><a href="#">Add Location</a></li>
					       	</ul>
						</li>
						<li class="dropdown">
				       	<a href="#" class="dropdown-toggle" data-toggle="dropdown">View <span class="caret"></span></a>
					       	<ul class="dropdown-menu" role="menu">
					       		<li><a href="#">Your Events</a></li>
					       		<li class="divider"></li>
							    <li><a href="#">View All Events</a></li>
								<li><a href="#">View Donors</a></li>
								<li><a href="#">View Volunteers</a></li>
								<li><a href="#">View Locations</a></li>
					       	</ul>
						</li>
					</ul>
				</div>
			</nav>
		</header>
		<section>
			<div class="container">
				<div class="col-md-2">
					<p>Username</p>
				</div>
				<div class="col-md-10">
					<p>Content</p>
				</div>
			</div>
		</section>
		<footer>
		</footer>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	</body>
</html>
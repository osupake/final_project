<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
include 'storedInfo.php';
include 'db.php';

if(isset($_POST['submit'])){
	$username = $_POST['username'];
	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];

	//Check for duplicate username
	$checkUsername = $mysqli->prepare("SELECT * FROM users WHERE username=?");
	$checkUsername->bind_param("s", $username);
	$checkUsername->execute();
	$checkUsername->store_result();
	$rowsUsername = $checkUsername->num_rows;

	if($rowsUsername > 0){
		//Matching username found
		echo "Username taken. Please try again.";
		exit();
	}
	$checkUsername->close();

	//Check if passwords match
	if($password1 == $password2) {
		//md5 hash
		$password1 = md5($password1);

		//Prepared statement to add username and password into database
		$add = $mysqli->prepare("INSERT INTO users (username, password) VALUES (?, ?)");

		$add->bind_param("ss", $username, $password1);
		$add->execute();
		$add->close();

		//Redirect to login page
		$filePath = explode('/', $_SERVER['PHP_SELF'], -1);
		$filePath = implode('/', $filePath);
		$redirect = "http://" . $_SERVER['HTTP_HOST'] . $filePath;
		header("Location: {$redirect}/login.php" , true);
		die();

	} else {
		echo "Passwords do not match. Please try again.";
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
		<div class="container">
			<div class="col-md-4">
			</div>
			<div class="col-md-4">
				<form action="register.php" method="post">
					<div class="form-group">
						<label for="username">Username: </label><input type="text" name="username" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="password1">Password: </label><input type="password" name="password1" class="form-control" required minlength=6><br>
						<label for="password2">Confirm Password: </label><input type="password" name="password2" class="form-control" required minlength=6>
					</div>
					<button type="submit" name="submit" class="btn btn-primary">Register</button>
				</form>
			</div>
			<div class="col-md-4">
			</div>
		</div>	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	</body>
</html>
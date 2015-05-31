<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
include 'storedInfo.php';
include 'db.php';

if(isset($_POST['submit'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$password = md5($password);

	$check = $mysqli->prepare("SELECT * FROM users WHERE username=? AND password=?");
	$check->bind_param("ss", $username, $password);
	$check->execute();
	$check->store_result();
	$rows = $check->num_rows;

	if($rows > 0){
		//success
		$_SESSION['loggedIn'] = $username;
		$filePath = explode('/', $_SERVER['PHP_SELF'], -1);
		$filePath = implode('/', $filePath);
		$redirect = "http://" . $_SERVER['HTTP_HOST'] . $filePath;
		header("Location: {$redirect}/index.php" , true);
		die();
	} else {
		echo "Login failed. Please try again.";
	}
	$check->close();
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
				<form action="login.php" method="post">
					<div class="form-group">
						<label for="username">Username: </label><input type="text" name="username" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="password">Password: </label><input type="password" name="password" class="form-control" required>
					</div>
					<input type="submit" name="submit" class="btn btn-primary" value="Login">
				</form>
				<br><p><a href="register.php">Click here to register</a></p>
			</div>
			<div class="col-md-4">
			</div>
		</div>	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	</body>
</html>
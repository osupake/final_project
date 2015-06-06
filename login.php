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
				<form action="validate.php" method="post" id="loginForm">
					<div class="form-group">
						<label for="username">Username: </label><input type="text" name="username" id="username" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="password">Password: </label><input type="password" name="password" id="password" class="form-control" required>
					</div>
					<button type="submit" name="submit" id="submit" class="btn btn-primary">Login</button>
				</form>
				<p><div id="response"></div></p>
				<p>Not a member? <a href="register.php">Click here to register</a></p>
			</div>
			<div class="col-md-4">
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" type="text/javascript"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="js/login_script.js" type="text/javascript"></script>
	</body>
</html>
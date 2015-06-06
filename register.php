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
				<form action="validateReg.php" method="post">
					<div class="form-group">
						<label for="username">Username: </label><input type="text" name="username" id="username" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="password1">Password: </label><input type="password" name="password1" id="password1" class="form-control" required minlength=6><br>
						<label for="password2">Confirm Password: </label><input type="password" name="password2" id="password2" class="form-control" required minlength=6>
					</div>
					<button type="submit" name="submit" id="submit" class="btn btn-primary">Register</button>
					<p><div id="response"></div></p>
					<p><div id="success"></div></p>
				</form>
			</div>
			<div class="col-md-4">
			</div>
		</div>	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		<script src="register_script.js" type="text/javascript"></script>
	</body>
</html>
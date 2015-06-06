<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
include 'storedInfo.php';
include 'db.php';

$is_ajax = $_REQUEST['is_ajax'];
if(isset($is_ajax) && $is_ajax) {
	$username = $_REQUEST['username'];
	$password1 = $_REQUEST['password1'];
	$password2 = $_REQUEST['password2'];

	//Check for duplicate username
	$checkUsername = $mysqli->prepare("SELECT * FROM users WHERE username=?");
	$checkUsername->bind_param("s", $username);
	$checkUsername->execute();
	$checkUsername->store_result();
	$rowsUsername = $checkUsername->num_rows;
	$checkUsername->close();

	if($rowsUsername > 0){
		//Matching username found
		echo "duplicate";
	} else { //Enter new user into users table
		//md5 hash
		$password1 = md5($password1);

		//Prepared statement to add username and password into database
		$add = $mysqli->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
		$add->bind_param("ss", $username, $password1);
		$add->execute();
		$add->close();
		echo "registered";
	}
}

?>
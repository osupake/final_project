<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once('storedInfo.php');
require_once('db.php');

$is_ajax = $_REQUEST['is_ajax'];
if(isset($is_ajax) && $is_ajax) {
	$username = $_REQUEST['username'];
	$password1 = $_REQUEST['password1'];
	$password2 = $_REQUEST['password2'];
	$firstname = $_REQUEST['firstname'];
	$lastname = $_REQUEST['lastname'];

	//Check for duplicate username
	if (!($checkUsername = $mysqli->prepare("SELECT * FROM Managers WHERE username=?"))) {
	     echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
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
		if (!($add = $mysqli->prepare("INSERT INTO Managers (lname, fname, username, password) VALUES (?, ?, ?, ?)"))) {
	     echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		$add->bind_param("ssss", $lastname, $firstname, $username, $password1);
		$add->execute();
		$add->close();
		echo "registered";
	}
}

?>
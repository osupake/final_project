<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
include 'storedInfo.php';
include 'db.php';

$is_ajax = $_REQUEST['is_ajax'];
if(isset($is_ajax) && $is_ajax) {
	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];
	$password = md5($password);

	$check = $mysqli->prepare("SELECT * FROM users WHERE username=? AND password=?");
	$check->bind_param("ss", $username, $password);
	$check->execute();
	$check->store_result();
	$rows = $check->num_rows;

	if($rows > 0){
		//successful login, create session
		$_SESSION['loggedIn'] = $username;
		echo 'correct';
	} else {
		echo 'wrong';
	}

	$check->close();
}
?>
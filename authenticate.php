<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
include 'db.php';
session_start();

if(isset($_POST['username'])){
	$username = $_POST['username'];
} else {
	$username = null;
}

if((!isset($_SESSION['counter'])) && ($username == null)) { //no username entered and no visits counted
	echo "A username must be entered. Click <a href=\"login.php\">here</a> to return to the login screen.";	
} else {
	if(isset($_POST['username'])) {
			$_SESSION['loggedIn'] = $username; //log in variable for username
		//echo $username
	}
?>
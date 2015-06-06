<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once('storedInfo.php');
require_once('db.php');

$is_ajax = $_REQUEST['is_ajax'];
if(isset($is_ajax) && $is_ajax) {
	$donorFname = $_REQUEST['donorFname'];
	$donorLname = $_REQUEST['donorLname'];
	$donorPhone = $_REQUEST['donorPhone'];
	$donorCity = $_REQUEST['donorCity'];
	$donorState = $_REQUEST['donorState'];

	//Check for duplicate entry
	if (!($checkDonor = $mysqli->prepare("SELECT * FROM Donors WHERE fname=? AND lname=? AND phone=?"))) {
	     echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
	$checkDonor->bind_param("ssi", $donorFname, $donorLname, $donorPhone);
	$checkDonor->execute();
	$checkDonor->store_result();
	$rowsDonor = $checkDonor->num_rows;
	$checkDonor->close();

	if($rowsDonor > 0){
		//Matching entry found
		echo "duplicate";
	} else { //Enter new event into Events table
		if (!($addDonor = $mysqli->prepare("INSERT INTO Donors (fname, lname, phone, city, state) VALUES (?, ?, ?, ?, ?)"))) {
	     echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		$addDonor->bind_param("sssss", $donorFname, $donorLname, $donorPhone, $donorCity, $donorState);
		$addDonor->execute();
		$addDonor->close();
		echo "added";
	}
}

?>
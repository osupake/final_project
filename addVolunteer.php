<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once('storedInfo.php');
require_once('db.php');

$is_ajax = $_REQUEST['is_ajax'];
if(isset($is_ajax) && $is_ajax) {
	$volFname = $_REQUEST['volFname'];
	$volLname = $_REQUEST['volLname'];
	$volManager = $_REQUEST['volManager'];

	//Check for duplicate entry
	if (!($checkVol = $mysqli->prepare("SELECT * FROM Volunteers WHERE fname=? AND lname=?"))) {
	     echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
	$checkVol->bind_param("ss", $volFname, $volLname);
	$checkVol->execute();
	$checkVol->store_result();
	$rowsVol = $checkVol->num_rows;
	$checkVol->close();

	if($rowsVol > 0){
		//Matching entry found
		echo "duplicate";
	} else { //Enter new event into Events table
		if (!($addVol = $mysqli->prepare("INSERT INTO Volunteers (fname, lname, manager) VALUES (?, ?, ?)"))) {
	     echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		$addVol->bind_param("ssi", $volFname, $volLname, $volManager);
		$addVol->execute();
		$addVol->close();
		echo "added";
	}
}

?>
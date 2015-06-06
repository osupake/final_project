<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once('storedInfo.php');
require_once('db.php');

$is_ajax = $_REQUEST['is_ajax'];
if(isset($is_ajax) && $is_ajax) {
	$eventName = $_REQUEST['eventName'];
	$eventLoc = $_REQUEST['eventLoc'];
	$eventCost = $_REQUEST['eventCost'];
	$eventDate = $_REQUEST['eventDate'];
	$eventManager = $_REQUEST['eventManager'];

	//Check for duplicate entry
	if (!($checkEvent = $mysqli->prepare("SELECT * FROM Events WHERE name=? AND location=? AND event_date=?"))) {
	     echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
	$checkEvent->bind_param("sss", $eventName, $eventLoc, $eventDate);
	$checkEvent->execute();
	$checkEvent->store_result();
	$rowsEvent = $checkEvent->num_rows;
	$checkEvent->close();

	if($rowsEvent > 0){
		//Matching entry found
		echo "duplicate";
	} else { //Enter new event into Events table
		if (!($addEvent = $mysqli->prepare("INSERT INTO Events (name, location, cost, event_date, manager) VALUES (?, ?, ?, ?, ?)"))) {
	     echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		$addEvent->bind_param("siisi", $eventName, $eventLoc, $eventCost, $eventDate, $eventManager);
		$addEvent->execute();
		$addEvent->close();
		echo "added";
	}
}

?>
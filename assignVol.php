<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once('storedInfo.php');
require_once('db.php');

$is_ajax = $_REQUEST['is_ajax'];
if(isset($is_ajax) && $is_ajax) {
	$eventAssign = $_REQUEST['eventAssign'];
	$volunteers = $_REQUEST['volunteers'];

	//Check for duplicate entry
	if (!($checkVol = $mysqli->prepare("SELECT * FROM VolunteerEvents WHERE volunteer_id=? AND event_id=?"))) {
	     echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
	$checkVol->bind_param("ii", $volunteers, $eventAssign);
	$checkVol->execute();
	$checkVol->store_result();
	$rowsVol = $checkVol->num_rows;
	$checkVol->close();

	if($rowsVol > 0){
		//Matching entry found
		echo "duplicate";
	} else { //Enter new event into Events table
		if (!($assignVol = $mysqli->prepare("INSERT INTO VolunteerEvents (volunteer_id, event_id) VALUES (?, ?)"))) {
	     echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		$assignVol->bind_param("ii", $volunteers, $eventAssign);
		$assignVol->execute();
		$assignVol->close();
		echo "added";
	}
}

?>
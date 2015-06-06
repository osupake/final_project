<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once('storedInfo.php');
require_once('db.php');

$is_ajax = $_REQUEST['is_ajax'];
if(isset($is_ajax) && $is_ajax) {
	$locName = $_REQUEST['locName'];
	$locAdd = $_REQUEST['locAdd'];
	$locCity = $_REQUEST['locCity'];
	$locState = $_REQUEST['locState'];

	//Check for duplicate entry
	if (!($checkLoc = $mysqli->prepare("SELECT * FROM Location WHERE address=? AND city=? AND state=? AND venue=?"))) {
	     echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
	$checkLoc->bind_param("ssss", $locAdd, $locCity, $locState, $locName);
	$checkLoc->execute();
	$checkLoc->store_result();
	$rowsLoc = $checkLoc->num_rows;
	$checkLoc->close();

	if($rowsLoc > 0){
		//Matching entry found
		echo "duplicate";
	} else { //Enter new location into Location table
		if (!($addLoc = $mysqli->prepare("INSERT INTO Location (address, city, state, venue) VALUES (?, ?, ?, ?)"))) {
	     echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		$addLoc->bind_param("ssss", $locAdd, $locCity, $locState, $locName);
		$addLoc->execute();
		$addLoc->close();
		echo "added";
	}
}

?>
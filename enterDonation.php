<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once('storedInfo.php');
require_once('db.php');

$is_ajax = $_REQUEST['is_ajax'];
if(isset($is_ajax) && $is_ajax) {
	$donationEvent = $_REQUEST['donationEvent'];
	$eventDonor = $_REQUEST['eventDonor'];
	$donationAmount = $_REQUEST['donationAmount'];
	$donationDate = $_REQUEST['donationDate'];

	//Check for duplicate entry
	if (!($checkDon = $mysqli->prepare("SELECT * FROM DonorEvents WHERE donor_id=? AND event_id=? AND donation_date=? AND amount_donated=?"))) {
	     echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
	$checkDon->bind_param("iisi", $eventDonor, $donationEvent, $donationDate, $donationAmount);
	$checkDon->execute();
	$checkDon->store_result();
	$rowsDon = $checkDon->num_rows;
	$checkDon->close();

	if($rowsDon > 0){
		//Matching entry found
		echo "duplicate";
	} else { //Enter new donation into DonorEvents table
		if (!($addDon = $mysqli->prepare("INSERT INTO DonorEvents (donor_id, event_id, donation_date, amount_donated) VALUES (?, ?, ?, ?)"))) {
	     echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		$addDon->bind_param("iisi", $eventDonor, $donationEvent, $donationDate, $donationAmount);
		$addDon->execute();
		$addDon->close();
		echo "added";
	}
}

?>
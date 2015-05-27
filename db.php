<?php
ini_set('display_errors', 'On');
include 'storedInfo.php';

$db_host = 'oniddb.cws.oregonstate.edu';
$db_user = 'pake-db';
$db_name = 'pake-db';

//Create mysqli object
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

//Error handler
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
?>
<?php

include 'Parser.php';
include 'FileImporter.php';
include 'APIstats.php';

$Parser = new Parser();
$fileImporter = new FileImporter();
$APIstats = new APIstats();
$file = 'sample.log';


if(!file_exists($file))
	exit("Please import a valid file");

$logs = $fileImporter -> importFile($file);

foreach ($logs as $log) {
    $APIdata = $Parser -> parse($log);
    $APIstats->insertOrUpdateData($APIdata);
}

$APIstats->viewStats("GET /api/users/1686318645/count_bookings");
$APIstats->viewStats("GET /api/users/1686318645/get_bookings");
$APIstats->viewStats("GET /api/users/1686318645/get_booking_progress");
$APIstats->viewStats("GET /api/users/1686318645/get_upcoming_bookings");
$APIstats->viewStats("POST /api/users/1686318645");
$APIstats->viewStats("GET /api/users/1686318645");

?>
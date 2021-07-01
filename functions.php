<?php

// connect to database
$conn = mysqli_connect("localhost", "root", "", "db_hotel");

// read data
function read($query)
{
	global $conn;
	$result = mysqli_query($conn, $query);
	$records = [];
	while ($tuples = mysqli_fetch_assoc($result)) {
		$records[] = $tuples;
	}
	return $records;
}

function execute_query($query)
{
	global $conn;
	mysqli_query($conn, $query);
	if (mysqli_affected_rows($conn) > 0) {
		return true;
	}
	return false;
}

function execute_multi_query($query)
{
	global $conn;
	mysqli_multi_query($conn, $query);
	if (mysqli_affected_rows($conn) > 0) {
		return true;
	}
	return false;
}

<?php
	// $conn = new mysqli('localhost', 'root', '', 'votesystem');

	// if ($conn->connect_error) {
	//     die("Connection failed: " . $conn->connect_error);
	// }

$conn = new mysqli('localhost', 'root', '', 'ssc_attendance');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>
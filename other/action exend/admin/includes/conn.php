<?php
	// $conn = new mysqli('localhost', 'root', '', 'ssc_attendance');

	// if ($conn->connect_error) {
	//     die("Connection failed: " . $conn->connect_error);
	// }
			//include 'session.php';
	$db = new mysqli('localhost', 'root', '', 'ssc_ams');

	if ($db->connect_error) {
	    die("Connection failed: " . $db->connect_error);
	}
	if(session_status() == PHP_SESSION_NONE)
   {session_start();}//start session if session not start
   date_default_timezone_set('Asia/Manila');
?>
<?php
	session_start();
	//include 'includes/conn.php';
	
	// $fullname = ucwords($_SESSION['firstname']).' '.ucwords($_SESSION['lastname']).'';
 //    $query2 = "INSERT INTO `log_history1`( `log_admin_name`, `log_action`,`sem_status`) VALUES ('$fullname','Logging Out', ".$_SESSION['sem_id']." )";
 //    mysqli_query($conn, $query2);


	session_destroy();
	unset($_SESSION['admin_id']);
	header('location: index.php');
?>
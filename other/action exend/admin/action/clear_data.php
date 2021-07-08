<?php 
include '../includes/session.php';


if(isset($_SESSION['sy_id']) && isset($_SESSION['admin_id']) && isset($_POST['table_id']))
{
	$table_id = trim($_POST['table_id']);
	$sql = "DROP TABLE log_history".$table_id."";
	mysqli_query($conn,$sql);
	$sql = "DROP TABLE students".$table_id."";
	mysqli_query($conn,$sql);
	$sql = "DROP TABLE attendance_tap".$table_id."";
	mysqli_query($conn,$sql);
	$sql = "DROP TABLE masterlist".$table_id."";
	mysqli_query($conn,$sql);
	$sql = "DROP TABLE tshirt_size".$table_id."";
	mysqli_query($conn,$sql);
	$sql = "DELETE FROM sy_status WHERE sy_id = '$table_id'";
	if($conn->query($sql)){
		echo 1;
	}
	if($table_id == $_SESSION['sy_id']){
		unset($_SESSION['sy_id']);
	}	
}
else{

header('location: ../logout.php');

}











 ?>
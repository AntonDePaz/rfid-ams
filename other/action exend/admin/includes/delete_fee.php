<?php 
include '../includes/session.php';
$id = $_POST['deleteid'];

		echo " ".$id;
if(isset($_POST['deleteid'])){
		
		// $sql = "DELETE FROM voters WHERE id = '$id'";
		// if($conn->query($sql)){
		// 	$_SESSION['success'] = 'Voter deleted successfully';
		// }
		// else{
		// 	$_SESSION['error'] = $conn->error;
		// }
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}










 ?>
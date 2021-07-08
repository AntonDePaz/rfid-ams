<?php 
include '../includes/conn.php';

if(isset($_GET['id']))
{
		$id = $_GET['id'];
		

		$sql = " UPDATE `sy_status` SET `sy_status`= 1  WHERE sy_id = '$id' ";
		if($db->query($sql)){
			// $_SESSION['success'] = 'Students added successfully';
			echo "successfully";
		}
		else{
			//$_SESSION['error'] = $conn->error;
			echo "error".$conn->error;
		}

		$sql = " UPDATE `sy_status` SET `sy_status`= 0  WHERE sy_id <> '$id' ";
		if($db->query($sql)){
			// $_SESSION['success'] = 'Students added successfully';
			echo "successfully";
		}
		else{
			//$_SESSION['error'] = $conn->error;
			echo "error".$conn->error;
		}

		header('location: ../dashboard.php');

}


 ?>
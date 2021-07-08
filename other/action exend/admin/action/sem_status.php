<?php 
include '../includes/conn.php';

if(isset($_GET['id']))
{
		$id = $_GET['id'];
		

		$sql = " UPDATE `sem_status` SET `sem_status`= 1  WHERE sem_id = '$id' ";
		if($db->query($sql)){
			// $_SESSION['success'] = 'Students added successfully';
			echo "successfully";
		}
		else{
			//$_SESSION['error'] = $conn->error;
			echo "error".$db->error;
		}

		$sql = " UPDATE `sem_status` SET `sem_status`= 0  WHERE sem_id <> '$id' ";
		if($db->query($sql)){
			// $_SESSION['success'] = 'Students added successfully';
			echo "successfully";
		}
		else{
			//$_SESSION['error'] = $conn->error;
			echo "error".$db->error;
		}

		header('location: ../dashboard.php');

}


 ?>
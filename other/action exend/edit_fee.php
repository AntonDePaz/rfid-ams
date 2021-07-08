<?php 

include '../includes/session.php';

if(isset($_POST['id']) && isset($_POST['description']) && isset($_POST['amount'])){
		$id = trim($_POST['id']);
		$description = $_POST['description'];
		$amount = $_POST['amount'];

		$sql = "UPDATE fee_event SET Description = '$description', amount = '$amount' WHERE fe_id = '$id'";
		if($conn->query($sql)){
			echo " updated to fee successfully";
		}
		else{
			echo " error updated to fee";
		}
		$sql = "UPDATE masterlist".$_SESSION['sy_id']." SET pay".$id." = '$amount' WHERE pay".$id." <> 0";
		if($conn->query($sql)){
			echo " updated to masterlist successfully";
		}
		else{
			echo " error updated to masterlist";
		}
	}
	else{
		echo " not isset";
	}

	//header('location: positions.php');











 ?>
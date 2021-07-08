<?php 
include '../includes/session.php';

if(isset($_POST['deleteid'])){
		
		$id = $_POST['deleteid'];
		//echo " id:".$id;

		$sql = "DELETE FROM fee_event WHERE fe_id = '$id'";
		if($conn->query($sql))
		{
			$sql = "ALTER TABLE masterlist".$_SESSION['sy_id']." DROP pay".$id." ";
			if($conn->query($sql)){
				echo "deleted from masterlist";
			}
			else{
				echo "error 2";
			}
			
		}
		else
		{
			echo 2;
		}




	}
	else{
		echo 3;
	}


// header('location: ../fee.php');







 ?>
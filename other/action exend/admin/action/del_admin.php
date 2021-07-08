<?php 
include '../includes/session.php';

if(isset($_POST['del_admin_id'])){
		
		$id = $_POST['del_admin_id'];
		//echo " id:".$id;

		$sql = "DELETE FROM admin WHERE admin_id = '$id'";
		if($conn->query($sql))
		{
			echo "1";
		}
		else
		{
			echo "2";
		}
	}
	else{
		 header('location: ../home.php');
	}








 ?>
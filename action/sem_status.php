<?php 
include '../model/connection.php';

if(isset($_GET['id']))
{
		$id = $_GET['id'];
		

		$sql = " UPDATE `sem_status` SET `sem_status`= 1  WHERE sem_id = '$id' ";
		$dbb->conn->query($sql);

		$sql = " UPDATE `sem_status` SET `sem_status`= 0  WHERE sem_id <> '$id' ";
		$dbb->conn->query($sql);

		header('location: ../dashboard.php');

}


 ?>
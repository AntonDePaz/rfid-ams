<?php 
include '../model/connection.php';

if(isset($_GET['id']))
{
		$id = $_GET['id'];
		$sql = " UPDATE `sy_status` SET `sy_status`= 1  WHERE sy_id = '$id' ";
		$dbb->conn->query($sql);

		$sql = " UPDATE `sy_status` SET `sy_status`= 0  WHERE sy_id <> '$id' ";
		$dbb->conn->query($sql);

		header('location: ../dashboard.php');

}


 ?>
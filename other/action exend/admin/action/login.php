<?php
	include '../model/login.php';
	$login = new login();

	if(isset($_POST['username']) && isset($_POST['password'])){

		$username = $_POST['username'];
		$password = $_POST['password'];

		$result = $login->clogin($username,$password);
		echo $result;
		// if($result == 3){
		// 	header('location: ../home.php');
		// }



	}
	

	

?>
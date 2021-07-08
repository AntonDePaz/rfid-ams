<?php 

include '../includes/session.php';

if(isset($_POST['cpass']) && isset($_POST['current_password'])){


		$newpassword = mysqli_real_escape_string($conn, $_POST['cpass']);
		$newpassword = sha1(md5($newpassword));
		$currentpassword = mysqli_real_escape_string($conn, $_POST['current_password']);
		$currentpassword = sha1(md5($currentpassword));
		$admin_id = $_SESSION['admin_id'];

		$sql = "SELECT * FROM admin WHERE admin_id = '$admin_id'";
		$query = $conn->query($sql);

		if($query->num_rows < 1){
			echo 3;
		}
		else{
			$row = $query->fetch_assoc();
			if(($currentpassword == $row['password'])){

				$sql = "UPDATE admin SET `password`='$newpassword' WHERE admin_id = '$admin_id' ";
				if($conn->query($sql)){
				    echo 1;
				 }else{
				  echo 11;
				 }
				
			}
			else{
				echo 2;
			}
		}
		
	}
else{

header('location: ../logout.php');

}











 ?>
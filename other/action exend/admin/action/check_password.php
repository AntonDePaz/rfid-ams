<?php 

include '../includes/session.php';

if(isset($_POST['check_password'])){


	$password = mysqli_real_escape_string($conn, $_POST['check_password']);
	$password = sha1(md5($password));
	$admin_id = $_SESSION['admin_id'];
	//echo " sud na".$password." id".$admin_id;
	$found = false;
	$sql = "SELECT * FROM admin WHERE  admin_id = '$admin_id' ";
	$query = $conn->query($sql);
	$row = $query->fetch_assoc();
	   if(($password == $row['password'])){
		$found = true;	
		}
		echo $found;


}
else{

header('location: ../logout.php');

}












 ?>
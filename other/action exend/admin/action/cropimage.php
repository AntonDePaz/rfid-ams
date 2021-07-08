<?php 
include '../includes/conn.php';

if(isset($_POST['image'])){
	$data = $_POST['image'];

	$image1 = explode(';', $data);
	$image2 = explode(',', $image1[1]);

	$data = base64_decode($image2[1]);

	$imagename = time().'.png';
	$_SESSION['imagepath'] = $imagename;
	$location = '../../images/'.$imagename;
	file_put_contents($location, $data);

	echo '<img style="border-radius: 20px; border: 2px solid black;" width="150" class="avatar border-white" src="../images/'.$imagename.'"  class="img-thumbnail" />';

	

}
else{

header('location: ../logout.php');

}





 ?>
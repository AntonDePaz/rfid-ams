<?php 

include '../includes/session.php';

if(isset($_POST['rfid']) && isset($_POST['idnumber']) && isset($_POST['semester']) && isset($_POST['firstname']) && isset($_POST['lastname']) )

{
		$id = $_POST['id'];
		$rfid = $_POST['rfid'];
		$idnumber = $_POST['idnumber'];
		$sem = $_POST['semester'];
		$firstname = $_POST['firstname'];
		//$middlename = $_POST['middlename'];
		$lastname = $_POST['lastname'];
		$section = $_POST['section'];
		$yearlevel = $_POST['yearlevel'];
		$course = $_POST['course'];
		$major = $_POST['major'];
		$semester_value = 'sem'.trim($sem).'';
		$semester_value = trim($semester_value);

		$sql = "UPDATE students".$_SESSION['sy_id']." SET `id_number`='$idnumber',`firstname`= '$firstname',`lastname`= '$lastname',`year`='$yearlevel',`section`='$section',`course`='$course',`major`='$major', ".$semester_value." = '1',`rfid`='$rfid' WHERE student_id = '$id' ";

		if($conn->query($sql)){
			echo 'Students added successfully';
		}
		else{
			echo $conn->error;
		}

	
	

	//header('location: voters.php');








}

if(isset($_POST['delete_id'])){

	$id = $_POST['delete_id'];

	$sql = "UPDATE students".$_SESSION['sy_id']." SET sem".$_SESSION['sem_id']." = ''  WHERE student_id = '$id' ";
		if($conn->query($sql)){
			echo 'Students Deleted successfully';
		}
		else{
			echo $conn->error;
		}


}




 ?>
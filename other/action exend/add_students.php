<?php 

//include '../includes/session.php';
include '../model/student.php';



//include 'class.php';

//$model = new Model();

 if(isset($_POST['rfid']) && isset($_POST['idnumber'])  && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['section']) )
{

	//echo 'add sty';
	//$data = json_decode($_POST['data'], true);
    $insert = $model->insert($data);

}


// if(isset($_POST['rfid']) && isset($_POST['idnumber']) && isset($_POST['semester']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['section']) )

// {



// 		$rfid = $_POST['rfid'];
// 		$idnumber = $_POST['idnumber'];
// 		$sem = $_POST['semester'];
// 		$firstname = $_POST['firstname'];
// 		//$middlename = $_POST['middlename'];
// 		$lastname = $_POST['lastname'];
// 		$section = $_POST['section'];
// 		$yearlevel = $_POST['yearlevel'];
// 		$course = $_POST['course'];
// 		$major = $_POST['major'];
// 		$semester_value = 'sem'.trim($sem).'';
// 		$semester_value = trim($semester_value);
//          $sql = "INSERT INTO students".$_SESSION['sy_id']." ( id_number,firstname,lastname,year,section,course,major, ".$semester_value.", rfid ) VALUES ('$idnumber','$firstname','$lastname','$yearlevel','$section','$course','$major','1','$rfid')";
// 		if($conn->query($sql))
// 		{
// 			echo 'Students added successfully';
// 		}
// 		else
// 		{
// 			echo 'erorr'.$conn->error;
// 		}

	
	

// 	//header('location: voters.php');










// }
// else{

// header('location: ../logout.php');

// }


 ?>
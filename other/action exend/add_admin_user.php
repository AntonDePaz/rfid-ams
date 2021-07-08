<?php 
include '../includes/session.php';



if(isset($_POST['rfid']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['username']) && isset($_POST['password']) )
{

 $image = "";
 $rfid = mysqli_real_escape_string($conn,$_POST['rfid']);
 $position = mysqli_real_escape_string($conn,$_POST['position']);
 $firstname = mysqli_real_escape_string($conn,$_POST['firstname']);
 $middlename = mysqli_real_escape_string($conn,$_POST['middlename']);
 $lastname = mysqli_real_escape_string($conn,$_POST['lastname']);
 $username = mysqli_real_escape_string($conn,$_POST['username']);
 $password = mysqli_real_escape_string($conn,$_POST['password']);
 $password = sha1(md5($password));
 if(isset($_SESSION['imagepath']))
 {
 $image = $_SESSION['imagepath'];
  }
// $imagepath = "";
// $filename = $_FILES['file']['name'];
//  $location = "../../images/".$filename;
//  $uploadstatus = 1;

//  $imagefiletype = pathinfo($location,PATHINFO_EXTENSION);
//  $valid_extensions = array('jpg','jpeg','png');
//  if(!in_array(strtolower($imagefiletype), $valid_extensions))
//  {
//  	$uploadstatus = 0;
//  }
//  if($uploadstatus == 0){
//  	//echo " 0";
//  }else{

//  	if(move_uploaded_file($_FILES['file']['tmp_name'], $location)){
//  		echo $location;
//  		$imagepath = $filename;
//  	}
//  	else{
//  		//echo "0";
//  	}
//  }


//echo " imageformsession:".$_SESSION['imagepath'];
 // echo " image:".$filename;

 // echo " rfid:".$rfid;
 // echo " firstname:".$firstname;
 // echo " username:".$username;
 //  echo " password:".$password;





 
        // $sql = "INSERT INTO students1 ( id_number,firstname,lastname,year,section,course,major, ".$semester_value.", rfid ) VALUES ('$idnumber','$firstname','$lastname','$yearlevel','$section','$course','$major','1','$rfid')";









         $sql = "INSERT INTO `admin` ( `rfid`, `firstname`, `middlename`, `lastname`, `username`, `password`, `photo`,`position`) VALUES ( '$rfid','$firstname','$middlename','$lastname','$username','$password','$image','$position') ";
		 if($conn->query($sql))
		{
			echo 'Students added successfully';
			$_SESSION['imagepath'] = '';
		}
		//else
		{
			//echo 'erorr'.$conn->error;
			echo "0";
		}














		//$filename = $_FILES['images']['name'];
		
		//$filename2 = $_FILES['images']['name'];
		//echo " image:".$filename2;
		// if(!empty($filename)){
		//	move_uploaded_file($_FILES['images']['tmp_name'], '../images/'.$filename);	
		// }
		
		// $sql = "UPDATE voters SET photo = '$filename' WHERE id = '$id'";
		// if($conn->query($sql)){
		// 	$_SESSION['success'] = 'Photo updated successfully';
		// }
		// else{
		// 	$_SESSION['error'] = $conn->error;
		// }





}
else{

header('location: ../logout.php');

}







 ?>
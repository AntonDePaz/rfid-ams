<?php 

include '../includes/session.php';

if(isset($_SESSION['admin_id']) && isset($_POST['password']) && isset($_POST['username']))
{

  $image = "";
 $adminid = $_SESSION['admin_id'];
 $rfid = $_POST['rfid'];
 $firstname = $_POST['firstname'];
 $middlename = $_POST['middlename'];
 $lastname = $_POST['lastname'];
 $username = $_POST['username'];
 $password = $_POST['password'];
 // $photopath = $_POST['photopath'];
 $password = sha1(md5($password));
 if(isset($_SESSION['imagepath']))
 {
 	//echo " iamgepath";
 $image = $_SESSION['imagepath'];
  }
  else{
  	 $image = $_POST['photopath'];
  	/// echo " photopath";
  }



      // $adminid = $_POST['adminid'];
      // $rfid = $_POST['rfid'];
      // $adminfirstname = $_POST['firstname'];
      // $adminlastname = $_POST['adminlastname'];
      // $adminmiddlename = $_POST['adminmiddlename'];
      // $username = $_POST['username'];
      // $password = $_POST['password'];
     
      // $newpassword = sha1(md5($password));
      // $current_password = $_POST['current_password'];
      // $current_password = sha1(md5($current_password));
      // $haveimage = false;
      // if(isset($_SESSION['imagepath_edit'])){
      // 	 $photo = $_SESSION['imagepath_edit'];
      // 	 $haveimage = true;
      // }
// echo " adminid:".$adminid;
// echo " rfid:".$rfid;
// echo " adminfirstname:".$firstname;
// echo " adminmiddlename:".$middlename;
// echo " adminrlastname:".$lastname;
// echo " username:".$username;
// echo " password:".$password;
// echo " image:".$photopath;
// echo " current_password:".$current_password;


		$sql = "SELECT * FROM admin WHERE admin_id = '$adminid' ";
		$query = $conn->query($sql);
		if($query->num_rows < 1){
			echo 11;
		}
		else{
			$row = $query->fetch_assoc();
			if(($password == $row['password'])){
				 echo 'correct password';
					
						$sql = "UPDATE admin SET `rfid`='$rfid',`firstname`='$firstname',`middlename`='$middlename',`lastname`='$lastname',`username`='$username' WHERE admin_id = '$adminid' ";
						 if($conn->query($sql))
				          {
				            echo 'updated succesfully ';
				          }
				          else
				          {
				          echo 'ERROR updated new password ';
				          }
					if(!empty($image)){

						$sql = "UPDATE admin SET `photo`= '$image' WHERE admin_id = '$adminid' ";
						 if($conn->query($sql))
				          {
				            echo ' photo updated ';
				          }
				          else
				          {
				          echo ' no photo selected ';
				          }
						echo " photo naa:".$image;
					}
					else
					{
						echo " photo empty";
					}

			          
			}
			else{
				echo 1;
			}
		}

$sql = "SELECT * FROM admin WHERE admin_id = '$adminid'";
 $query = $conn->query($sql);
		while($row = mysqli_fetch_array($query))
         {
				$_SESSION['admin_id'] = $row['admin_id'];
				$_SESSION['rfid'] = $row['rfid'];
				$_SESSION['firstname'] = $row['firstname'];
				$_SESSION['middlename'] = $row['middlename'];
				$_SESSION['lastname'] = $row['lastname'];
				$_SESSION['username'] = $row['username'];
				$_SESSION['photo'] = $row['photo'];
				unset($_SESSION['imagepath']);
			
		 }







}
else{

header('location: ../logout.php');

}










 ?>
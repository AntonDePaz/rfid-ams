<?php

include '../model/admin.php';
$admin = new admin();

if(isset($_POST['rfid']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['username']) && isset($_POST['password']) )
{
    $image = "";
    $rfid = $_POST['rfid'];
    $position = $_POST['position'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    if(isset($_SESSION['imagepath']))
    { $image = $_SESSION['imagepath'];}
    $data = array($rfid,$position,$firstname,$middlename,$lastname,$username,$password,$image);
    $result = $admin->add_admin($data);
     echo json_encode($result);
    



}

if(isset($_SESSION['admin_id']) && isset($_POST['rfid']) && isset($_POST['username']))
{

    $image = "";
 $adminid = $_SESSION['admin_id'];
 $rfid = $_POST['rfid'];
 $firstname = $_POST['firstname'];
 $middlename = $_POST['middlename'];
 $lastname = $_POST['lastname'];
 $username = $_POST['username'];
 //$password = $_POST['password'];
 // $photopath = $_POST['photopath'];
//  $password = sha1(md5($password));
 if(isset($_SESSION['imagepath']))
 {
 	//echo " iamgepath";
 $image = $_SESSION['imagepath'];
  }
  else{
  //	 $image = $_POST['photopath'];
  $image = '';
  	/// echo " photopath";
  }
  $data = array($adminid,$rfid,$firstname,$middlename,$lastname,$username,$image);
  //var_dump($data);
  $result = $admin->edit_admin($data);
  echo json_encode($result);


}



if(isset($_POST['check_duplicate'])){
		
     $id = $_POST['check_duplicate'];
        $type = $_POST['type'];
     $result = $admin->check_duplicate($id,$type);
     echo json_encode($result);
 
     
 }
if(isset($_POST['showall'])){
		
   // $id = $_POST['del_admin_id'];

    $result = $admin->show_all_admin();
    echo json_encode($result);

    
}
if(isset($_POST['del_admin_id'])){
		
    $id = $_POST['del_admin_id'];

    $result = $admin->del_admin($id);
    echo $result;

    
}

if(isset($_POST['check_password'])){

    $password = $_POST['check_password'];
    $result = $admin->check_password($password);
    echo $result;

}

?>
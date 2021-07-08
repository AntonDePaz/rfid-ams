<?php
if(session_status() == PHP_SESSION_NONE)
{session_start();}//start session if session not start
if(!isset($_SESSION['admin_id'])){
  header('location: index.php');
 }

 

?>

<?php
	//session_start();

	// $conn = new mysqli('localhost', 'root', '', 'ssc_attendance');

	// if ($conn->connect_error) {
	//     die("Connection failed: " . $conn->connect_error);
	// }
	// include 'conn.php';

	// 	$foundb = false;
	//  $sql = "SELECT * FROM sem_status where sem_status = 1 ";
    //  $query = $conn->query($sql);
    //  while($row = $query->fetch_assoc()){ 
    //  $_SESSION['sem_id'] = $row['sem_id'];}
    //  $sql = "SELECT * FROM sy_status";
    //   $query = $conn->query($sql);
    //  while($row = $query->fetch_assoc())
    //  { 	
    //  	$foundb = true;
    //  	if($row['sy_status'] != 1){
    //  		unset($_SESSION['sy_id']);
    //  	}
    //  	else{
	// 	     	 $sql = "SELECT * FROM sy_status where sy_status = 1 ";
	// 		     $query = $conn->query($sql);
	// 		     while($row = $query->fetch_assoc())
	// 	        { 
	// 	        $_SESSION['sy_id'] = $row['sy_id'];
	// 	        }


	//      	}

    //   }

    //   if(!$foundb){
    //   	unset($_SESSION['sy_id']);
    //   }
	//	$d = time() - $_SESSION['time_login'];
   //  echo $d;
	// echo "=====".$_SESSION['time_login'];

    


	// if(!isset($_SESSION['admin']) || trim($_SESSION['admin']) == ''){
	// 	header('location: index.php');
	// }

	// $sql = "SELECT * FROM admin WHERE id = '".$_SESSION['admin']."'";
	// $query = $conn->query($sql);
	// $user = $query->fetch_assoc();
	
?>
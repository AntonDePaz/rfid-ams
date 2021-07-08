<?php 

include '../model/fee.php';
$log = new log();

if(isset($_POST['action']))
{
        $admin_name = ucwords($_SESSION['firstname']).' '.ucwords($_SESSION['lastname']).'';
	    $action = $_POST['action'];
	    $action_name = $_POST['action_name'];
	    $eventname = $_POST['description'];

        $result = $log->addloghistory($admin_name,$action,$action_name,$eventname);
        echo $result;

}

// include '../includes/session.php';

// if(isset($_POST['action']))
// {
// 	    $admin_name = ucwords($_SESSION['firstname']).' '.ucwords($_SESSION['lastname']).'';
// 	    $action = $_POST['action'];
// 	    $action_name = $_POST['action_name'];
// 	    $eventname = $_POST['description'];
//         $query2 = "INSERT INTO log_history".$_SESSION['sy_id']."  (`log_admin_name`, `log_action`, `log_action_name`, `log_description`, `sem_status`) VALUES ('$admin_name','$action','$action_name','$eventname',".$_SESSION['sem_id']." )";
//          mysqli_query($conn, $query2);
//}

 ?>
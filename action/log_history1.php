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



?>
<?php

include '../model/attendance.php';
$attendance = new attendance();

 if(isset($_POST['active_id']) && isset($_POST['active_eventid']))
{
    //$data = json_decode($_POST['active_id'], true);
	// //echo 'add sty';
	// //$data = json_decode($_POST['data'], true);
     //print_r($data);
    echo '';

    $activate_id = json_decode($_POST['active_id'], true);
    $eventid = json_decode($_POST['active_eventid'], true);
    $status = json_decode($_POST['status'], true);
   // $status = $_POST['active_status'];
    
//$taptime = $time;
   //  $tsql = "";

     $data  = array($activate_id,$eventid,$status);
     $result = $attendance->activate_attendance($data);
     echo json_encode($result);

    // if($insert == 3){
    //     echo '3';
    // }
    
    

}
if(isset($_POST['get_event_id']) && isset($_POST['concat_all_id']))
{

    $event_id = json_decode($_POST['get_event_id'],true);
	$concat_all_student_id = $_POST['concat_all_id'];
    $event_id = trim($event_id);
    $data  = array($event_id,$concat_all_student_id);
    print_r($data);
    $result = $attendance->remove_student_from_event($data);
    //echo json_encode($result);

}



// if(isset($_POST['trace']) && isset($_POST['year'])  && isset($_POST['course']) && isset($_POST['eventid']))
// {
//     $trace = json_decode($_POST['trace'],true);
//     $year = json_decode($_POST['year'],true);
//     $course = json_decode($_POST['course'],true);
//     $eventid = json_decode($_POST['eventid'],true);
//     $data = array($trace,$year,$course,$eventid);
//     $result = $attendance->filter_students($data);
//     echo json_encode($result);
// }

if(isset($_POST['loadst_eventid'])){
    $eventid =  json_decode($_POST['loadst_eventid'],true);
    $result = $attendance->load_students($eventid);
    echo json_encode($result);
}

if(isset($_POST['filter_eventid']) && isset($_POST['filter_course'])){
    $eventid =  $_POST['filter_eventid'];
    $course =  trim(strtolower($_POST['filter_course']));
    //echo ' c:'.$course;
    $result = $attendance->filter_students_course($eventid,$course);
    echo json_encode($result);
}
if(isset($_POST['filtery_eventid']) && isset($_POST['filter_year'])){
    $eventid =  $_POST['filtery_eventid'];
    $year =  trim(strtolower($_POST['filter_year']));
    //echo ' c:'.$course;
    $result = $attendance->filter_students_year($eventid,$year);
    echo json_encode($result);
}
if(isset($_POST['mast_eventid']) && isset($_POST['mast_concat_student_id'])){
    $event_id =  $_POST['mast_eventid'];
    $all_student =  $_POST['mast_concat_student_id'];
   // echo ' 1:'.$eventid; echo ' 2:'.$all_student;
    $result = $attendance->multiple_attendance_student($event_id,$all_student);
    echo json_encode($result);
}
if(isset($_POST['wrfid_eventid']) && isset($_POST['wrfid_rfid'])){
    $event_id =  $_POST['wrfid_eventid'];
    $rfid =  $_POST['wrfid_rfid'];
   // echo ' 1:'.$eventid; echo ' 2:'.$all_student;
    $result = $attendance->rfid_attendance_student($event_id,$rfid);
    echo json_encode($result);
}








?>
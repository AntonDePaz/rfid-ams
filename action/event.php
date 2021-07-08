<?php

include '../model/event.php';
$event = new event();

// if(isset($_POST['add_data']))
// {
if(isset($_POST['date']) && isset($_POST['eventname']) )
{
    echo 'add';
    $eventname = $_POST['eventname'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $tap = $_POST['tap'];
    $fines = $_POST['fines'];
    $amount = $fines * $tap;
    $data  = array($eventname,$date,$time,$tap,$fines,$amount);

   // print_r($data);
    //$data = json_decode($_POST['add_data'], true);
	// //echo 'add sty';
	// //$data = json_decode($_POST['data'], true);
     //print_r($data);
    $result = $event->add_event($data);
    echo json_encode($result);
    //if($insert == 3){
       // echo '3';
    //}
    
    

}
if(isset($_POST['getevent']))
{   
    //echo 'get event';
    $data = json_decode($_POST['getevent'], true);
    $result = $event->show_event($data);
    echo json_encode($result);
}
if(isset($_POST['value']))
{   
   
    $result = $event->showall_event();
    echo json_encode($result);
}

if(isset($_POST['edit_date']) && isset($_POST['edit_eventname']) && isset($_POST['event_id']) )
{
		 $event_id = trim($_POST['event_id']);
		 $date = $_POST['edit_date'];
		 $eventname = $_POST['edit_eventname'];
		 $time = $_POST['edit_time'];
		 $fines = $_POST['edit_fines'];
		 $tap = $_POST['edit_tap'];
		# $apm = $_POST['edit_apm'];
		 $amount = $fines * $tap;
         $data  = array($event_id,$date, $eventname,$time,$fines,$tap,$amount); 
        // print_r($data);
         $result = $event->edit_event($data);


}

if(isset($_POST['checkeventid'])){

    //echo 'chsck';
    $eventid = json_decode($_POST['checkeventid'], true);
    //$eventid = $_POST['deleteventid'];
    //echo " ".$data;
    $result = $event->check_event_active($eventid);
    echo json_encode($result);
    
                   

}
if(isset($_POST['delete_eventid'])){

    //echo 'delete';
    $eventid = json_decode($_POST['delete_eventid'], true);
    //$eventid = $_POST['deleteventid'];
    //echo " ".$data;
    $result = $event->delete_event($eventid);
    echo json_encode($result);
    
                   

}


// if(isset($_POST['get_event_time_record_id'])){

//     $eventid = $_POST['get_event_time_record_id'];
//     $result = $event->load_time_record($eventid);
//     echo json_encode($result);

// }




?>
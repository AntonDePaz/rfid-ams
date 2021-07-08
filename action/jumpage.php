<?php
if(session_status() == PHP_SESSION_NONE)
{session_start();}//start session if session not start
if(isset($_POST['jumpeventid'])){

    $eventid = $_POST['jumpeventid'];

    $_SESSION['event_id'] = $eventid;
    if(!empty($_SESSION['event_id'])){
        echo 1;
    }else {
        echo 2;
    }

    //header('location: ../eventsliststudent.php');

}






?>
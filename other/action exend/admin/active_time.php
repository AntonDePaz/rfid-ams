<?php 


include 'includes/session.php';


$activate_id = $_POST['activatetime']; //number timein is 1 timeout is 2 and so on.
$eventid = $_POST['eventid_activate'];
$time = date("h:i:sa");
$taptime = $time;

echo "activate_id : ".$activate_id;

if(isset($_POST['actived']))
{
	echo "actived";


$tsql = "UPDATE `attendance_status` SET `status`='activate',`fee_event_id`='$eventid' ,`timeactivate` = '$taptime'   WHERE as_id = '$activate_id' ";
	// for($i = 1; $i <= 6; $i++)
	// {
	// 	if($activate_id == $i)
	// 	{
	// 	//echo "actived : 1";
	// 	$tsql = "UPDATE `activate` SET `status`='activate',`eventid`='$eventid'  WHERE id = '$activate_id' ";
	//     }
	// }

// if($activate_id == 1){
// 	echo "actived : 1";
// 	$tsql = "UPDATE `activate` SET `status`='activate',`eventid`='$eventid'  WHERE id = '$activate_id' ";
//   mysqli_query($db,$tsql);
// }
// if($activate_id == 2){
// 	echo "actived : 2";
// 	$tsql = "UPDATE `activate` SET `status`='activate',`eventid`='$eventid' WHERE id = '$activate_id' ";
//  mysqli_query($db,$tsql);
// }
// if($activate_id == 3){
// 	echo "actived : 3";
// 	$tsql = "UPDATE `activate` SET `status`='activate',`eventid`='$eventid' WHERE id = '$activate_id' ";
  
// }
// if($activate_id == 4){
// 	echo "actived : 4";
// 	$tsql = "UPDATE `activate` SET `status`='activate',`eventid`='$eventid' WHERE id = '$activate_id' ";
  
// }

}
if(isset($_POST['deactivated']))
{
	echo "deactivated";

//if($activate_id == 1){
	$tsql = "UPDATE `attendance_status` SET `status`='deactivate',`fee_event_id`='0' WHERE as_id = '$activate_id' ";
 
// }
// if($activate_id == 2){
// 	$tsql = "UPDATE `activate` SET `status`='deactivate',`eventid`='0' WHERE id = '$activate_id' ";
 
// }
// if($activate_id == 3){
// 	$tsql = "UPDATE `activate` SET `status`='deactivate',`eventid`='0' WHERE id = '$activate_id' ";
 
// }
// if($activate_id == 4){
// 	$tsql = "UPDATE `activate` SET `status`='deactivate',`eventid`='0' WHERE id = '$activate_id' ";
 
// }

}

 mysqli_query($conn,$tsql);

 echo "oaky update";






header('location: eventsliststudent.php?id='.$eventid.'');







 ?>
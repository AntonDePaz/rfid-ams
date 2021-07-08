<?php 


//include '../includes/session.php';
include '../model/connection.php';
$db = new Database();


$activate_id = $_POST['id']; //number timein is 1 timeout is 2 and so on.
$eventid = $_SESSION['event_id'];
//$eventid = $_POST['eventid'];
$time = date("h:i:sa");
//$taptime = $time;
$tsql = "";

//echo "activate_id : ".$activate_id;

//if(isset($_POST['actived']))
{
	//echo "actived";


//$tsql = "UPDATE `attendance_status` SET `status`='activate',`fee_event_id`='$eventid'  WHERE as_id = '$activate_id' ";
//mysqli_query($conn,$tsql);
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
if(isset($_POST['id']))
{
	

  if($_POST['status'] != 3){
if($_POST['status'] == 1){
	$tsql = "UPDATE `attendance_status` SET `status`='activate',`fee_event_id` = '$eventid',`timeactivate`='$time' WHERE as_id = '$activate_id' ";
	mysqli_query($db->conn,$tsql);

	$tsql = "UPDATE `attendance_status` SET `status`='deactivate',`fee_event_id` = '0' ,`timeactivate`='' WHERE as_id <> '$activate_id' ";
	mysqli_query($db->conn,$tsql);


 
 }
 else{
 	$tsql = "UPDATE `attendance_status` SET `status`='activate',`fee_event_id` = '',`timeactivate`='' WHERE as_id = '$activate_id' ";
	mysqli_query($db->conn,$tsql);

	$tsql = "UPDATE `attendance_status` SET `status`='activate',`fee_event_id` = '0',`timeactivate`='' WHERE as_id <> '$activate_id' ";
	mysqli_query($db->conn,$tsql);

 }
// if($activate_id == 2){
// 	$tsql = "UPDATE `activate` SET `status`='deactivate',`eventid`='0' WHERE id = '$activate_id' ";
 
// }
// if($activate_id == 3){
// 	$tsql = "UPDATE `activate` SET `status`='deactivate',`eventid`='0' WHERE id = '$activate_id' ";
 
// }
// if($activate_id == 4){
// 	$tsql = "UPDATE `activate` SET `status`='deactivate',`eventid`='0' WHERE id = '$activate_id' ";
 
// }

$value = "";
 $value .= '<table class="table" id="attendance_status_table">';                        
                     
                    
                     $content = array('Time In morning','Time Out morning','Time In afternoon','Time Out afternoon','Time In evening','Time Out evening');
                    
                    $sql = "SELECT tap FROM fee_event where fe_id = '$eventid' ";
                    $query = $db->conn->query($sql);
                    $row = $query->fetch_assoc();
                    $pon = $row['tap'];
                      $countthis = 0; $get_status = 0;
                   	$set_status = false;
                      $sql = "SELECT * FROM attendance_status ";
                     $query = $db->conn->query($sql);
                     while($row = $query->fetch_assoc())
                    {
                      $id = $row['as_id'];
                      $status = $row['status'];
                      $geteventid = $row['fee_event_id'];
                     if($countthis == $pon){break;}
                      if( $geteventid == $eventid && $status == 'activate')
                      {
                      	$set_status = true;
                       $value .=  " <tr>
                              <td>".$content[$countthis]."</td>
                              <td><a title='delete' class='btn btn-danger btn-xs activate' data-id='".($countthis+1)."'><span id='deac'>deactivate</span></a></td>
                            </tr>";
                      }
                      else{
                             $value .= "<tr>
                              <td>".$content[$countthis]."</td>
                              <td><a title='delete' class='btn btn-success btn-xs deactivate' data-id='".($countthis+1)."'><span id='ac'>activate</span></a></td>
                            </tr>  ";
                      }
                       $countthis++;

                    }
                    
                    if(!$set_status){
                      $get_status = 0;
                    }
                    else{
                      $get_status = 1;
                    }
                     // echo "".$hai;

                   $value .= '</table> <input type="hidden" class="get_status" value='.$get_status.'>';



                   echo $value;


  }else{

  

 
$value = "";
 $value .= '<table class="table" id="attendance_status_table">';                        
                     
                    
                     $content = array('Time In morning','Time Out morning','Time In afternoon','Time Out afternoon','Time In evening','Time Out evening');
                    
                    $sql = "SELECT tap FROM fee_event where fe_id = '$eventid' ";
                    $query = $db->conn->query($sql);
                    $row = $query->fetch_assoc();
                    $pon = $row['tap'];
                      $countthis = 0; $get_status = 0;
                   	$set_status = false;
                      $sql = "SELECT * FROM attendance_status ";
                     $query = $db->conn->query($sql);
                     while($row = $query->fetch_assoc())
                    {
                      $id = $row['as_id'];
                      $status = $row['status'];
                      $geteventid = $row['fee_event_id'];
                     if($countthis == $pon){break;}
                      if( $geteventid == $eventid && $status == 'activate')
                      {
                      	$set_status = true;
                       $value .=  " <tr>
                              <td>".$content[$countthis]."</td>
                              <td><a title='delete' class='btn btn-danger btn-xs activate' data-id='".($countthis+1)."'><span id='deac'>deactivate</span></a></td>
                            </tr>";
                      }
                      else{
                             $value .= "<tr>
                              <td>".$content[$countthis]."</td>
                              <td><a title='delete' class='btn btn-success btn-xs deactivate' data-id='".($countthis+1)."'><span id='ac'>activate</span></a></td>
                            </tr>  ";
                      }
                       $countthis++;

                    }
                    
                    if(!$set_status){
                      $get_status = 0;
                    }
                    else{
                      $get_status = 1;
                    }
                     // echo "".$hai;

                   $value .= '</table> <input type="hidden" class="get_status" value='.$get_status.'>';



                   echo $value;

                  }


}
else{

header('location: ../logout.php');

}





 ?>
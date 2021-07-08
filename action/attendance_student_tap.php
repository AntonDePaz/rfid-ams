<?php


include '../includes/session.php';



//echo "idnum: ".$_POST['idnum'];



if(isset($_POST['rfid']) && isset($_POST['eventid']))
{
//$countid = 1;

$rfid = $_POST['rfid'];   //5
$eid = $_POST['eventid'];  //1 , 19  , 20


$time = date("h:i:sa");
$taptime = $time;

  $cost = 0;
  $totalamount_event = 0;
  $sql = "SELECT * FROM `fee_event` WHERE fe_id = '$eid'";
  $query = $conn->query($sql);
  while($row = $query->fetch_assoc())
  {
	$cost =  $row['fines'];
	$totalamount_event = $row['amount'];
  	}



// $foundyl = false;
//  $yr = 0;
//  $student_idmerge = 0;
//  $sq = "SELECT s.student_id
// FROM new_feevent nf
// INNER JOIN eventstatus es ON es.event_id = '$eid'
// AND nf.id = '$eid' inner join students s on s.year =
// es.yearlevel and s.major = es.major";
// $querys = $db->query($sq);
//  while($rows = $querys->fetch_assoc())
//  {
//  	if(  $id == $rows['student_id'])
//  	{
//  		$foundyl = true;
//  	}
//  // $students_id = $rows['student_id'].',';
//  // $student_idmerge .= $students_id;

// }
//$student_idmergez = rtrim($student_idmerge,',')

// $sql = "SELECT * FROM students where student_id in '$id' ";
//  $query = $db->query($sql);
//  while($row = $query->fetch_assoc())
//  {
//  $foundyl = true;
//  }




// if($foundyl == true)
//{



// activated attendance in last active
$lastacivate = 0;
$lasttime = "";
$sql3 = "SELECT * FROM `attendance_status` where fee_event_id = '$eid' order by timeactivate asc ";
 $query3 = $conn->query($sql3);
 while($row3 = $query3->fetch_assoc())
 {
 	$lastacivate = $row3['as_id'];
 	$lasttime = $row3['time'];
 	$lasttime = trim($lasttime);
 }


if(!empty($lasttime))

{


	                  $found = false;
				        $sql = "SELECT * FROM attendance_tap".$_SESSION['sy_id']." where at_fee_event_id = '$eid' and at_student_id = '$rfid' or rfidcode = '$rfid' ";
				          $query = $conn->query($sql);
				    	while($row = $query->fetch_assoc())
					     {
					    	//if($row['at_fee_event_id'] ==    && $row['at_student_id'] == $id)
					    	{
					    		$found = true;
					    		//echo " found true ";
					    	}
					      }

				        if(!$found){
				        	//echo " insert ";
						// $sql = "INSERT INTO attendance_tap (at_fee_event_id, at_student_id,".$lasttime.") VALUES ('$eid','$id','$taptime') ";
						//     mysqli_query($conn, $sql);

				        	//echo " Not Found";
				    	}
				    	else
				    	{
				    		//echo " update ";
				    			$tsql = "UPDATE attendance_tap".$_SESSION['sy_id']." SET ".$lasttime." = '$taptime' WHERE at_student_id = '$rfid' or rfidcode = '$rfid' and at_fee_event_id = '$eid' ";
				                mysqli_query($conn,$tsql);
				    	}


				    	$totalamount = 0;
				    	$sql = "SELECT * FROM attendance_tap".$_SESSION['sy_id']."  where at_fee_event_id = '$eid' and at_student_id = '$rfid' or rfidcode = '$rfid'  ";
				          $query = $conn->query($sql);
				    	while($row = $query->fetch_assoc())
					     {
					    	if(!empty($row['timein1']))
					    	{
					    		$totalamount += $cost;
					    	}
					    	if(!empty($row['timeout1']))
					    	{
					    		$totalamount += $cost;
					    	}
					    	if(!empty($row['timein2']))
					    	{
					    		$totalamount += $cost;
					    	}
					    	if(!empty($row['timeout2']))
					    	{
					    		$totalamount += $cost;
					    	}
					    	if(!empty($row['timein3']))
					    	{
					    		$totalamount += $cost;
					    	}
					    	if(!empty($row['timeout3']))
					    	{
					    		$totalamount += $cost;
					    	}
					     }

					    // echo " totalamount:".$totalamount;



					     $found1 = false;
					       $sql = "SELECT * FROM masterlist".$_SESSION['sy_id']." where mlrfidcode = '$rfid' "; //ml_student_id
				          $query = $conn->query($sql);
				    	while($row = $query->fetch_assoc())
				        {
					    	//if($row[''] == $id)
					    	{
					    		$found1 = true;
					    		//echo " found true ";
					     	}
				        }
					$pay = 'pay'.trim($eid).'';
					$pay = trim($pay);

				        if(!$found1)
				        {
				        	//echo "insert into masterlist";
				                  $sql = "INSERT INTO masterlist".$_SESSION['sy_id']." (mlrfidcode, ".$pay." ) VALUES ('$rfid','$totalamount')";
								//mysqli_query($conn, $sql);
								   if($conn->query($sql)){
										// echo 'insert successfully to masterlist ';
									}
									else{
										echo "error: ".$conn->error;
									}
				    	}
				    	else
				    	{




				    			$get_total_amount_value = $totalamount_event - $totalamount;
				    		  // echo "update into masterlist";
				    			//$tsql = "UPDATE `masterlist` SET ".$pay." = '$totalamount' WHERE ml_student_id = '$rfid'";
				    			$tsql = "UPDATE masterlist".$_SESSION['sy_id']." SET ".$pay." = '$get_total_amount_value' WHERE mlrfidcode =  '$rfid' ";
				                mysqli_query($conn,$tsql);


				    	}




}



		$value = "";
		// $value .= '<table id="exampleattend" class="table table-bordered table-striped">
  //               <thead>
  //                 <th>#</th>
  //                 <th>RFID</th>
  //                 <th>ID Number</th>
  //                 <th>First Name</th>
  //                 <th>Last Name</th>
  //                 <th>Year</th>
  //                 <th>Section</th>
  //                 <th>Course</th>
  //                 <th>Major</th>
  //                 <th width="10%"><p style="font-size: 10px;">Modify Attendance</p><a style="font-size: 20px; cursor: pointer;" class="pull-right attendance"><b><i class="fa fa-calendar-check-o" style="color: green;"></i></b></a>
  //                 </th>
  //                  </thead>
  //               <tbody>';


                    $var = 'sem'.$_SESSION["sem_id"].'';
                    $count = 1;

                    $sql = "SELECT * from students".$_SESSION['sy_id']." s inner join attendance_tap".$_SESSION['sy_id']." at on s.student_id = at.at_student_id and at.at_fee_event_id = '$eid' and s.sem".$_SESSION["sem_id"]." = 1  order by at.".$lasttime.", s.year,s.firstname";
                     $query = $conn->query($sql);
                    while($row = $query->fetch_assoc())
                    {

                    $value .= '<tr>
                          <td>'. $count++.'</td>
                          <td>'.$row['student_id'].'</td>
                          <td>'.$row['id_number'].'</td>
                          <td>'.ucwords($row['firstname']).'</td>

                          <td>'.ucwords($row['lastname']).'</td>
                          <td>'.ucwords($row['year']).'</td>
                          <td>'.ucwords($row['section']).'</td>
                          <td>'.ucwords($row['course']).'</td>
                          <td>'.ucwords($row['major']).'</td>';
                          if($row[''.$lasttime.''] != ''){
                            $value .= '<td> <i style="color:green"; class="fa fa-check"></i></td>';
                          }
                          else{
                              $value .= '<td> <i class="fa fa-remove"></i> </td>';
                              $value .= '<td><input  type="checkbox" id="chk_getid" data-id="'.$row['student_id'].'"></td>';
                          }

                          $value .= '</tr>';


                    }
                   // $value .= '</tbody> </table>';


         //  echo $value;

            $sql = "SELECT * FROM students".$_SESSION['sy_id']." WHERE rfid = '$rfid'";
		     $query = $conn->query($sql);
             $row = $query->fetch_assoc();
			 $firstname = $row['firstname'];

			 $lastname = $row['lastname'];
			 $year = $row['year'];
			 $section = $row['section'];
			 $course = $row['course'];
			 $major = $row['major'];


     // echo json_encode(['status'=>'success','html'=>$value]);

		echo json_encode(['status'=>'success','html'=>$value,'firstname'=>$firstname,'lastname'=>$lastname,'year'=>$year,'section'=>$section,'course'=>$course,'major'=>$major]);
















 //header('location: eventsliststudent.php?id='.$eid.'');


}
else{

header('location: ../logout.php');

}

 ?>

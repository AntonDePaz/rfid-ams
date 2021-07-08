<?php 

include '../includes/conn.php';
// $year = trim($_POST['year']);
// $course = trim($_POST['course']);
// $eid = trim($_POST['eventid']);

// echo " year".$year;
// echo " course".$course;
// echo " event_id".$eid;

if(isset($_POST['trace']))
{
$year = trim($_POST['year']);
$course = trim($_POST['course']);
$eid = trim($_POST['eventid']);
$trace = trim($_POST['trace']);
$lastacivate = 0;
$lasttime = "";

$sql3 = "SELECT * FROM `attendance_status` where fee_event_id = '$eid' order by timeactivate asc ";
 $query3 = $db->query($sql3);
 while($row3 = $query3->fetch_assoc())
 {
 	$lastacivate = $row3['as_id'];
 	$lasttime = $row3['time'];
 	$lasttime = trim($lasttime);
 }


					  $value = "";
					  $var = 'sem'.$_SESSION["sem_id"].'';
					  $count = 1;
                   if($trace == 1)
                   {
                    $sql = "SELECT * from students".$_SESSION['sy_id']." s inner join attendance_tap".$_SESSION['sy_id']." at on s.student_id = at.at_student_id and at.at_fee_event_id = '$eid' and s.sem".$_SESSION["sem_id"]." = 1 and at.".$lasttime." = '' and lower(s.course) = lower('$course') and s.year = '$year' order by s.year,s.firstname";
                    }
                    if($trace == 2)
                   {
                    $sql = "SELECT * from students".$_SESSION['sy_id']." s inner join attendance_tap".$_SESSION['sy_id']." at on s.student_id = at.at_student_id and at.at_fee_event_id = '$eid' and s.sem".$_SESSION["sem_id"]." = 1 and at.".$lasttime." = '' and lower(s.course) = lower('$course') and at.at_status <> 1 order by s.year,s.firstname";
                    }
                    if($trace == 3)
                   {
                    $sql = "SELECT * from students".$_SESSION['sy_id']." s inner join attendance_tap".$_SESSION['sy_id']." at on s.student_id = at.at_student_id and at.at_fee_event_id = '$eid' and s.sem".$_SESSION["sem_id"]." = 1 and at.".$lasttime." = '' and s.year = '$year' and at.at_status <> 1 order by s.year,s.firstname";
                    }
                    if($trace == 4)
                   {
                    $sql = "SELECT * from students".$_SESSION['sy_id']." s inner join attendance_tap".$_SESSION['sy_id']." at on s.student_id = at.at_student_id and at.at_fee_event_id = '$eid' and s.sem".$_SESSION["sem_id"]." = 1 and at.".$lasttime." = '' and at.at_status <> 1 order by s.year,s.firstname";
                    }
                     $query = $db->query($sql);
                    while($row = $query->fetch_assoc())
                    {   

                    $value .= '<tr>
                          <td>'. $count++.'</td>	
                          <td>'.$row['student_id'].'</td>
                          <td>'.$row['id_number'].'</td>
                          <td>'.ucwords(strtolower($row['firstname'])).'</td>

                          <td>'.ucwords(strtolower($row['lastname'])).'</td>
                          <td>'.ucwords($row['year']).'</td>
                          <td>'.ucwords(strtolower($row['section'])).'</td>
                          <td>'.ucwords(strtolower($row['course'])).'</td>
                          <td>'.ucwords(strtolower($row['major'])).'</td>
                          <td><input  type="checkbox" id="chk_getid" data-id="'.$row['student_id'].'"></td>
                        </tr>';


                    }
		        
    //         $sql = "SELECT * FROM students1 WHERE student_id = '$id'";
		  //    $query = $conn->query($sql);
    //          $row = $query->fetch_assoc(); 
			 // $firstname = $row['firstname'];
			
			 // $lastname = $row['lastname'];
			 // $year = $row['year'];
			 // $section = $row['section'];
			 // $course = $row['course'];
			 // $major = $row['major'];
			
				
      echo json_encode(['status'=>'success','html'=>$value]); 
		
	///	echo json_encode(['status'=>'success','html'=>$value,'firstname'=>$firstname,'lastname'=>$lastname,'year'=>$year,'section'=>$section,'course'=>$course,'major'=>$major]);






}
else
{
	echo " empty all";
}




 ?>
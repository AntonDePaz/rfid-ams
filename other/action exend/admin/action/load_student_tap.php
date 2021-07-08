<?php

include '../includes/session.php';

if(isset($_SESSION['sy_id']) && isset($_SESSION["sem_id"]) && isset($_POST['eventid']))
{

$eventid = $_POST['eventid'];
$lastacivate = 0;
$lasttime = "";
$sql3 = "SELECT * FROM `attendance_status` where fee_event_id = '$eventid' order by timeactivate asc ";
 $query3 = $conn->query($sql3);
 while($row3 = $query3->fetch_assoc())
 {
 	$lastacivate = $row3['as_id'];
 	$lasttime = $row3['time'];
 	$lasttime = trim($lasttime);
 }

               $value = "";


                    $var = 'sem'.$_SESSION["sem_id"].'';
                    $count = 1;

                    $sql = "SELECT * from students".$_SESSION['sy_id']." s inner join attendance_tap".$_SESSION['sy_id']." at on s.student_id = at.at_student_id and at.at_fee_event_id = '$eventid' and s.sem".$_SESSION["sem_id"]." = 1  order by at.".$lasttime.", s.year,s.firstname";
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
                            $value .= '<td> <i style='color:green'; class='fa fa-check'></i> </td>';
                          }
                          else{
                              $value .= '<td><i class='fa fa-remove'></i></td>';
                              $value .= '<td><input  type="checkbox" id="chk_getid" data-id="'.$row['student_id'].'"></td>';
                          }

                        $value .= '</tr>';


                    }

                   // $value .= '</tbody> </table>';


         //  echo $value;

    //         $sql = "SELECT * FROM students".$_SESSION['sy_id']." WHERE student_id = '$rfid'";
		  //    $query = $conn->query($sql);
    //          $row = $query->fetch_assoc();
			 // $firstname = $row['firstname'];

			 // $lastname = $row['lastname'];
			 // $year = $row['year'];
			 // $section = $row['section'];
			 // $course = $row['course'];
			 // $major = $row['major'];


      echo json_encode(['status'=>'success','html'=>$value]);

		//echo json_encode(['status'=>'success','html'=>$value,'firstname'=>$firstname,'lastname'=>$lastname,'year'=>$year,'section'=>$section,'course'=>$course,'major'=>$major]);




}









 ?>

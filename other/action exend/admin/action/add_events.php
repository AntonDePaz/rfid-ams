<?php 

 //include '../includes/session.php';

if(isset($_POST['sem']) && isset($_POST['sy']) && isset($_POST['date']) && isset($_POST['eventname']) && isset($_POST['option']) )
{
 $event_status = $_POST['option'];
 $sem = $_POST['sem'];
 $sy = $_POST['sy'];
 $date = $_POST['date'];
 $event = $_POST['eventname'];
 $time = $_POST['time'];
 $fines = $_POST['fines'];
 $num = $_POST['tap'];
 $apm = $_POST['apm'];
 $amount = $fines * $num;

 //$year = '1,2,3,4,5';
 //$major = "Programming,Networking";

 echo " ".$date."".$event."".$time;

 echo "    sem:".$sem." sy:".$sy;
 echo "    fines:".$fines." num:".$num." amount:".$amount;

 echo "     event_status:".$event_status;


//$query = "INSERT INTO `events`(`description`, `date`, `time`, `fines`,num) VALUES ('$event','$date','$time','$fines','$num')";
 //  mysqli_query($db, $query);

//$number = count($_POST['year']);
//$yearlvl = "";
//$majors = "";
   // for($i = 0; $i < 6; $i++)
   //  {

   //    if(trim($_POST['year'][$i])  != '')
   //    {
   //      $year .= $_POST['year'][$i].',';
       
   //    }
   //    if(trim($_POST['major'][$i])  != '')
   //    {
   //      $ii = $i + 1;
   //      if(trim($_POST['major'][$ii]) != trim('Programming,Networking'))
   //      {
   //        $major .= $_POST['major'][$i].',';
   //      }
       
   //    }

   //  }

  //$yearlvl = rtrim($year,",");
  //$majors = rtrim($major,",");

  $query = "INSERT INTO `fee_event`(`Description`, `date`, `time`, `tap`, `fines`, `amount`, `type`,`sem_id`,`sy_id`,`fe_status`,`apm`) VALUES ('$event','$date','$time','$num','$fines','$amount','1','$sem','$sy','$event_status','$apm')";
   mysqli_query($conn, $query);




$fee_id = 0;
$sQuery = "SELECT fe_id FROM fee_event order by fe_id";
$result = $conn->query($sQuery);
while($row = mysqli_fetch_array($result))
{
  $fee_id = $row['fe_id'];
}

   $sq = "ALTER TABLE masterlist".$_SESSION['sy_id']." ADD column pay".$fee_id." decimal(10,2)";
   // mysqli_query($conn, $sq);
    if($conn->query($sq))
    {
          $sql = "UPDATE masterlist".$_SESSION['sy_id']." SET pay".$fee_id." = '$amount'  WHERE 1 ";
        if($conn->query($sql)){
          $_SESSION['success'] = 'Fee updated successfully';
          echo " successfully";
         }
          else{
          echo "error".$conn->error;
          }
    }
    else{
      echo "error".$conn->error;
    }




$sem = 'sem'.trim($_SESSION['sem_id']).'';
$student_id = 0;
$sQuery = "SELECT * FROM students".$_SESSION['sy_id']."  where ".$sem." = 1";
$result = $conn->query($sQuery);
while($row = mysqli_fetch_array($result))
{
  $student_id = $row['student_id'];

  $query = "INSERT INTO attendance_tap".$_SESSION['sy_id']."  (`at_fee_event_id`, `at_student_id`,`at_status`) VALUES ('$fee_id','$student_id','0')";
   mysqli_query($conn, $query);


 // echo "  s.id:".$student_id;
 // echo "  e.id:".$fee_id;
}









//    			$cti = 0;
//    			$cto = 0;

//    			echo "fines :".$num;

//                   for($t = 0; $t < $num; $t++)
//                        {
//                         if($t % 2 == 0)
//                         {
//                          // echo "<th>Time In</th>";
//                           $cti++;
//                           $query1 = "ALTER TABLE eventfine ADD column Timein".$cti." varchar(60)";
//                           //  mysqli_query($db, $query1);
//                           //echo "1 ".$cti;
                          
//                         }
//                         else                         {
//                          	$cto++;
//                            $query2 = "ALTER TABLE eventfine ADD column Timeout".$cto." varchar(20)";
//                           //  mysqli_query($db, $query2);
//                          	//echo "2 ".$cto;
                          
//                          }
                        
//                        }
 

   // $query1 = "INSERT INTO `fine`(`timepo`, `status`, `student_id`, `evend_id`, `student_status`) VALUES ('$tim','deactivate','3','3','1')";
   //                           mysqli_query($db, $query1);
// $ev_id = 0;
// $sQuery = "SELECT id FROM new_feevent order by id ";
// $result = $db->query($sQuery);
// while($row = mysqli_fetch_array($result))
// {
//   $ev_id = $row['id'];
// }

//    $number = count($_POST['year']);

//    echo ' number year: '.$number;

//    if($number > 1 && $number != 1)
//    {
//     echo"number is greater than 0";
//       $vr[0] = "Programming";
//       $vr[1] ="Networking";
//    	for($i = 0; $i < $number; $i++)
//     {

//    		if(trim($_POST['year'][$i])  != '')
//    		{
//    			$year = $_POST['year'][$i];
//    			$major = $_POST['major'][$i];
//    			//$section = $_POST['section'][$i];

//         echo ' major: '.$major;
//         if($major == '1')
//         {
//               for($x = 0;$x < 2;$x++) // 2 is number of majors 
//               {
//                 $query = "INSERT INTO `eventstatus`( `yearlevel`, `major`, `event_id`) VALUES ('$year','$vr[$x]','$ev_id')";
//                   mysqli_query($db, $query);
//               }
//             }
//         else {
   		
//    			$query = "INSERT INTO `eventstatus`( `yearlevel`, `major`,  `event_id`) VALUES ('$year','$major','$ev_id')";
//           mysqli_query($db, $query);
   			  
//       }
//    		}

//    	}


   	

//    }
//    else
//     {
//       echo"numb: ".$_POST['major'];
      
//       for($s=0;$s< count($_POST['major']);$s++)
//       {
//           if($_POST['major'][$s] == "1")
//         {
//               echo 'all major';
//               $v[0] = "Programming";
//               $v[1] ="Networking";
//               for($a = 1;$a < 6; $a++)
//               {
                 
//                   for($b = 0; $b < 2; $b++)
//                   {
//                   $query = "INSERT INTO `eventstatus`( `yearlevel`, `major`, `event_id`) VALUES ('$a','$v[$b]','$ev_id')";
//                     mysqli_query($db, $query);
//                   }
//               }

//         }
//         else {
//           echo " major is: ".$_POST['major'][$s];
//             //  $v[0] = "Programming";
//              // $v[1] ="Networking";
//               $getmajor = $_POST['major'][$s];
//               for($a = 1;$a < 6; $a++)
//               {
                 
                  
//                   $query = "INSERT INTO `eventstatus`( `yearlevel`, `major`, `event_id`) VALUES ('$a','$getmajor','$ev_id')";
//                     mysqli_query($db, $query);
                  
//               }

//         }

//       }
      



//    	//	$query = "INSERT INTO `eventstatus`( `yearlevel`, `major`, `event_id`) VALUES ('1,2,3,4,5','Programming,Networking','$ev_id')";
//    			//	 mysqli_query($db, $query);

//    	}











/////////////////////////////////////////////////////////////





// $ev_id = 0;
// $sQuery = "SELECT id FROM new_feevent order by id ";
// $result = $db->query($sQuery);
// while($row = mysqli_fetch_array($result))
// {
//   $event_id = $row['id'];
// }


// $studentyeararray = array();
// $studentmajorarray = array();
// $studentyearindex = 0;
// $student_idm = "";
// $student_idmerge = "";


// $query = "SELECT nf.id, nf.description, es.event_id, es.yearlevel, es.major, nf.amount, s.student_id, s.year, s.firstname, s.year, s.major
// FROM new_feevent nf
// INNER JOIN eventstatus es ON es.event_id = '$event_id'
// AND nf.id = '$event_id'
// INNER JOIN students s ON s.year = es.yearlevel
// AND s.major = es.major
// ";
// $result = $db->query($query);
// while($row = mysqli_fetch_array($result))
// {  
//   //$studentyeararray[$studentyearindex] = $row['yearlvl'];
//  // $studentmajorarray[$studentyearindex] = $row['major'];
//  // $studentyearindex++;
//    //echo " id ".$row['student_id'];

//     $student_idm = $row['student_id'].',';
//     $student_idmerge .= $student_idm;
// }

// $r = rtrim($student_idmerge,',');
// $rt = $r;




//     $sQuery = "SELECT * FROM students where student_id not in (".$rt.")";
//     $result = $db->query($sQuery);
//     while($row = mysqli_fetch_array($result))
//     {  
     
//               echo " + ".$row['student_id'];
//                $student_id = $row['student_id'];

//                if($student_id != 0){
//                $found1 = false;
              
//                 $sql = "SELECT * FROM `activities_fines`";
//                   $query = $db->query($sql);
//               while($row = $query->fetch_assoc())
//              {
//               if($row['afstudent_id'] == $student_id)
//               {
//                 $found1 = true;
//                 echo " found true ";
//               }
//               }

//                 if(!$found1)
//                 { 
//                   echo "insert into activities_fines";
//                   $sql = "INSERT INTO activities_fines ( afstudent_id,eventfee_id, a".$event_id.") VALUES ('$student_id','$fees_id','$amount')";
//                   mysqli_query($db, $sql); 
//               }
//               else
//               {
//                      echo "update into activities_fines";
//                   $tsql = "UPDATE `activities_fines` SET a".$event_id." = '$amount' WHERE afstudent_id = '$student_id'";
//                         mysqli_query($db,$tsql);
                
              
//               }

//             }


//     }







} // end if isset
else{

header('location: ../logout.php');

}



 ?>
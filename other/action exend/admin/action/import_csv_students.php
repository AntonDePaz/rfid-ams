<?php 
//include '../includes/conn.php';
include '../model/connection.php';
//include '../model/event.php';
include '../model/student.php';
//session_start();

if(!empty($_FILES['csvfile']['name']))
{
    $db = new Database();
   
   // $event = new event();
    $student = new student();



 //echo $data;


     date_default_timezone_set('Asia/Manila');
     $date = date("Y-m-d");

        $output = "";
	$allowed_ext = array('csv');
	$extension = end(explode('.',$_FILES['csvfile']['name']));
	if(in_array($extension,$allowed_ext))
	{
        $correct_align_column = array('rfid','idnumber','firstname','middlename','lastname','year','section','course','major');
		$file_data = fopen($_FILES['csvfile']['tmp_name'], 'r');
		$getdata = fgetcsv($file_data);
        $found = false;
        $count_from_import_data = count($getdata);
        $count_correct_align_column = count($correct_align_column);
        if($count_correct_align_column == $count_from_import_data){
           // echo "pila".$count_from_import_data;
            for($i=0;$i < $count_correct_align_column;$i++){ 
                if(strtolower($correct_align_column[$i]) != strtolower($getdata[$i])){ $found = true; }
               }
               if(!$found){
                    while ($row = fgetcsv($file_data)) 
                    {
                        $rfid = mysqli_real_escape_string($db->conn,$row[0]);
                        $idnumber = mysqli_real_escape_string($db->conn,$row[1]);
                        $firstname = ucwords(strtolower(mysqli_real_escape_string($db->conn,$row[2])));
                        $middlename = ucwords(strtolower(mysqli_real_escape_string($db->conn,$row[3])));
                        $lastname = ucwords(strtolower(mysqli_real_escape_string($db->conn,$row[4])));
                        $year = mysqli_real_escape_string($db->conn,$row[5]);
                        $section = mysqli_real_escape_string($db->conn,$row[6]);
                        $course =ucwords(strtolower( mysqli_real_escape_string($db->conn,$row[7])));
                        $major = ucwords(strtolower(mysqli_real_escape_string($db->conn,$row[8])));
                        $sem = $_SESSION['sem_id'];
                        
                    //    echo $rfid; echo $idnumber; echo $firstname; echo  $middlename;
                    //    echo $lastname; echo $year; echo $section; echo $course; echo $major;
                        $checkf = 0;
                       // if(!empty($idnumber) && !empty($rfid) ){
                        $sql = "SELECT * FROM students".$_SESSION['sy_id']." ";
                        	$query = $db->conn->query($sql);
                        	while($rows = $query->fetch_assoc()){
                                if(!empty($idnumber)){
                                    if(trim($rows['id_number']) == trim($idnumber)){
                                // echo "3"."-".$rows['id_number']."=".$idnumber;
                                        $checkf = 3;
                                        break;
                                    }
                               }
                                if(!empty($rfid)){
                                    if(trim($rows['rfid']) == trim($rfid)){
                                    // echo "4"."-".$rows['rfid']."=".$rfid;
                                        $checkf = 4;
                                        break;
                                    }
                                }
                            }
                       // }
                        	if($checkf == 0){
                              // echo '0';
                                if($sem == 1){
                                 //   echo ' s1 ';
                               $query = "INSERT INTO students".$_SESSION['sy_id']." (rfid,id_number,firstname,middlename,lastname,year,section,course,major,sem1,sem2 ) VALUES 
                               ('$rfid','$idnumber','$firstname','$middlename','$lastname','$year','$section','$course','$major', '1','1') ";
                                }
                                if($sem == 2){
                                   // echo ' s2 ';
                                   $query = "INSERT INTO students".$_SESSION['sy_id']." (rfid,id_number,firstname,middlename,lastname,year,section,course,major,sem2 ) VALUES 
                               ('$rfid','$idnumber','$firstname','$middlename','$lastname','$year','$section','$course','$major', '1') ";
                                }
                               // $db->query($query);
                               $result = $db->conn->query($query);
				        //	if($result){
					// 	return 1;	
				//	echo 104;
                                  
                                  //  return 1;
                              //  }

                         } # if checkf = 0 

                         

                        //  $sql = "SELECT max(student_id) as get FROM students".$_SESSION['sy_id']." ";
                        //  $result = $db->conn->query($sql);
                        //  while($row1 = $result->fetch_assoc()){
                        //      $student_id = $row1['get'];
                        //  }
                        //  $query = "INSERT INTO masterlist".$_SESSION['sy_id']."  (`ml_student_id`) VALUES ('$student_id')";
                        //  mysqli_query($db->conn, $query);
                        
                        //  $data = $event->showall_event();
                        //  if(!empty($data)){
                        //      foreach($data as $gett)
                        //      {   
                        //          echo "d1:".$gett['date']." == d3:".$date;
                        //          if($gett['date'] >= $date){
                        //              echo 'success';
                        //              $fee_id = $gett['fe_id'];
                        //              $query = "INSERT INTO attendance_tap".$_SESSION['sy_id']."  (`at_fee_event_id`, `at_student_id`,`at_status`) VALUES ('$fee_id','$student_id','0')";
                        //              mysqli_query($db->conn, $query);
                        //          }
                        //      }
                        //  }

                         
            
                    }
                    $student->add_student_id_ml_at();
              } else { echo 'Incorrect column alignment'; }
        } else { echo 'invalid correct number of column'; }
       
    } else { echo 'this is not a csv file'; }

// //    $allowed_ext = array('csv');
// //    $filename = $_FILES['csvfile']['name'];
// // 	$extension = end(explode('.',$filename));
// // 	if(in_array($extension,$allowed_ext))
// // 	{
// //        // echo 'okay cxa';
    
// //     $filename=$_FILES["csvfile"]["tmp_name"];
// //  //get the first row fields 
// // $correct_align_column = array('rfid','idnumber','firstname','middlename','lastname','year','section','course','major');
// //  if (($handle = fopen($filename, "r")) !== FALSE) {
// // 	 if(($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
// // 		 $num = count($data);
// //        //  print_r($data);
// //          $found = false;
//          $check_correct_align_column = count($correct_align_column);
//          if($check_correct_align_column == $num){
//             for ($c=0; $c < $num; $c++) {
//                // echo $data[$c]."--".$correct_align_column[$c];
//                  if(strtolower($data[$c]) != strtolower($correct_align_column[$c])){
//                      $found = true;
//                    }
//             }
//             if(!$found){
//               //  echo 'sakto tanan';
//               //  $file = fopen($filename, "r");
//               //  while (($row = fgetcsv($file, 10000, ",")) !== FALSE)
//                 $file_data = fopen($_FILES['csvfile']['tmp_name'], 'r');
//                 fgetcsv($file_data);
//                 while ($row = fgetcsv($file_data)) 
//                 {
//                         $rfid = mysqli_real_escape_string($db,$row[0]);
//                        $idnumber = mysqli_real_escape_string($db,$row[1]);
//                         $firstname = mysqli_real_escape_string($db,$row[2]);
//                         $middlename = mysqli_real_escape_string($db,$row[3]);
//                         $lastname = mysqli_real_escape_string($db,$row[4]);
//                         $year = mysqli_real_escape_string($db,$row[5]);
//                         $section = mysqli_real_escape_string($db,$row[6]);
//                         $course = mysqli_real_escape_string($db,$row[7]);
//                         $major = mysqli_real_escape_string($db,$row[8]);
//                         $sem = $_SESSION['sem_id'];
            
//                         echo $rfid; echo $idnumber; echo $firstname; echo  $middlename;
//                         echo $lastname; echo $year; echo $section; echo $course; echo $major;
//                         // $checkf = 0;
//                         // $sql = "SELECT * FROM students".$_SESSION['sy_id']." ";
//                         // 	$query = $db->query($sql);
//                         // 	while($row = $query->fetch_assoc()){
//                         //         if(trim($row['id_number']) == trim($idnumber)){
//                         //             //echo "3"."-".$row['id_number']."=".$idnumber;
//                         //             $checkf = 3;
//                         //             break;
//                         //         }
//                         //         if(trim($row['rfid']) == trim($rfid)){
//                         //            // echo "4"."-".$row['rfid']."=".$rfid;
//                         //             $checkf = 4;
//                         //             break;
//                         //         }
//                         //     }
//                         // 	if($checkf == 0){
//                         //       // echo '0';
//                         //         if($sem == 1){
//                         //             echo ' s1 ';
//                         //       //  $query = "INSERT INTO students".$_SESSION['sy_id']." (rfid,id_number,firstname,middlename,lastname,year,section,course,major,sem1,sem2 ) VALUES 
//                         //       //  ('$rfid','$idnumber','$firstname','$middlename','$lastname','$year','$section','$course','$major', '1','1') ";
//                         //         }
//                         //         if($sem == 2){
//                         //            // echo ' s2 ';
//                         //           //  $query = "INSERT INTO students".$_SESSION['sy_id']." (rfid,id_number,firstname,middlename,lastname,year,section,course,major,sem1 ) VALUES 
//                         //        // ('$rfid','$idnumber','$firstname','$middlename','$lastname','$year','$section','$course','$major', '1') ";
//                         //         }
//                         //        // $db->query($query);
//                         //     }

            
//                 }
//             } else {
//                 echo 'dili correct ang alignment sa column';
//             }

//          }
//          else{
//              echo 'kulang column sa imong excel';
//          }
// 		//  $fieldsInsert .= '(';
		 
// 	  }
// 	}

  

// 	}
// 	else
// 	{
// 		echo " dili csv ang extension";
// 	}


}
else {
	echo "no file uploaded";
}











 ?>
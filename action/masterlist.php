<?php
session_start();

if(isset($_POST['year']) && isset($_POST['course']) && isset($_POST['type'])  )
{
   // echo 'hai';
   // $id = $_POST['getinfo'];
  // echo " alll id:";
    $year = $_POST['year'];
    $course = $_POST['course'];
    $type = $_POST['type'];
   // echo "1".$year;echo "2".$course; echo "3".$type;
//    // if($type == 'print'){
    $_SESSION['pyear'] = $year;
    $_SESSION['pcourse'] = $course;
    $_SESSION['ptype'] = $type;
//     if($type == 'print'){
//        // header('location: prints.php');
//     echo 1;
//     }

    if($type == 'excel'){
       // window.open('student_export_excel.php.php');
        echo 2;
        }
     if($type == 'print'){
      // $row = $student->print_student($year,$course);
       // echo json_encode($row);
          echo 2;
     }
	//echo 'add sty';
	// $id = json_decode($_POST['delete_id'], true);
    //  print_r($year);
    //  print_r($course);
   //$row = $student->showallst();
    
    // echo json_encode($row);
}





?>


<?php

include '../model/stu.php';
$student = new student();

 if(isset($_POST['rfid']) && isset($_POST['idnumber']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['section']) )
{
    $rfid = $_POST['rfid'];
    $idnumber = $_POST['idnumber']; 
    $firstname = $_POST['firstname']; 
    $middlename = $_POST['middlename']; 
    $lastname = $_POST['lastname']; 
    $section = $_POST['section'];  
    $year = $_POST['yearlevel']; 
    $course = $_POST['course']; 
    $major = $_POST['major']; 
    //$data = json_decode($_POST['data'], true);
    $data = array($rfid,$idnumber,$firstname,$middlename,$lastname,$section,$year,$course,$major);
	// //echo 'add sty';
	// //$data = json_decode($_POST['data'], true);
   //  print_r($data);
    $insert = $student->insert_student($data);
    echo $insert;
    // if($insert == 3){
    //     echo 'id number is exist';
    // }
    // if($insert == 4){
    //     echo 'rfid is exist';
    // }
    
    

}
if(isset($_POST['getinfo']))
{
    //$id = $_POST['getinfo'];
    //echo " id:".$id;
    //$data = json_decode($_POST['data'], true);
	// //echo 'add sty';
	$id = json_decode($_POST['getinfo'], true);
    // print_r($data);
    $row = $student->getstudent($id);
    echo json_encode($row);
    
   
    

}
if(isset($_POST['edit_id']) && isset($_POST['edit_rfid']) && isset($_POST['edit_idnumber']) && isset($_POST['edit_firstname']) && isset($_POST['edit_lastname']) && isset($_POST['edit_section']) )
{
    $id = $_POST['edit_id'];
    $rfid = $_POST['edit_rfid'];
    $idnumber = $_POST['edit_idnumber']; 
    $firstname = $_POST['edit_firstname']; 
    $middlename = $_POST['edit_middlename']; 
    $lastname = $_POST['edit_lastname']; 
    $section = $_POST['edit_section'];  
    $year = $_POST['edit_yearlevel']; 
    $course = $_POST['edit_course']; 
    $major = $_POST['edit_major']; 
    $drfid = $_POST['drfid']; 
    $didnumber = $_POST['didnumber']; 
    //$data = json_decode($_POST['data'], true);
    $data = array($id,$rfid,$idnumber,$firstname,$middlename,$lastname,$section,$year,$course,$major,$drfid,$didnumber);
	// //echo 'add sty';
	// //$data = json_decode($_POST['data'], true);
   //  print_r($data);
   $row = $student->edit_student($data);
   echo json_encode($row);
    // if($insert == 3){
    //     echo 'id number is exist';
    // }
    // if($insert == 4){
    //     echo 'rfid is exist';
    // }
}

// if(isset($_POST['data_edit']))
// {
//     //$id = $_POST['getinfo'];
//     //echo " id:".$id;
//     //$data = json_decode($_POST['data'], true);
// 	// //echo 'add sty';
// 	$data = json_decode($_POST['data_edit'], true);
//     // print_r($data);
//     $row = $student->edit_student($data);
//     echo json_encode($row);
// }
if(isset($_POST['delete_id']))
{
    //$id = $_POST['getinfo'];
    //echo " id:".$id;
    //$data = json_decode($_POST['data'], true);
	// //echo 'add sty';
	$id = json_decode($_POST['delete_id'], true);
    // print_r($data);
    $row = $student->del_student($id);
    echo json_encode($row);
}

if(isset($_POST['printmasterlist']))
{
   // echo 'hai';
   // $id = $_POST['getinfo'];
  // echo " alll id:";
    //$data = json_decode($_POST['data'], true);
	//echo 'add sty';
	// $id = json_decode($_POST['delete_id'], true);
    // print_r($data);
   $row = $student->print_masterlist();
   echo json_encode($row);
}
if(isset($_POST['alldata']))
{
   // echo 'hai';
   // $id = $_POST['getinfo'];
  // echo " alll id:";
    //$data = json_decode($_POST['data'], true);
	//echo 'add sty';
	// $id = json_decode($_POST['delete_id'], true);
    // print_r($data);
   $row = $student->showall_student();
   echo json_encode($row);
}

if(isset($_POST['year']) && isset($_POST['course']) && isset($_POST['type'])  )
{
   // echo 'hai';
   // $id = $_POST['getinfo'];
  // echo " alll id:";
    $year = $_POST['year'];
    $course = $_POST['course'];
    $type = $_POST['type'];
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
       $row = $student->print_student($year,$course);
        echo json_encode($row);
    //      echo 2;
     }
	//echo 'add sty';
	// $id = json_decode($_POST['delete_id'], true);
    //  print_r($year);
    //  print_r($course);
   //$row = $student->showallst();
    
    // echo json_encode($row);
}


// if(isset($_FILES['csvfile']['name']))
// {
//     if(!empty($_FILES['csvfile']['name']))
//    {
//     //echo 'import';
//     $output = "";
// 	$allowed_ext = array('csv');
// 	$extension = end(explode('.',$_FILES['csvfile']['name']));
// 	if(in_array($extension,$allowed_ext))
// 	{
// 		$file_data = fopen($_FILES['csvfile']['tmp_name'], 'r');
// 		fgetcsv($file_data);
//         $row = fgetcsv($file_data);
//       //  while ($row = fgetcsv($file_data)) 
// 		{
//           $model->import_csv_student($row);
//         //   $rfid = $row[0];
//         //    $idnumber = mysqli_real_escape_string($this->conn,$row[1]);
// 		// 	$firstname = mysqli_real_escape_string($this->conn,$row[2]);
//         //     $middlename = mysqli_real_escape_string($this->conn,$row[3]);
// 		// 	$lastname = mysqli_real_escape_string($this->conn,$row[4]);
// 		// 	$year = mysqli_real_escape_string($this->conn,$row[5]);
// 		// 	$section = mysqli_real_escape_string($this->conn,$row[6]);
// 		// 	$course = mysqli_real_escape_string($this->conn,$row[7]);
// 		// 	$major = mysqli_real_escape_string($this->conn,$row[8]);
//         //     $query = "INSERT INTO students".$_SESSION['sy_id']." (rfid,id_number,firstname,middlename,lastname,year,section,course,major,sem".$_SESSION['sem_id']." ) VALUES 
//         //     ('$rfid','$idnumber','$firstname','$middlename','$lastname','$year','$section','$course','$major', '1') ";
//         //      $result = $this->conn->query($query);
//         //      if($result){
//         //         echo '1';
//         //     }
//         //     else{
//         //         echo '2';
//         //     }
//         }
//         //echo json_encode();
//     }
   
//    }
// }




if(isset($_POST['showallstu'])){

    $row = $student->showall_student22();
    echo json_encode($row);
    
}

// if(isset($_POST['all'])){

//     $value = "";
//     $value .= '';
//      $data = $model->showall_student();
//                       if(isset($_SESSION['sy_id'])){
//                         $countz = 1;
                       
//                             if(!empty($data)){
//                             foreach($data as $row){
//                   $data = $model->showall_student();
//                   if(isset($_SESSION['sy_id'])){
//                     $countz = 1;
                   
//                         if(!empty($data)){
//                         foreach($data as $row){
//                             $value .= "
//                         <tr>
//                           <td>".$countz++."</td
//                           <td>".$row['id_number']."</td>
//                           <td>".ucwords(strtolower($row['firstname']))."</td>
//                           <td>".ucwords(strtolower($row['middlename']))."</td>
//                           <td>".ucwords(strtolower($row['lastname']))."</td>
//                           <td>".$row['year']."</td>  
//                           <td>".ucwords(strtolower($row['section']))."</td>
//                           <td>".ucwords(strtolower($row['course']))."</td>
//                           <td>".ucwords(strtolower($row['major']))."</td>
//                           <td class='modify'>
//                             <a class='btn btn-default btn-xs edit' title='edit' data-id=".$row['student_id']."><i class='fa fa-edit'> edit</i></a>
//                            &nbsp;&nbsp; <a class='btn btn-default btn-xs del' title='delete' data-id=".$row['student_id']."> <i class='fa fa-trash-o'> delete</i></a>
//                           </td>
//                         </tr>
//                       ";
//                     }
//                   }
//                 }
//               $value .= '';

//               echo json_encode($value); 
   
// }


?>

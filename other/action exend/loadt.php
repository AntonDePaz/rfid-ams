<?php

include '../includes/conn.php';
$output = array();
$sql = "SELECT * FROM students".$_SESSION['sy_id']." where sem".$_SESSION['sem_id']." = 1 order by year,firstname";
$result = $db->query($sql);
if($result){
    if($result->num_rows > 0){
        $count = 1;
        $data = array();
    while($row = $result->fetch_assoc()){
         $sub_array = array();
         $sub_array[] = $count++;
         $sub_array[] = $row['id_number'];
         $sub_array[] = ucwords(strtolower($row['firstname']));
         $sub_array[] = ucwords(strtolower($row['middlename']));
         $sub_array[] = ucwords(strtolower($row['lastname']));
         $sub_array[] = $row['year'];
         $sub_array[] = strtoupper($row['section']);
         $sub_array[] = ucwords(strtolower($row['course']));
         $sub_array[] = ucwords(strtolower($row['major']));
         $sub_array[] = "<a class='btn btn-default btn-xs edit' title='edit' data-id=".$row['student_id']."><i class='fa fa-edit'> edit</i></a> &nbsp;&nbsp; <a class='btn btn-default btn-xs del' title='delete' data-id=".$row['student_id']."> <i class='fa fa-trash-o'> delete</i></a>";  
        $data[] = $sub_array;

    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
}
}
// include '../model/student.php';
// $student = new student();
// $row = $student->showall_student();
// echo  json_encode($row);


?>


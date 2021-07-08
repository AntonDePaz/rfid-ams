<?php 
include '../includes/session.php';

if(!empty($_FILES['csvfile']['name']))
{


	$output = "";
	$allowed_ext = array('csv');
	$extension = end(explode('.',$_FILES['csvfile']['name']));
	if(in_array($extension,$allowed_ext))
	{
		$file_data = fopen($_FILES['csvfile']['tmp_name'], 'r');
		$dat = fgetcsv($file_data);
        foreach($dat as $data){ echo '-'.$data; }
		while ($row = fgetcsv($file_data)) 
		{
            foreach($row as $datas){ echo '  +'.$datas; }
			// $idnumber = mysqli_real_escape_string($conn,$row[0]);
			// $firstname = mysqli_real_escape_string($conn,$row[1]);
            // $middlename = mysqli_real_escape_string($conn,$row[2]);
			// $lastname = mysqli_real_escape_string($conn,$row[2]);
			// $year = mysqli_real_escape_string($conn,$row[3]);
			// $section = mysqli_real_escape_string($conn,$row[4]);
			// $course = mysqli_real_escape_string($conn,$row[5]);
			// $major = mysqli_real_escape_string($conn,$row[6]);


			//$sem = mysqli_real_escape_string($conn,$row[]);
       // $rfid = mysqli_real_escape_string($conn,$row[9]);

     // echo $idnumber;

			// $query = "INSERT INTO students (firstname,middlename,lastname,yearlevel,section,course,major,sem_id,rfid,idnumber) VALUES 
			//   ('$firstname','$middlename','$lastname','$year','$section','$course','$major','$sem','$rfid','$idnumber') ";

        //    $query = "INSERT INTO students".$_SESSION['sy_id']." (id_number,firstname,lastname,year,section,course,major,sem".$_SESSION['sem_id']." , rfid) VALUES 
        //    ('$idnumber','$firstname','$lastname','$year','$section','$course','$major', '1','1023871321') ";
		// 	  mysqli_query($conn,$query);

			// $query = "SELECT * FROM students";
			// $result = mysqli_query($conn,$query);
			// $output .= " <table id='example1' class='table table-bordered'>
   //              <thead>
   //                <th>#</th>
   //                <th>ID Number</th>
   //                <th>Firstname</th>
   //                <th>Lastname</th>
   //                <th>Year</th>
   //                <th>Section</th>
   //                <th>Course</th>
   //                <th>Major</th>
   //                <th></th>
   //              </thead> "; 

   //              while ($row = mysqli_fetch_array($result)) 
   //              {
   //              	$output .= "<tr>
   //                        <td>1</td
   //                        <td></td>
   //                        <td>".$row['idnumber']."</td>
   //                        <td>".$row['firstname']."</td>
   //                        <td>".$row['lastname']."</td>
   //                        <td>".$row['year']."</td>
   //                        <td>".$row['section']."</td>
   //                        <td>".$row['course']."</td>
   //                        <td>".$row['major']."</td>
   //                        <td>
   //                          <button class='btn btn-success btn-sm edit btn-flat' data-id='".$row['student_id']."'><i class='fa fa-edit'></i> Edit</button>
   //                          <button class='btn btn-danger btn-sm delete btn-flat' data-id='".$row['student_id']."'><i class='fa fa-trash'></i> Delete</button>
   //                        </td>
   //                      </tr>";	
   //              }
   //              $output .= "</table>";

   //              //echo $output;

   //              	echo json_encode(['status'=>'success','html'=>$output]);




		}

	}
	else
	{
		echo "error1";
	}


}
else {
	echo "error2";
}













 ?>
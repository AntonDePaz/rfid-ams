<?php 


include '../includes/session.php';


if(isset($_POST['get_event_id']) && isset($_POST['concat_all_id']))
{

	$event_id = $_POST['get_event_id'];
	$event_id = trim($event_id);
	$concat_all_student_id = $_POST['concat_all_id'];

	//echo " student_id: ".$student_id;
	//echo " concat_fee_event_id: ".$concat_fee_event_id;

	
	$cost = 0;
	$sql = "SELECT * FROM `fee_event` WHERE fe_id = '$event_id'";
	$query = $conn->query($sql);
    while($row = $query->fetch_assoc())
	{
		$fines =  $row['fines'];
		$tap =  $row['tap'];
		$cost = $fines * $tap;
    }

	$stringval = trim(rtrim($concat_all_student_id,','));

	$pieces = explode(",", $stringval);

	print_r($pieces);

    for($i = 0;$i< count($pieces);$i++)
	{
		
		$student_id = trim($pieces[$i]);

		  	$sql = "UPDATE attendance_tap".$_SESSION['sy_id']." SET `at_status`= '1' WHERE at_fee_event_id = '$event_id' and at_student_id = '$student_id' ";
				if($conn->query($sql))
				{
					//$_SESSION['success'] = 'Voter added successfully';
					echo " insert successfully";
				}
				else
				{
					//$_SESSION['error'] = $conn->error;
					echo " error: ".$conn->error;
				}

				$found = 0;
				$sql = "SELECT * FROM masterlist".$_SESSION['sy_id']." WHERE ml_student_id = '$student_id' ";
				$query = $conn->query($sql);
			    while($row = $query->fetch_assoc())
				{
					$found = true;
			    }

			    if(!$found)
			    {
			    	$sql = "INSERT INTO masterlist".$_SESSION['sy_id']." ( `ml_student_id`, pay".$event_id." ) VALUES ('$student_id','$cost')";
					if($conn->query($sql))
					{
						//$_SESSION['success'] = 'Voter added successfully';
						echo "Insert successfully";
					}
					else
					{
						//$_SESSION['error'] = $conn->error;
						echo " error: ".$conn->error;
					}
			    }
			    else
			    {
					$sql = "UPDATE masterlist".$_SESSION['sy_id']." SET  pay".$event_id." = '$cost' WHERE ml_student_id = '$student_id' ";
					if($conn->query($sql))
					{
						//$_SESSION['success'] = 'Voter added successfully';
						echo "UPDATED successfully";
					}
					else
					{
						//$_SESSION['error'] = $conn->error;
						echo " error: ".$conn->error;
					}
			    }
		

      }


      
          	





      	// $output = '';
      	// $output .= '<table id="example1" class="table table-bordered table-striped">
       //          <thead>
       //            <th>#</th>
       //            <th><a href="#removestudent" data-toggle="modal"><i class="fa fa-trash" title="remove" style="color: red;"></a></button></th>
       //            <th>ID Number</th>
       //            <th>Full Name</th>
       //            <th>Year/Section/Major</th>'; 


       //            for($t = 0; $t < $number_of_attend; $t++)
       //                 {
       //                  if($t % 2 == 0)
       //                  {
       //                    $output .= "<th>TimeIn <span style='font-size: 10px;'><i class='fa fa-circle text-success'></i></span></th>";
       //                    // $sql1 = "ALTER TABLE students add Timein decimal(10,2)";
       //                    // $query1 = $db->query($sql1);
       //                  }
       //                  else
       //                   {
       //                     $output .= "<th>TimeOut</th>";
       //                    // $sql1 = "ALTER TABLE students add Timeout decimal(10,2)";
       //                   // $query1 = $db->query($sql1);
                          
       //                   }
                        
       //                 }


       //               $output .= '</th>
       //          </thead>
       //          <tbody>';

       //          $var = 'sem'.$_SESSION["sem_id"].'';
       //              $count = 1;
       //              $sql = "SELECT * from students1 s inner join attendance_tap at on s.student_id = at.at_student_id and at.at_fee_event_id = '$eventid' and s.sem".$_SESSION["sem_id"]." = 1 and at.at_status <> 1  order by s.year,s.firstname";
       //               $query = $conn->query($sql);
       //              while($row = $query->fetch_assoc())
       //              {  
                
       //          	 $output .= '<tr>
       //                    <td>'.$count++;'</td>
       //                    <td><input title="remove" type="checkbox" id="chk_getid" data-id="'.$row['student_id'].'"></td>
       //                    <td>'.$row['id_number'].'</td>
       //                    <td>'. ucwords($row['firstname']).' '.$row['lastname'] .'</td>
       //                    <td>'.$row['year'].' - '.$row['section'].'  '.$row['major'].'</td>';
                          
       //                      for($i = 1; $i <= ($number_of_attend / 2);$i++ )
       //                      {
                            
       //                    $output .= '<td>';
       //                    if(empty($row['timein'.$i.''])){"<p style='font-size: 12px;'> --:--:-- --</p>";}else{ $row['timein'.$i.''];}
       //                   $output .='</td>';
       //                     $output .= '<td>';
       //                    if(empty($row['timeout'.$i.''])){  "<p style='font-size: 12px;'> --:--:-- --</p>";}else{ $row['timeout'.$i.''];}
       //                   $output .='</td>';
       //                 }
       //          $output .= " </tbody>
       //        </table>";

       //          //echo $output;

       //          	echo json_encode(['status'=>'success','html'=>$output]);



}



 ?>

 
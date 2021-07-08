<?php 

include '../includes/session.php';




if(isset($_POST['student_id']) && isset($_POST['tshirt_size']) && isset($_POST['fee_id']) && isset($_POST['tshirt_amount'])  )
{
	$student_id = $_POST['student_id'];
    $tshirt_size = $_POST['tshirt_size'];
    $fee_id = trim($_POST['fee_id']);
    $tshirt_amount = $_POST['tshirt_amount'];




    $concat_student_id = trim(rtrim($student_id,','));
    $concat_tshirt_size = trim(rtrim($tshirt_size,','));

	$piece_student_id = explode(",", $concat_student_id);
	$piece_tshirt_size = explode(",", $concat_tshirt_size);

	// echo " fee_id:".$fee_id;
	// echo " tshirt_amount:".$tshirt_amount;
	print_r($piece_student_id);
	print_r($piece_tshirt_size);

	

    for($i = 0;$i< count($piece_student_id);$i++)
	{
			//echo ">".$piece_student_id[$i].":".$piece_tshirt_size[$i]."<";

			$tshirt_sizes = $piece_tshirt_size[$i];
			  if($tshirt_sizes == 'cancel'){
			  	$tshirt_sizes = '';
			  }

			 // echo " ts>".$tshirt_sizes.'< sid>'.$piece_student_id[$i]."<";
			 // echo " fee_id:".$fee_id.'< ->amount'.$tshirt_amount;

			$found = false;
			$sql = "SELECT * FROM tshirt_size".$_SESSION['sy_id']." WHERE ts_student_id = '$piece_student_id[$i]'";
			$query = $conn->query($sql);
		    while($row = $query->fetch_assoc())
			{
				$found = true;
		    }
			if(!$found)
			{
			$query = "INSERT INTO tshirt_size".$_SESSION['sy_id']." (`ts_student_id`, size".$fee_id." ) VALUES ('$piece_student_id[$i]', '$tshirt_sizes')";
			   mysqli_query($conn, $query);
			}
			else
			{
				$sql = " UPDATE tshirt_size".$_SESSION['sy_id']." SET size".$fee_id." = '$tshirt_sizes' WHERE ts_student_id = '$piece_student_id[$i]' ";
					if($conn->query($sql))
					{
						// $_SESSION['success'] = 'Students added successfully';
						echo "successfully insert to tshirt";
					}
					//else
					{
						//$_SESSION['error'] = $conn->error;
						echo "error".$conn->error;
					}

			}

			$sql = " UPDATE masterlist".$_SESSION['sy_id']." SET pay".$fee_id." = '$tshirt_amount' WHERE ml_student_id = '$piece_student_id[$i]' ";
					if($conn->query($sql))
					{
						// $_SESSION['success'] = 'Students added successfully';
						echo "successfully inert to masterlist";
					}
					//else
					{
						//$_SESSION['error'] = $conn->error;
						echo "error".$conn->error;
					}

			
	//	echo ">".$piece_student_id[$i].":".$piece_tshirt_size[$i]."<";

	}










}

// if(isset($_POST['tshirt_size_id']))
// {
// 	$fee_event_id = trim($_POST['tshirt_size_id']);

// 	              $output = "";
// 	                        $sql1 = "SELECT * FROM fee_event where fe_id = '$fee_event_id' ";
//                             $query1 = $conn->query($sql1);
//                             $row1 = $query1->fetch_assoc(); 
//                             $amount = $row1['amount'];
//                               $countz = 1;
//                               $sql = "SELECT * FROM students1 s left join tshirt_size ts on s.student_id = ts.ts_student_id where s.sem".$_SESSION['sem_id']." = 1  order by ts.size".$fee_event_id." desc,s.firstname asc,s.year asc ";
                           
//                               $query = $conn->query($sql);
                             

//                               while($row = $query->fetch_assoc()){
                               
                                
//                                 $output .= "<tr>
//                                     <td>".$countz++."</td>
//                                    <td><input type='checkbox' name=''></td>
//                                     <td>".$row['student_id']."</td>
//                                     <td>".ucwords(strtolower($row['firstname']))." ".ucwords(strtolower($row['lastname']))."</td>
//                                     <td>". $row['year']." ".ucwords(strtolower($row['section']))." ".ucwords(strtolower($row['major']))."</td>  
//                                     <td>".ucwords(strtolower($row['course'])) ."</td>
//                                     <td>";
//                                      if(!empty($row['size'.$fee_event_id.''])){ echo "reserved"; } else { echo " -- ";}
//                                     $output .= "</td>
//                                     <td>";
//                                      if(!empty($row['size'.$fee_event_id.''])){ echo "".$amount; } else { echo " -- ";}
//                                     $output .= " </td>
//                                       <td class='tdsize".$row['student_id']."'>".$row['size'.$fee_event_id.'']."</td>";
                                    
//                                    $output .= " <td>
//                                        <select title='T-Shirt Sizes' class ='form-control pull-left ' name = 'size' id='size' data-id='".$row['student_id']."'>
//                                         <option></option>";
//                                         $sqlw = "SELECT * FROM category where tshirt_size <> '' ";
//                                           $queryw = $conn->query($sqlw);
//                                           while($roww = $queryw->fetch_assoc()){
                                          
//                                        $output .= " <option value='".$roww['tshirt_size']."'>".$roww['tshirt_size']."'</option>";
                                       
//                                            } 

//                                    $output .= " </select> </td>
//                                   </tr> ";
//                             }

//                             echo $output;

// }







 ?>
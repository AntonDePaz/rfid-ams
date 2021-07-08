<?php 


include '../includes/session.php';


if(isset($_POST['eventid']) && isset($_POST['concat_student_id']))
{

	$event_id = $_POST['eventid'];
	$concat_student_id = $_POST['concat_student_id'];
	$time = date("h:i:sa");
	$taptime = $time;


	$stringval = trim(rtrim($concat_student_id,','));
	$student_id_array = explode(",", trim($stringval));

	print_r($student_id_array);


	  $cost = 0;
	  $totalamount_event = 0;
	  $sql = "SELECT * FROM `fee_event` WHERE fe_id = '$event_id'";
	  $query = $conn->query($sql);
	  while($row = $query->fetch_assoc())
	 {
		$cost =  $row['fines'];
		$totalamount_event = $row['amount'];
	 }



	$lastacivate = 0;
	$lasttime = "";
	$sql3 = "SELECT * FROM `attendance_status` where fee_event_id = '$event_id' order by timeactivate asc ";
	 $query3 = $conn->query($sql3);
	 while($row3 = $query3->fetch_assoc())
	 {
	 	$lastacivate = $row3['as_id'];
	 	$lasttime = $row3['time'];
	 	$lasttime = trim($lasttime);
	 }



	 if(!empty($lasttime))
      {
 			
 			if($concat_student_id == "all")
			{
				echo "all";
				$var = 'sem'.$_SESSION["sem_id"].'';
				$count = 1;
					                   
				$rsql = "SELECT * from students".$_SESSION['sy_id']." s inner join attendance_tap".$_SESSION['sy_id']." at on s.student_id = at.at_student_id and at.at_fee_event_id = '$event_id' and s.sem".$_SESSION["sem_id"]." = 1 and at.".$lasttime." = '' order by s.year,s.firstname";
				 $rquery = $conn->query($rsql);
				while($row = $rquery->fetch_assoc())
				{  
					//$student_id = $row['student_id'];
					//echo " >".$student_id."<";


					$tsql = "UPDATE attendance_tap".$_SESSION['sy_id']." SET ".$lasttime." = '$taptime' WHERE at_student_id = ".$row['student_id']." and at_fee_event_id = '$event_id' ";
				             if($conn->query($tsql))
										{
											echo"successfully attendance_tap";
											//return $con;
										}
										else 
										{
											echo"Cannot update attendance_tap";
										}


						       $totalamount = 0;
						    	$sql = "SELECT * FROM attendance_tap".$_SESSION['sy_id']."  where at_fee_event_id = '$event_id' and at_student_id = ".$row['student_id']."  ";
						          $query = $conn->query($sql);
						    	while($row = $query->fetch_assoc())
							     {
							    	if(!empty($row['timein1']))
							    	{
							    		$totalamount += $cost;
							    	}
							    	if(!empty($row['timeout1']))
							    	{
							    		$totalamount += $cost;
							    	}
							    	if(!empty($row['timein2']))
							    	{
							    		$totalamount += $cost;
							    	}
							    	if(!empty($row['timeout2']))
							    	{
							    		$totalamount += $cost;
							    	}
							    	if(!empty($row['timein3']))
							    	{
							    		$totalamount += $cost;
							    	}
							    	if(!empty($row['timeout3']))
							    	{
							    		$totalamount += $cost;
							    	}
							     }


							    $pay = 'pay'.trim($event_id).'';
							    $pay = trim($pay);

						       
						    	$get_total_amount_value = $totalamount_event - $totalamount;
						    		  // echo "update into masterlist";
						    			//$tsql = "UPDATE `masterlist` SET ".$pay." = '$totalamount' WHERE ml_student_id = '$student_id'";
						        $dsql = "UPDATE masterlist".$_SESSION['sy_id']." SET ".$pay." = '$get_total_amount_value' WHERE ml_student_id =  ".$row['student_id']." ";
						                if($conn->query($dsql))
										{
											echo"successfully masterlist";
											//return $con;
										}
										else 
										{
											echo"Cannot update masterlist";
										}



						}  #end while loop select

			}
			else
			{
				echo " not all";
				for($i = 0;$i < count($student_id_array); $i++)
			    {
				  $student_id = trim($student_id_array[$i]);

				  			// echo " student_id:".$student_id;
		      		//             $found = false;
						    //     $sql = "SELECT * FROM attendance_tap".$_SESSION['sy_id']." where at_fee_event_id = '$event_id' and at_student_id = '$student_id' ";
						    //       $query = $conn->query($sql);
						    // 	while($row = $query->fetch_assoc())
							   //   {
							   //  	//if($row['at_fee_event_id'] ==    && $row['at_student_id'] == $id)
							   //  	{
							   //  		$found = true;
							   //  		//echo " found true ";
							   //  	}
							   //    }


							     // if($found == true)
							   //   {
							      	   $tsql = "UPDATE attendance_tap".$_SESSION['sy_id']." SET ".$lasttime." = '$taptime' WHERE at_student_id = '$student_id' and at_fee_event_id = '$event_id' ";
						               if($conn->query($tsql))
										{
											echo"successfully attendance_tap";
											//return $con;
										}
										else 
										{
											echo"Cannot update attendance_tap";
										}







							    //  }












							      $totalamount = 0;
						    	$sql = "SELECT * FROM attendance_tap".$_SESSION['sy_id']."  where at_fee_event_id = '$event_id' and at_student_id = '$student_id'  ";
						          $query = $conn->query($sql);
						    	while($row = $query->fetch_assoc())
							     {
							    	if(!empty($row['timein1']))
							    	{
							    		$totalamount += $cost;
							    	}
							    	if(!empty($row['timeout1']))
							    	{
							    		$totalamount += $cost;
							    	}
							    	if(!empty($row['timein2']))
							    	{
							    		$totalamount += $cost;
							    	}
							    	if(!empty($row['timeout2']))
							    	{
							    		$totalamount += $cost;
							    	}
							    	if(!empty($row['timein3']))
							    	{
							    		$totalamount += $cost;
							    	}
							    	if(!empty($row['timeout3']))
							    	{
							    		$totalamount += $cost;
							    	}
							     }



							     $found1 = false;
							       $sql = "SELECT * FROM masterlist".$_SESSION['sy_id']." where ml_student_id = '$student_id' ";
						          $query = $conn->query($sql);
						    	while($row = $query->fetch_assoc())
						        {
							    	//if($row[''] == $id)
							    	{
							    		$found1 = true;
							    		//echo " found true ";
							     	}
						        }


						        $pay = 'pay'.trim($event_id).'';
							    $pay = trim($pay);

						        if(!$found1)
						        {	
						        	//echo "insert into masterlist";
						                  $sql = "INSERT INTO masterlist".$_SESSION['sy_id']." (ml_student_id, ".$pay." ) VALUES ('$student_id','$totalamount')";
										//mysqli_query($conn, $sql); 
										   if($conn->query($sql)){
												 echo 'insert successfully to masterlist ';
											}
											else{
												echo "error: ".$conn->error;
											}
						    	}
						    	else
						    	{




						    			$get_total_amount_value = $totalamount_event - $totalamount;
						    		  //  echo "update into masterlist";
						    			//$tsql = "UPDATE `masterlist` SET ".$pay." = '$totalamount' WHERE ml_student_id = '$student_id'";
						    			$tsql = "UPDATE masterlist".$_SESSION['sy_id']." SET ".$pay." = '$get_total_amount_value' WHERE ml_student_id =  '$student_id' ";
						                 if($conn->query($tsql)){
												 echo 'UPDATED successfully to masterlist ';
											}
											else{
												echo "error: ".$conn->error;
											}
						    	}
						    		
						    	
						    	

		        } //end for loop


        }  // end else for all or selected
					 // $value = "";
						// 	// $value .= '<table id="exampleattend" class="table table-bordered table-striped">
					 //  //               <thead>
					 //  //                 <th>#</th>
					 //  //                 <th>RFID</th>
					 //  //                 <th>ID Number</th>
					 //  //                 <th>First Name</th>
					 //  //                 <th>Last Name</th>
					 //  //                 <th>Year</th>
					 //  //                 <th>Section</th>
					 //  //                 <th>Course</th>
					 //  //                 <th>Major</th>
					 //  //                 <th width="10%"><p style="font-size: 10px;">Modify Attendance</p><a style="font-size: 20px; cursor: pointer;" class="pull-right attendance"><b><i class="fa fa-calendar-check-o" style="color: green;"></i></b></a>
					 //  //                 </th>
					 //  //                  </thead>
					 //  //               <tbody>'; 


					 //                    $var = 'sem'.$_SESSION["sem_id"].'';
					 //                    $count = 1;
					                   
					 //                    $sql = "SELECT * from students".$_SESSION['sy_id']." s inner join attendance_tap".$_SESSION['sy_id']." at on s.student_id = at.at_student_id and at.at_fee_event_id = '$event_id' and s.sem".$_SESSION["sem_id"]." = 1 and at.".$lasttime." = '' order by s.year,s.firstname";
					 //                     $query = $conn->query($sql);
					 //                    while($row = $query->fetch_assoc())
					 //                    {   

					 //                    $value .= '<tr>
					 //                          <td>'. $count++.'</td>	
					 //                          <td>'.$row['student_id'].'</td>
					 //                          <td>'.$row['id_number'].'</td>
					 //                          <td>'.ucwords($row['firstname']).'</td>
					 //                          <td>'.ucwords($row['lastname']).'</td>
					 //                          <td>'.ucwords($row['year']).'</td>
					 //                          <td>'.ucwords($row['section']).'</td>
					 //                          <td>'.ucwords($row['course']).'</td>
					 //                          <td>'.ucwords($row['major']).'</td>
					 //                          <td><input  type="checkbox" id="chk_getid" data-id="'.$row['student_id'].'"></td>
					 //                        </tr>';


					 //                    }
					 //                   // $value .= '</tbody> </table>';

					                    
					 //         //  echo $value;
							        
					 //    //         $sql = "SELECT * FROM students".$_SESSION['sy_id']." WHERE student_id = '$rfid'";
						// 	  //    $query = $conn->query($sql);
					 //    //          $row = $query->fetch_assoc(); 
						// 		 // $firstname = $row['firstname'];
								
						// 		 // $lastname = $row['lastname'];
						// 		 // $year = $row['year'];
						// 		 // $section = $row['section'];
						// 		 // $course = $row['course'];
						// 		 // $major = $row['major'];
								
									
					 //      echo json_encode(['status'=>'success','html'=>$value]); 
							
						// 	//echo json_encode(['status'=>'success','html'=>$value,'firstname'=>$firstname,'lastname'=>$lastname,'year'=>$year,'section'=>$section,'course'=>$course,'major'=>$major]);


				  








      }
      else
      {
      	  echo " This event time is not activate";
      }










	









}
















 ?>
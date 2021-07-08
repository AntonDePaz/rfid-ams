<?php
require_once('connection.php');
        // if(session_status() == PHP_SESSION_NONE){session_start();}//start session if session not start
		include 'event.php';		
		
class student extends Database{

	public function insert_student($data = []){
		//if(isset($_POST['data'])){
			//$data = json_decode($_POST['data'], true);
            if(isset($_SESSION['sy_id']) && isset($_SESSION['sem_id'])){
				if(!empty($data)){
				
					
					$date = date("Y-m-d");
			$rfid = $data[0];
			$idnumber = $data[1];
			$fn = $data[2];
			$mn = $data[3];
			$ln = $data[4];
			$section = $data[5];
			$year = $data[6];
			$course =  $data[7];
            $major =  $data[8];
            $sem = $_SESSION['sem_id'];
			
           // $semester = 'sem'.trim($sem);
     		//$semester = trim($semester);

			 //print_r($data);
             //echo " rfid:".$rfid;
             //echo " idnum:".$idnumber;
			 $found = 0;
			$sql = "SELECT * FROM students".$_SESSION['sy_id']." ";
				$query = $this->conn->query($sql);
				while($row = $query->fetch_assoc()){
				if(trim($row['id_number']) == trim($idnumber)){
					//echo 3;
					$found = 3;
					break;
				}
				 if(trim($row['rfid']) == trim($rfid)){
					$found = 4;
					break;
				}
				
			    }
				if($found == 0){
					$student_id = 0;
					$fee_id = 0;
					//echo 'session'.$_SESSION['sy_id'];
					if($sem == 1){
					$query = "INSERT INTO students".$_SESSION['sy_id']." ( rfid,id_number,firstname,middlename,lastname,year,section,course,major,sem1,sem2) 
					VALUES (?,?,?,?,?,?,?,?,?,'1','1')";
				    }if($sem == 2){
						$query = "INSERT INTO students".$_SESSION['sy_id']." ( rfid,id_number,firstname,middlename,lastname,year,section,course,major,sem2) 
						VALUES (?,?,?,?,?,?,?,?,?,'1')";
					}

				    	$stmt = mysqli_stmt_init($this->conn);
						if(mysqli_stmt_prepare($stmt,$query))
						{
						mysqli_stmt_bind_param($stmt, 'sssssssss', $rfid,$idnumber,$fn,$mn,$ln,$year,$section,$course,$major);
						mysqli_stmt_execute($stmt);
						//}
						
					
				//	$result = $this->conn->query($query);
				//	if($result){
					// 	return 1;	
				//	echo 104;

						$sql = "SELECT max(student_id) as get FROM students".$_SESSION['sy_id']." ";
						$result = $this->conn->query($sql);
						while($row1 = $result->fetch_assoc()){
							$student_id = $row1['get'];
						}
						$query = "INSERT INTO masterlist".$_SESSION['sy_id']."  (`ml_student_id`) VALUES (?)";
						//mysqli_query($this->conn, $query);

						$stmt = mysqli_stmt_init($this->conn);
						if(mysqli_stmt_prepare($stmt,$query))
						{
						mysqli_stmt_bind_param($stmt, 'i', $student_id);
						mysqli_stmt_execute($stmt);
						}
					
						//   date_default_timezone_set('Asia/Manila');
						$event = new event();
						$data_event = $event->show_all_event();
						if(!empty($data_event)){
						foreach($data_event as $row)
						{
						 if($row['date'] >= $date){
							$fee_id = $row['fe_id'];
							$query = "INSERT INTO attendance_tap".$_SESSION['sy_id']."  (`at_fee_event_id`, `at_student_id`,`at_status`) VALUES (?,?,'0')";
						 //   mysqli_query($this->conn, $query);
							   $stmt = mysqli_stmt_init($this->conn);
								if(mysqli_stmt_prepare($stmt,$query))
								{
								mysqli_stmt_bind_param($stmt, 'ii', $fee_id,$student_id);
								mysqli_stmt_execute($stmt);
								}
						    }
						  }
				     	}

						return true;
				 	}
			   }
			   else{
				   return $found;
			   }
			   
			} else { return 'empty data';}
		  }
		}


		public function showall_student22(){
			if(isset($_SESSION['sy_id']) && isset($_SESSION['sem_id'])){
				$value = "";
				$countz = 0;
                $sql = "SELECT * FROM students".$_SESSION['sy_id']." where sem".$_SESSION['sem_id']." = 1 order by year,firstname";
                $result = $this->conn->query($sql);
                if($result){
					if($result->num_rows > 0){
						while($row = $result->fetch_assoc()){
							$data[] = $row;
						}
						return $data;
				   }
				}
			}


		}
        public function showall_student(){
            if(isset($_SESSION['sy_id']) && isset($_SESSION['sem_id'])){
				$output = array();
				$data = array();
                $sql = "SELECT * FROM students".$_SESSION['sy_id']." where sem".$_SESSION['sem_id']." = 1 order by year,firstname";
                $result = $this->conn->query($sql);
                if($result){
					if($result->num_rows > 0){
						$count = 1;
                    while($row = $result->fetch_assoc()){
                       // $data[] = $row;
						$subarray = array();
						$subarray[] = number_format($count++);
						$subarray[] = $row['id_number'];
						$subarray[] = ucwords(strtolower($row['firstname']));
						$subarray[] = ucwords(strtolower($row['middlename']));
						$subarray[] = ucwords(strtolower($row['lastname']));
						$subarray[] = $row['year'];
						$subarray[] = strtoupper($row['section']);
						$subarray[] = ucwords(strtolower($row['course']));
						$subarray[] = ucwords(strtolower($row['major']));
						$subarray[] = "<a class='btn btn-default btn-xs edit' title='edit' data-id=".$row['student_id']."><i class='fa fa-edit'> edit</i></a> &nbsp;&nbsp; <a class='btn btn-default btn-xs del' title='delete' data-id=".$row['student_id']."> <i class='fa fa-trash-o'> delete</i></a>";  
					     $data[] = $subarray;
				
                    }
					$output = array("data" => $data);
					  return $output;
                 
			     	}
                }
          }
        }

		public function getstudent($id){
			if(isset($_SESSION['sy_id'])){
			$sql = "SELECT * FROM students".$_SESSION['sy_id']." WHERE student_id = ? ";
			//$result = $this->conn->query($sql);
			$stmt = mysqli_stmt_init($this->conn);
			if(mysqli_stmt_prepare($stmt,$sql))
			{
			mysqli_stmt_bind_param($stmt, 'i', $id);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
				while($row = mysqli_fetch_assoc($result)){
					$data = $row;
				}
				return $data;
			  }
			}
			else{
				return 0;
			}
		//   }
		//   else{
		// 	  return 0;
		//   }
		}



		public function add_student_id_ml_at(){

						$sql = "SELECT student_id FROM students".$_SESSION['sy_id']." WHERE sem".$_SESSION['sem_id']." = 1  ";
						$result =  $this->conn->query($sql);
                         while($row = $result->fetch_assoc()){
						    $found = false;
							$sqlml = "SELECT ml_student_id FROM masterlist".$_SESSION['sy_id']." ";
							$resultml =  $this->conn->query($sqlml);
							while($rowml = $resultml->fetch_assoc()){
							  if($rowml['ml_student_id'] == $row['student_id']){
								  $found = true;
							    }
							}
							if(!$found){
								$student_id = $row['student_id'];
							//	echo " ml_stuid:".$row['student_id'];
								
						     $query = "INSERT INTO masterlist".$_SESSION['sy_id']."  (`ml_student_id`) VALUES ('$student_id')";
                             mysqli_query( $this->conn, $query);
							
							}

                         }




						//include 'event.php';
						// $event = new event();
						 $date = date("Y-m-d");
						 $fee_id = 0;
						 $sql = "SELECT * FROM fee_event where type = 1 and sem_id = ".$_SESSION['sem_id']." and sy_id = ".$_SESSION['sy_id']."  order by date";
						$result = $this->conn->query($sql);
						if($result->num_rows > 0){
							while($gett = $result->fetch_assoc()){
								if($gett['date'] >= $date){
									$fee_id = $gett['fe_id'];
									//echo "-fe-".$fee_id;


											$sqlst = "SELECT student_id FROM students".$_SESSION['sy_id']." WHERE sem".$_SESSION['sem_id']." = 1  ";
											$resultst =  $this->conn->query($sqlst);
											while($rowst = $resultst->fetch_assoc()){
												$found = false;
												$sqlat = "SELECT at_student_id FROM attendance_tap".$_SESSION['sy_id']." WHERE at_fee_event_id = '$fee_id' ";
												$resultat =  $this->conn->query($sqlat);
												while($rowat = $resultat->fetch_assoc()){
												if($rowat['at_student_id'] == $rowst['student_id']){
													$found = true;
													}
												}
												if(!$found){
													$student_id = $rowst['student_id'];
											//	echo " feeid:".$fee_id." sid:".$student_id;
												 $query = "INSERT INTO attendance_tap".$_SESSION['sy_id']."  (`at_fee_event_id`, `at_student_id`,`at_status`) VALUES (?,?,'0')";
                                                 // mysqli_query( $this->conn, $query);
												    $stmt = mysqli_stmt_init($this->conn);
													if(mysqli_stmt_prepare($stmt,$query))
													{
													mysqli_stmt_bind_param($stmt, 'ii', $fee_id,$student_id);
													mysqli_stmt_execute($stmt);
													}
												}
											}




								//	$query = "INSERT INTO attendance_tap".$_SESSION['sy_id']."  (`at_fee_event_id`, `at_student_id`,`at_status`) VALUES ('$fee_id','$student_id','0')";
								//	mysqli_query( $this->conn, $query);
								}

							}

						}
                        

					//	echo "-feee-".$fee_id;
						


						//  $data1 = $event->showall_event();
                        //  if(!empty($data1)){
                        //      foreach($data1 as $gett)
                        //      {   
                        //          echo "d1:".$gett['date']." == d3:".$date;
                        //          if($gett['date'] >= $date){
                        //             // echo 'success';
                        //              $fee_id = $gett['fe_id'];
						// 			 echo $fee_id;
                        //            //  $query = "INSERT INTO attendance_tap".$_SESSION['sy_id']."  (`at_fee_event_id`, `at_student_id`,`at_status`) VALUES ('$fee_id','$student_id','0')";
                        //            //  mysqli_query( $this->conn, $query);
                        //          }
                        //      }
                        //  }



						// 		$ar1 = new array();
						// 		$ar2 = new array();
						// 		$sql = "SELECT student_id FROM students".$_SESSION['sy_id']." WHERE sem".$_SESSION['sem_id']." = 1 AND student_id <> ".$row1['ml_student_id']."  ";
						// 		$result =  $this->conn->query($sql);
						// 		while($row = $result->fetch_assoc()){
						// 		}
						// 		$sql = "SELECT ml_student_id FROM masterlist".$_SESSION['sy_id']." ";
						// 		$result =  $this->conn->query($sql);
						// 		while($row = $result->fetch_assoc()){
						// 		}

						//  $sql = "SELECT ml_student_id FROM masterlist".$_SESSION['sy_id']." ";
                        //  $result =  $this->conn->query($sql);
                        //  while($row1 = $result->fetch_assoc()){
                            
                        //  }
                        //  $query = "INSERT INTO masterlist".$_SESSION['sy_id']."  (`ml_student_id`) VALUES ('$student_id')";
                        //  mysqli_query( $this->conn, $query);
                        
                        //  $data = $event->showall_event();
                        //  if(!empty($data)){
                        //      foreach($data as $gett)
                        //      {   
                        //          echo "d1:".$gett['date']." == d3:".$date;
                        //          if($gett['date'] >= $date){
                        //              echo 'success';
                        //              $fee_id = $gett['fe_id'];
                        //              $query = "INSERT INTO attendance_tap".$_SESSION['sy_id']."  (`at_fee_event_id`, `at_student_id`,`at_status`) VALUES ('$fee_id','$student_id','0')";
                        //              mysqli_query( $this->conn, $query);
                        //          }
                        //      }
                        //  }




		}






		public function edit_student($data = []){
		if(isset($_SESSION['sy_id'])){
			if(!empty($data)){
			//$data = json_decode($_POST['data'], true);
			$id = $data[0];
			$rfid = $data[1];
			$idnumber = $data[2];
			$fn = $data[3];
			$mn = $data[4];
			$ln = $data[5];
			$section = $data[6];
			$year = $data[7];
			$course = $data[8];
			$major = $data[9];
			$drfid = $data[10];
			$didnumber = $data[11];
			$sem = $_SESSION['sem_id'];
            $semester = 'sem'.trim($sem);
     		$semester = trim($semester);
			// $sql = "SELECT * FROM user WHERE lower(user) = lower('$user') and lower(user) <> lower('$euser') ";
			// 	$query = $this->conn->query($sql);
			// 	if($query->num_rows == 1){
			// 		return '3';
			// 	}
			// 	else{
				$found = 0;
				$sql = "SELECT * FROM students".$_SESSION['sy_id']." ";
					$query = $this->conn->query($sql);
					if($query->num_rows > 0){
					while($row = $query->fetch_assoc()){
				  if(trim($row['rfid']) == trim($rfid) && trim($row['rfid']) != trim($drfid)){
							$found = 4;
							break;
						}
					if(trim($row['id_number']) == trim($idnumber) &&  trim($row['id_number']) != trim($didnumber)){
						//echo 3;
						$found = 3;
						break;
					}
					
					}
					if($found == 0){
						//return 1;
						$query = "UPDATE students".$_SESSION['sy_id']." SET `rfid`=?, `id_number`=?,`firstname`= ?,`middlename`= ?,`lastname`= ?,`year`=?,`section`=?,`course`=?,`major`=?, ".$semester." = '1' WHERE student_id = ? ";
						//$result = $this->conn->query($query);
						$stmt = mysqli_stmt_init($this->conn);
						if(mysqli_stmt_prepare($stmt,$query))
						{
						mysqli_stmt_bind_param($stmt, 'sssssssssi', $rfid,$idnumber,$fn,$mn,$ln,$year,$section,$course,$major,$id);
						mysqli_stmt_execute($stmt);
						return 1;
						}
						// if($result){
						// 	return 1;
						// }
				   }
				   else{
					   return $found;
				   }
				}
			}
			
		 }
		}


		public function del_student($id){
			if(isset($_SESSION['sy_id']) && isset($_SESSION['sem_id'])){
				$query = "UPDATE students".$_SESSION['sy_id']." SET sem".$_SESSION['sem_id']." = ''  WHERE student_id = ?  ";
				//$result = $this->conn->query($query);
				$stmt = mysqli_stmt_init($this->conn);
				if(mysqli_stmt_prepare($stmt,$query))
				{
				mysqli_stmt_bind_param($stmt, 'i',$id);
				mysqli_stmt_execute($stmt);
				//if($result){
					return '1';
				}
				else{
					return '2';
				}
			}
		}




		public function import_csv_student($data = []){

			//echo $data[0];

			print_r($data);
		// 	foreach($data as $row){
		// 		//echo $row;
		// 		$rfid = $row[0];
		// 	   $idnumber = $row[1];
		// 		$firstname = $row[2];
		// 	    $middlename = $row[3];
		// 		$lastname = $row[4];
		// 		$year = $row[5];
		// 		$section = $row[6];
		// 		$course = $row[7];
		// 		$major = $row[8];
		// 		echo '1:'.$row[0];
		// 		echo '2:'.$row[1];
		// 	//$query = "INSERT INTO students".$_SESSION['sy_id']." (rfid,id_number,firstname,middlename,lastname,year,section,course,major,sem".$_SESSION['sem_id']." ) VALUES 
        //    // ('$rfid','$idnumber','$firstname','$middlename','$lastname','$year','$section','$course','$major', '1') ";
        //      //$result = $this->conn->query($query);
		// 	// mysqli_query($this->conn,$query);
        //     //  if($result){
        //     //     echo '1';
        //     // }
        //     // else{
        //     //     echo '2';
        //     // }
		// 	}
		// 	//if(isset($_POST['data'])){
		// 		//$data = json_decode($_POST['data'], true);
				
		// 		// if(isset($_SESSION['sy_id']) && isset($_SESSION['sem_id'])){
		// 		// $rfid = $data[0];
		// 		// $idnumber = $data[1];
		// 		// $fn = $data[2];
		// 		// $mn = $data[3];
		// 		// $ln = $data[4];
		// 		// $section = $data[5];
		// 		// $year = $data[6];
		// 		// $course =  $data[7];
		// 		// $major =  $data[8];
		// 		// $sem = $_SESSION['sem_id'];
		// 		// $semester = 'sem'.trim($sem);
		// 		//  $semester = trim($semester);
		// 		// // echo " mn:".$mn;
		// 		// // echo " ln:".$ln;
		// 		// 	$query = "INSERT INTO students".$_SESSION['sy_id']." ( rfid,id_number,firstname,middlename,lastname,year,section,course,major, ".$semester.") VALUES ('$rfid','$idnumber','$fn','$mn','$ln','$year','$section','$course','$major','1')";
		// 		// 	$result = $this->conn->query($query);
		// 		// 	if($result){
		// 		// 		return '1';
		// 		// 	}
		// 		// 	else{
		// 		// 		return '2';
		// 		// 	}
		// 		// }
		 	}
	



















	//}

		public function showallst(){
			$sql = "SELECT * FROM students1 WHERE year IN (1,2) ";
			$result = $this->conn->query($sql);
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					$data[] = $row;
				}
				return $data;
			}
		}

		public function print_student($year, $course){

	//	echo $year;

			$year = rtrim($year,',');
			$course = strtolower(rtrim($course,','));
				// echo ' c:'.$course;
				// echo ' y:'.$year;
			if(isset($_SESSION['sy_id'])){

				
				if($course == 'all' && $year == 'all'){
					//echo 'all all';
					$sql = "SELECT * FROM students".$_SESSION['sy_id']." ";
				}
				else if($course == 'all'){
					//echo 'all course selected year';
					$sql = "SELECT * FROM students".$_SESSION['sy_id']." WHERE year IN (".$year.") ";
				}
				else if($year == 'all'){
					//echo 'all year selected course';
					$sql = "SELECT * FROM students".$_SESSION['sy_id']." WHERE course IN (".$course.") ";
				}
				else{
					//echo 'selected course selected year';
					$sql = "SELECT * FROM students".$_SESSION['sy_id']." WHERE year IN (".$year.") AND course IN (".$course.")   ";
				}
			
			     	$result = $this->conn->query($sql);
					 if($result){
						if($result->num_rows > 0){

							while($row = $result->fetch_assoc()){
								$data[] = $row;
							}
							return $data;
					// 		$value = "";
					// 		$value .= '<table id="myTable-report" class="table table-bordered table-hover" cellspacing="0" width="100%">
					// 		<thead>
					// 			<th>ID Number</th>
					// 			<th>Firstname</th>
					// 			<th>Middle</th>
					// 			<th>Lastname</th>
					// 			<th>Year</th>
					// 			<th>Section</th>
					// 			<th>Course</th>
					// 			<th>Major</th>
					// 		</thead> <tbody>';
					// 	while($row = $result->fetch_assoc()){

					// $value .= "
                    //     <tr>
                    //       <td>".$row['id_number']."</td>
                    //       <td>".ucwords(strtolower($row['firstname']))."</td>
                    //       <td>".ucwords(strtolower($row['middlename']))."</td>
                    //       <td>".ucwords(strtolower($row['lastname']))."</td>
                    //       <td>".$row['year']."</td>  
                    //       <td>".ucwords(strtolower($row['section']))."</td>
                    //       <td>".ucwords(strtolower($row['course']))."</td>
                    //       <td>".ucwords(strtolower($row['major']))."</td>
                    //     </tr>
                    //   ";

						//}
					//	$value .= '</tbody> </table>';
						////header("Content-Type: application/xls");
						//header("Content-Disposition: attachment; filename=download.xls");
						//echo $value;
						//return $data;
					
					}

				} else { return 11;}

			} else { return 0; }
					
					
					


			  
			  

			

		}

		






		public function print_masterlist_error(){

			$countz = 1;
                     $grosstotal = 0;
                

                      $amountfee = array();
                      $idfee = 0;
                      $rowindex = 0;

                        $countcolumn = 4;
                       $eventida = array();
                       $feeida = array();
                       $eventamount = array();
                       $feeamount = array();
                       $eida = 0;$fida = 0;

                       $eventall_id = array();
                       $eventall_amount = array();
                       $event_index = 0;
                       $sql = "SELECT * FROM fee_event where sem_id = ".$_SESSION['sem_id']." and sy_id = ".$_SESSION['sy_id']." order by fe_id ";
                   $query = $this->conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      $eventall_id[$event_index] = $row['fe_id'];
                      $eventall_amount[$event_index] = number_format($row['amount'],2);
                      $event_index++;
                      $countcolumn++;
                      //  }
                    }




                   $sql = "SELECT * FROM fee_event where type = 1 and sem_id = ".$_SESSION['sem_id']." and sy_id = ".$_SESSION['sy_id']." order by fe_id ";
                   $query = $this->conn->query($sql);
                   while($row = $query->fetch_assoc()){
                      $eventida[$eida] = $row['fe_id'];
                      $eventamount[$eida] = $row['fines'] * $row['tap'];
                      $eida++;
                      //  }
                    }
                    $sql = "SELECT * FROM fee_event where type = 2 and sem_id = ".$_SESSION['sem_id']." and sy_id = ".$_SESSION['sy_id']." order by fe_id";
                   $query = $this->conn->query($sql);
                   while($row = $query->fetch_assoc()){
                      $feeida[$fida] = $row['fe_id'];
                      $feeamount[$fida] = $row['amount'];
                      $fida++;
                  // }
                  }
				  $data = array(); $data2 = array();
                    $total = 0;
                   $var = 'sem'.$_SESSION["sem_id"];
                   $sql = "SELECT *  FROM students".$_SESSION['sy_id']." s inner join masterlist".$_SESSION['sy_id']." ml on ml.ml_student_id = s.student_id where s.".$var." = 1  order by s.year , firstname ";
                   $query = $this->conn->query($sql);
                   if($query){
                   while($row = $query->fetch_assoc()){

						$data[] = $countz++;
						$data[] = $row['id_number'];
						$data[] = $row['firstname']." ".$row['lastname'];
						$data[] = $row['year'].'-'.$row['major'];
                          for($i = 0; $i < count($eventall_id); $i++)
                          {
                            if($row['pay'.trim($eventall_id[$i]).''] > 0)
                            {
								$data2[] = number_format($row['pay'.trim($eventall_id[$i]).''],2);
                            // echo "<td> &#8369 ".number_format($row['pay'.trim($eventall_id[$i]).''],2)."</td>";
                              $total += $row['pay'.trim($eventall_id[$i]).''];
                          
                             }
                             else
                             {	
								 $data2[] = 'P --';
                                //  echo "<td> &#8369 &nbsp -- </td>";
                             }


                          }
						  $data[] = $data2;


                         //  $grosstotal += $total;
                 
             }
            
                    // $is++;
               
       

	   	return $data;

		}



	} #end function
	

} # end main class

//$model = new Model();

$student = new student();







 ?>

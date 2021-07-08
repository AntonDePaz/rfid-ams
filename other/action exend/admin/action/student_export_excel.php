<?php
//include '../includes/conn.php'; 
include '../model/connection.php'; 
$db = new Database();

            $year = $_SESSION['pyear'];
            $course = $_SESSION['pcourse'];
           $year = rtrim($year,',');
			$course = strtolower(rtrim($course,','));
				// echo ' c:'.$course;
				// echo ' y:'.$year;
			if(isset($_SESSION['sy_id'])){

				
				if($course == 'all' && $year == 'all'){
					//echo 'all all';
					$sql = "SELECT * FROM students".$_SESSION['sy_id']." order by year,firstname ";
				}
				else if($course == 'all'){
					//echo 'all course selected year';
					$sql = "SELECT * FROM students".$_SESSION['sy_id']." WHERE year IN (".$year.") order by year,firstname ";
				}
				else if($year == 'all'){
					//echo 'all year selected course';
					$sql = "SELECT * FROM students".$_SESSION['sy_id']." WHERE course IN (".$course.") order by year,firstname ";
				}
				else{
					//echo 'selected course selected year';
					$sql = "SELECT * FROM students".$_SESSION['sy_id']." WHERE year IN (".$year.") AND course IN (".$course.")  order by year,firstname  ";
				}
			
			     	$result = $db->conn->query($sql);
					 if($result){
						if($result->num_rows > 0){
							$value = "";
							$value .= '<table class="table table-bordered" bordered="1">
							<thead>
								<th>ID Number</th>
								<th>Firstname</th>
								<th>Middle</th>
								<th>Lastname</th>
								<th>Year</th>
								<th>Section</th>
								<th>Course</th>
								<th>Major</th>
							</thead> <tbody>';
						while($row = $result->fetch_assoc()){

					$value .= "
                        <tr>
                          <td>".$row['id_number']."</td>
                          <td>".ucwords(strtolower($row['firstname']))."</td>
                          <td>".ucwords(strtolower($row['middlename']))."</td>
                          <td>".ucwords(strtolower($row['lastname']))."</td>
                          <td>".$row['year']."</td>  
                          <td>".ucwords(strtolower($row['section']))."</td>
                          <td>".ucwords(strtolower($row['course']))."</td>
                          <td>".ucwords(strtolower($row['major']))."</td>
                        </tr>
                      ";

						}
						$value .= '</tbody> </table>';


						// header("Content-Type: application/csv");
						// header("Content-Disposition: attachment; filename=download.csv");
						// echo $value;
						//return $data;

                        header("Content-type: application/vnd.ms-excel; name='excel'");
                        header("Content-Disposition: attachment; filename=SSC_Students.xls");
                        header("Pragma: no-cache");
                        header("Expires: 0");
                        echo $value;
					}

				} else { return 11;}

			} else { return 0; }











?>


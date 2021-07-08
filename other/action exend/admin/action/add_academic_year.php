<?php 


include '../includes/session.php';


if(isset($_POST['academic_year']))
{
	$academic_year = $_POST['academic_year'];

	// echo " ay:".$academic_year;
	    $sql = "INSERT INTO sy_status ( sy_range, sy_status ) VALUES ('$academic_year','0')";
		if($conn->query($sql))
		{


			//echo 'academic_year added successfully';
			$getlast_id = 0;
			$sql = "SELECT * FROM sy_status order by sy_id asc";
	        $query = $conn->query($sql);
	        while($row = $query->fetch_assoc()){
	          $getlast_id = trim($row['sy_id']);
	        }

			//  create table students , masterlist , attendance tap 

			$sql = "
				CREATE TABLE IF NOT EXISTS students".$getlast_id."(
					student_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
					id_number VARCHAR(25),
					firstname VARCHAR(255),
					lastname VARCHAR(255),
					year VARCHAR(20),
					section VARCHAR(100),
					course VARCHAR(255),
					major VARCHAR(255),
					sem1 INT(5),
					sem2 INT(5),
					rfid VARCHAR(100)
				);
			";
				if($conn->query($sql))
				{
					//echo"table created";
					//return $con;
				}
				//else 
				//{
				//	echo"Cannot created Table";
				//}




				$sql = "
				CREATE TABLE IF NOT EXISTS masterlist".$getlast_id."(
					ml_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
					ml_student_id INT(20)
				);
			";
				if($conn->query($sql))
				{
					//echo"table created";
					//return $con;
				}
				//else 
				//{
					//echo"Cannot created Table";
				//}


				$sql = "
				CREATE TABLE IF NOT EXISTS masterlist".$getlast_id."(
					ml_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
					ml_student_id INT(20)
				);
			    ";
				if($conn->query($sql))
				{
					//echo"table created";
					//return $con;
				}
				//else 
				//{
					//echo"Cannot created Table";
				//}




				$sql = "
				CREATE TABLE IF NOT EXISTS attendance_tap".$getlast_id."(
					at_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
					at_fee_event_id INT(25),
					at_student_id INT(25),
					timein1 VARCHAR(100),
					timeout1 VARCHAR(100),
					timein2 VARCHAR(100),
					timeout2 VARCHAR(100),
					timein3 VARCHAR(100),
					timeout3 VARCHAR(100),
					at_status INT(10)
					
				);
			";
				if($conn->query($sql))
				{
					//echo"table created";
					//return $con;
				}
				//else 
				//{
					//echo"Cannot created Table";
				//}

				$sql = "
				CREATE TABLE IF NOT EXISTS tshirt_size".$getlast_id."(
					ts_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
					ts_student_id INT(11)
					
				);
			";
				if($conn->query($sql))
				{
					//echo"table created";
					//return $con;
				}
				//else 
				//{
					//echo"Cannot created Table";
				//}

				$sql = "
				CREATE TABLE IF NOT EXISTS log_history".$getlast_id."(
					log_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
					log_admin_name VARCHAR(255),
					log_action VARCHAR(255),
					log_action_name VARCHAR(255),
					log_description VARCHAR(255),
					log_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
					sem_status VARCHAR(10)
					
					
				);
			";
				if($conn->query($sql))
				{
					//echo"table created";
					//return $con;
				}
				//else 
				//{
					//echo"Cannot created Table";
				//}










		}
		//else
		//{
			//echo 'erorr'.$conn->error;
		//}






		//loadtable();
		loadmaindb();

}
else{

header('location: ../logout.php');

}

function loadmaindb(){
global $conn;
		$value = "";

                                $count_student = 0;
                                // $sql = "SELECT * FROM students".$_SESSION['sy_id']."";
                                // $query = $conn->query($sql);
                                // $count_student = $query->num_rows;
                                  $sql = "SELECT * FROM sy_status order by sy_status desc";
                                 $query = $conn->query($sql);
                                 while($row = $query->fetch_assoc()){
                                
                                $value .= '<tr>
                                    <td><b style="font-weight: 700;">'.$row['sy_range'].'</b></td>';

                                   $value .= '<td style="font-weight: 700;" > <a style="color: red; cursor: pointer; " class="cdata_students" ><i class="fa fa-trash-o"></i></a> &nbsp; ';

                                      $sql1 = "SELECT * FROM students".trim($row['sy_id'])."";
                                      $query1 = $conn->query($sql1);
                                      $count_student = $query1->num_rows;
                                         
                                     $value .=''.$count_student.' </td>';
                                    $value .= '<td style="font-weight: 700;"> <a style="color: red; cursor: pointer; " class="cdata_students" ><i class="fa fa-trash-o"></i></a> &nbsp; ';
                                      $sql1 = "SELECT * FROM fee_event where type = 1 and sy_id = ".$row['sy_id']."  ";
                                      $query1 = $conn->query($sql1);
                                      $count_student = $query1->num_rows;
                                        $value .=''.$count_student.' </td>';
                                    $value .= '<td style="font-weight: 700;"> <a style="color: red; cursor: pointer; " class="cdata_students" ><i class="fa fa-trash-o"></i></a> &nbsp; ';
                                      $sql1 = "SELECT * FROM fee_event where type = 2 and sy_id = ".$row['sy_id']."  ";
                                      $query1 = $conn->query($sql1);
                                      $count_student = $query1->num_rows;
                                        $value .=''.$count_student.' </td>';
                                   $value .= ' <td><a style="color: red; cursor: pointer; " class="sy_range" data-id="'.$row['sy_range'].'"><i style="font-size: 15px; font-weight: 600;" class="fa fa-trash-o"></i> Clear All Data</a></td>
                                  </tr>';
                              }
                             echo $value;
                                
}





// function loadtable(){
// global $conn;
// $deleterow = 0;

//  $sql = "SELECT * FROM category" ;
//         $query = $conn->query($sql);
//         while($row = $query->fetch_assoc()){

//           if(empty($row['c_course']) && empty($row['c_major']) && empty($row['c_year']) && empty($row['c_section']) && empty($row['tshirt_size']) )
//           {
//           $deleterow = $row['cat_id'];

//           }
//         }

// $value = "";

//                $value .= '<div class="col-sm-2">
//                           <table class="table">
//                             <th>Academic_Year</th>
//                             <th></th>';
                             
//                                 $sql = "SELECT * FROM sy_status where sy_range <> '' order by sy_range  " ;
//                                 $query = $conn->query($sql);
//                                 while($row = $query->fetch_assoc()){

                                
//                            $value .='<tr>';
//                             $value .=  '<td>'.strtoupper($row['sy_range']).'</td>
//                             </tr>';
//                             }
//                          $value .= '</table>
//                         </div>';
//                        $value .= ' <div class="col-sm-3">
//                           <table class="table">
//                             <th></th>
//                             <th>Course</th>';
                            
//                                 $sql = "SELECT cat_id ,c_course FROM category where c_course <> '' order by c_course  " ;
//                                 $query = $conn->query($sql);
//                                 while($row = $query->fetch_assoc()){

                                
//                            $value .= '<tr>
//                               <td><a title="delete" class="fa fa-trash-o del"  id="'.$row['cat_id'].'" data-id="c_course"></a></td>
//                               <td>'.strtoupper($row['c_course']).'</td>
//                             </tr>';
//                               } 
//                          $value .= '</table>
//                         </div>
//                         <div class="col-sm-3">
//                           <table class="table">
//                             <th></th>
//                             <th>Major</th>';
                            
//                                 $sql = "SELECT cat_id ,c_major FROM category where c_major <> '' order by c_major  " ;
//                                 $query = $conn->query($sql);
//                                 while($row = $query->fetch_assoc()){

                                
//                              $value .= '<tr>
//                               <td><a title="delete" class="fa fa-trash-o del"  id="'.$row['cat_id'].'" data-id="c_major"></a></td>
//                               <td>'.strtoupper($row['c_major']).'</td>
//                             </tr>';
//                                 }
//                          $value .= '</table>
//                         </div>
//                         <div class="col-sm-1">
//                           <table class="table">
//                             <th></th>
//                             <th>Year</th>';
                             
//                                 $sql = "SELECT cat_id ,c_year FROM category where c_year <> '' order by c_year  " ;
//                                 $query = $conn->query($sql);
//                                 while($row = $query->fetch_assoc()){

                                
//                           $value .='<tr>
//                               <td><a title="delete" class="fa fa-trash-o del"  id="'.$row['cat_id'].'" data-id="c_year"></a></td>
//                               <td>'.strtoupper($row['c_year']).'</td>
//                             </tr>';
//                               } 
//                          $value .='</table>
//                         </div>
//                         <div class="col-sm-1">
//                             <table class="table">
//                             <th></th>
//                             <th>Section</th>';
                             
//                                 $sql = "SELECT cat_id ,c_section FROM category where c_section <> '' order by c_section  " ;
//                                 $query = $conn->query($sql);
//                                 while($row = $query->fetch_assoc()){

                                 
//                            $value .=' <tr>
//                               <td><a title="delete" class="fa fa-trash-o del"  id="'.$row['cat_id'].'" data-id="c_section"></a></td>
//                               <td>'.strtoupper($row['c_section']).'</td>
//                             </tr>';
//                            } 
//                          $value .=' </table>
//                         </div>';

//                          $value .='</table>
//                         </div>
//                         <div class="col-sm-1">
//                             <table class="table">
//                             <th></th>
//                             <th>Tshirt_Size</th>';
                             
//                                 $sql = "SELECT cat_id ,tshirt_size FROM category where tshirt_size <> '' order by tshirt_size  " ;
//                                 $query = $conn->query($sql);
//                                 while($row = $query->fetch_assoc()){

                                 
//                            $value .=' <tr>
//                               <td><a title="delete" class="fa fa-trash-o del"  id="'.$row['cat_id'].'" data-id="tshirt_size"></a></td>
//                               <td>'.strtoupper($row['tshirt_size']).'</td>
//                             </tr>';
//                            } 
//                          $value .=' </table>
//                         </div>';




//                 //echo $output;

//                 echo $value;


//       	if($deleterow != 0)
//       	{

//               $sql = "DELETE FROM category WHERE cat_id = '$deleterow'";
//       		if($conn->query($sql))
//            {
//       			//$_SESSION['success'] = 'Voter deleted successfully';
//       			//echo "success";
//       		}
//       		//else
//           //  {
//       			//$_SESSION['error'] = $conn->error;
//       			//echo "error";
//       		//}
//       }
        


// }



     


 ?>
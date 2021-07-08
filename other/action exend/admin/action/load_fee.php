
<?php 

include '../includes/session.php';

if(isset($_POST['geteventid']) && isset($_POST['amount']) )
{
                       $geteventid = trim($_POST['geteventid']);
                       $amount = trim($_POST['amount']);


         //              $array_id = array();
         //              $index_array = 0;
					    // $sql = "SELECT * FROM masterlist where pay".$geteventid." <> '' ";
         //                      $query = $conn->query($sql);
         //                      while($row = $query->fetch_assoc()){
         //                      	$array_id[$index_array] = $row['ml_student_id'];
         //                      }
							
                       
						              $output = "";
                          $countz = 1;
                          $costall = 0;
                            //  $sql = "SELECT * FROM students1 where sem".$_SESSION['sem_id']." = 1 order by year asc, firstname asc";
                            // $sql = "SELECT * FROM students1 where sem".$_SESSION['sem_id']." = 1 and student_id not in (SELECT ml_student_id FROM masterlist where pay".$geteventid." <> '') order by year asc, firstname asc";
                            $sql = "SELECT  * FROM students".$_SESSION['sy_id']." s inner join masterlist".$_SESSION['sy_id']." ml on s.student_id = ml.ml_student_id where sem".$_SESSION['sem_id']." = 1 order by pay".$geteventid." desc , s.year asc, s.firstname asc ";
                              $query = $conn->query($sql);
                              while($row = $query->fetch_assoc()){
                              	
                              	{
                                  if($row['pay'.$geteventid.''] > 0)
                                  {
                                    $output .= "
                                      <tr>
                                        <td>".$countz++."</td>
                                        <td title='Mark to remove student' ><input type='checkbox' class='ckhbox' data-id=".$row['student_id']."></td>
                                        <td>".$row['id_number']."</td>
                                        <td>".ucwords(strtolower($row['firstname']))." ".ucwords(strtolower($row['lastname']))."</td>
                                        <td>".$row['year']." ".ucwords(strtolower($row['section']))." ".ucwords(strtolower($row['major']))."</td>  
                                        <td>".ucwords(strtolower($row['course']))."</td>
                                        <td class='tdamount'> <span class='tdamountloading'> &#8369 ".number_format($amount,2)." </span></td>
                                      </tr>
                                    ";
                                    $costall += $amount;
                                    }
                                    else
                                    {
                                      $output .= "
                                        <tr>
                                          <td>".$countz++."</td>
                                          <td><input type='checkbox' class='ckhbox' data-id=".$row['student_id']."></td>
                                          <td>".$row['student_id']."</td>
                                          <td>".ucwords(strtolower($row['firstname']))." ".ucwords(strtolower($row['lastname']))."</td>
                                          <td>".$row['year']." ".ucwords(strtolower($row['section']))." ".ucwords(strtolower($row['major']))."</td>  
                                          <td>".ucwords(strtolower($row['course']))."</td>
                                          <td class='tdamount'><span class='tdamountloading'>&#8369 ---- </span></td>
                                        </tr>
                                      ";

                                    }

                                    
                                }
                           
                            }
                            $output .= '<input type="hidden" class="totalfee" value="'.$costall.'">';
                            echo $output;
                         // echo json_encode(['html'=>$output,'costall'=>$costall]);














}
 ?>


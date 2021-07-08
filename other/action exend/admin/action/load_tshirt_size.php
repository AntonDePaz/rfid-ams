<?php 
include '../includes/session.php';

  $output = "";
	                        $sql1 = "SELECT * FROM fee_event where fe_id = 25 ";
                            $query1 = $conn->query($sql1);
                            $row1 = $query1->fetch_assoc(); 
                            $amount = $row1['amount'];
                              $countz = 1;
                              $sql = "SELECT * FROM students".$_SESSION['sy_id']." s left join tshirt_size".$_SESSION['sy_id']." ts on s.student_id = ts.ts_student_id where s.sem".$_SESSION['sem_id']." = 1  order by ts.size25 desc,s.firstname asc,s.year asc ";
                           
                              $query = $conn->query($sql);
                             

                              while($row = $query->fetch_assoc()){
                               
                                
                                $output .= "<tr>
                                    <td>".$countz++."</td>
                                   <td><input type='checkbox' name=''></td>
                                    <td>".$row['id_number']."</td>
                                    <td>".ucwords(strtolower($row['firstname']))." ".ucwords(strtolower($row['lastname']))."</td>
                                    <td>". $row['year']." ".ucwords(strtolower($row['section']))." ".ucwords(strtolower($row['major']))."</td>  
                                    <td>".ucwords(strtolower($row['course'])) ."</td>
                                    <td>";
                                     if(!empty($row['size25'])){ echo "reserved"; } 
                                    $output .= "</td>
                                    <td>";
                                     if(!empty($row['size25'])){ echo $amount; } 
                                    $output .= " </td>
                                      <td class='tdsize".$row['student_id']."'>".$row['size25']."</td>";
                                    
                                   $output .= " <td>
                                       <select title='T-Shirt Sizes' class ='form-control pull-left ' name = 'size' id='size' data-id='".$row['student_id']."'>
                                        <option></option>";
                                        $sqlw = "SELECT * FROM category where tshirt_size <> '' ";
                                          $queryw = $conn->query($sqlw);
                                          while($roww = $queryw->fetch_assoc()){
                                          
                                       $output .= " <option value='".$roww['tshirt_size']."'>".$roww['tshirt_size']."'</option>";
                                       
                                           } 

                                   $output .= " </select> </td>
                                  </tr> ";
                            }

                            echo $output;


















 ?>
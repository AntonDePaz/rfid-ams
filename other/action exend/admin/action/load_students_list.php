<?php 

include '../includes/session.php';

if(isset($_POST['id']))
{
      $output = "";


                    $countz = 1;
                    $sql = "SELECT * FROM students".$_SESSION['sy_id']." where sem".$_SESSION['sem_id']." = 1 ";
                  //  $sql = "SELECT * FROM students1 where semester = 1 ";
                    $query = $conn->query($sql);
                    // while($row = $query->fetch_assoc()){
                    //   echo "
                    //     <tr>
                    //       <td>".$countz++."</td
                    //       <td></td>
                    //       <td>".$row['id_number']."</td>
                    //       <td>".ucwords(strtolower($row['firstname']))."</td>
                    //       <td>".ucwords(strtolower($row['lastname']))."</td>
                    //       <td>".$row['year']."</td>  
                    //       <td>".ucwords(strtolower($row['section']))."</td>
                    //       <td>".ucwords(strtolower($row['semester']))."</td>
                    //       <td>
                    //         <a style='color:green; font-size: 20px;' title='edit' data-id=".$row['student_id']." class='fa fa-edit edit'></a> &nbsp;&nbsp;
                    //        &nbsp;&nbsp; <a style='color:red; font-size: 20px;' title='delete' data-id=".$row['student_id']." class='fa fa-trash-o del'></a>
                    //       </td>
                    //     </tr>
                    //   ";
                    // }

                    while($row = $query->fetch_assoc()){
                      $output .= "
                        <tr>
                          <td>".$countz++."</td
                          <td></td>
                          <td>".$row['id_number']."</td>
                          <td>".ucwords(strtolower($row['firstname']))."</td>
                          <td>".ucwords(strtolower($row['lastname']))."</td>
                          <td>".$row['year']."</td>  
                          <td>".ucwords(strtolower($row['section']))."</td>
                          <td>".ucwords(strtolower($row['course']))."</td>
                          <td>".ucwords(strtolower($row['major']))."</td>
                          <td class='modify'>
                            <a class='btn btn-default btn-xs edit' title='edit' data-id=".$row['student_id']."><i class='fa fa-edit'> edit</i></a>
                           &nbsp;&nbsp; <a class='btn btn-default btn-xs del' title='delete' data-id=".$row['student_id']."> <i class='fa fa-trash-o'> delete</i></a>
                          </td>
                        </tr>
                      ";
                    }

               
                    echo $output;




}



 ?>
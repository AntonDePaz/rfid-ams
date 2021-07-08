
<!-- Update Photo -->

<?php
                  $data = $student->showall_student22();
                  if(isset($_SESSION['sy_id'])){
                    $countz = 1;
                    
                        if(!empty($data)){
                        foreach($data as $row){

                 if(isset($_SESSION['sy_id'])){
                   $countz = 1;
                   $sql = "SELECT * FROM students".$_SESSION['sy_id']." where sem".$_SESSION['sem_id']." = 1 and id_number = '1710128-1' order by year,firstname";
                   $sql = "SELECT * FROM students1 where semester = 1 ";
                   $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      echo "
                        <tr>
                          <td>".$countz++."</td
                          <td></td>
                          <td>".$row['id_number']."</td>
                          <td>".ucwords(strtolower($row['firstname']))."</td>
                          <td>".ucwords(strtolower($row['lastname']))."</td>
                          <td>".$row['year']."</td>  
                          <td>".ucwords(strtolower($row['section']))."</td>
                          <td>".ucwords(strtolower($row['semester']))."</td>
                          <td>
                            <a style='color:green; font-size: 20px;' title='edit' data-id=".$row['student_id']." class='fa fa-edit edit'></a> &nbsp;&nbsp;
                           &nbsp;&nbsp; <a style='color:red; font-size: 20px;' title='delete' data-id=".$row['student_id']." class='fa fa-trash-o del'></a>
                          </td>
                        </tr>
                      ";
                    }

                   while($row = $query->fetch_assoc()){
                     echo "
                        <tr>
                          <td>".$countz++."</td>
                          <td>".$row['id_number']."</td>
                          <td>".ucwords(strtolower($row['firstname']))."</td>
                          <td>".ucwords(strtolower($row['middlename']))."</td>
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
                  }
                }










                <?php
                $status = "";
                 // $sql = "SELECT * FROM fee_event where type = 2 and sem_id = ".$_SESSION['sem_id']." and sy_id = ".$_SESSION['sy_id']."";
                  //$query = $conn->query($sql);
                  //while($row = $query->fetch_assoc()){
                    $data = $fee->show_all();
                    if(!empty($data)){
                      foreach($data as $row){
                    if($row['fe_status'] == '0')
                    {
                      //$status = "Mandatory";
                      $status = "Contribution Fees";
                    }
                    else
                    {
                      $status = "Tshirt Fees";
                    }
                    echo "
                      <tr>
                        <td>".$row['Description']."</td>
                        <td> &#8369 ".number_format($row['amount'],2)."</td>
                        <td>".$status."</td>
                        <td>
                          
                         <a class='btn btn-default btn-xs view' data-id=".$row['fe_id']."><i class='fa fa-server'> details</i></a>
                         <a class='btn btn-default btn-xs edit' id=".$row['fe_status']." data-id=".$row['fe_id']."><i class='fa fa-edit'> edit</i></a>
                        <a class='btn btn-default btn-xs del' data-id=".$row['fe_id']."><i class='fa fa-trash-o'> delete</i></a>

                        </td>
                      </tr>
                    ";
                  }
                }
                ?>








                <?php

                $countz = 1;
               // $sql = "SELECT * FROM students1 where sem".$_SESSION['sem_id']." = 1 order by year asc, firstname asc";
                // $sql = "SELECT * FROM students".$_SESSION['sy_id']." s inner join masterlist".$_SESSION['sy_id']." ml on s.student_id = ml.ml_student_id where s.sem".$_SESSION['sem_id']." = 1 order by s.year asc, s.firstname asc";
               
               // $query = $conn->query($sql);
               // while($row = $query->fetch_assoc()){
                 $data = $fee->show_all_fee();
                 if(!empty($data)){
                   foreach($data as $row){
                  echo "
                    <tr>
                      <td>".$countz++."</td>
                      <td><input type='checkbox' class='ckhbox' data-id=".$row['student_id']."></td>
                      <td>".$row['id_number']."</td>
                      <td>".ucwords(strtolower($row['firstname']))." ".ucwords(strtolower($row['lastname']))."</td>
                      <td>".$row['year']." ".ucwords(strtolower($row['section']))." ".ucwords(strtolower($row['major']))."</td>  
                      <td>".ucwords(strtolower($row['course']))."</td>
                      <td class='tdamounts'><span class='tdamountloading'>--</span></td>
                      

                    </tr>
                  ";
                   }
                   
                }
                // else{
                //   echo 'empty';
                // }

              ?>











                 ?>
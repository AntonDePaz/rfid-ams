<?php 


$db  = mysqli_connect('localhost','root','', 'test_login');




                     $eventid = $_GET['id'];

                     $sql1 = "SELECT * FROM events where id = '$eventid'";
                    $query1 = $db->query($sql1);
                    $row1 = $query1->fetch_assoc();
                    $pon = $row1['num'];
                    $finesamount = $row1['fines'];





                  //   $dash = "-";
                  // //  $year = array();
                  //   $index=0;
                  //   $sqles = "SELECT * FROM `eventstatus` where event_id = '$eventid' ";
                  //   $queryes = $db->query($sqles);
                  //   while($rowes = $queryes->fetch_assoc())
                  //   {
                  //     $yearar = $rowes['yearlevel'];
                  //     $year[$index]=$yearar;
                  //     //echo "year01: ".$yearar;
                  //     $index++;
                  //   }
                   // echo "count array :".count($year);
                    // for($i = 0; $i < count($year); $i++ )
                    // {
                    //   echo "year: ".$year[$i];

                    // }
                    
                    // SELECT s.idnumber,s.firstname,s.lastname,s.year , e.Timein1 , e.Timeout1,e.Timein2 , e.Timeout2,e.Timein3 , e.Timeout3, es.year FROM students s left join eventfine e ON s.id = e.student_id left JOIN eventstatus es on s.year = es.year where e.event_id = 1



                    // SELECT s.idnumber,s.firstname,s.lastname,s.year , e.Timein1 , e.Timeout1,e.Timein2 , e.Timeout2,e.Timein3 , e.Timeout3, es.year FROM students s left join eventfine e ON s.id = e.student_id left JOIN eventstatus es on s.year = es.year where e.event_id = 1 and s.year not in (select year from eventstatus where event_id = 1 )

                    $is = 0;
                    $arraycount = 0;
                    $countz = 1;

                    // $sql = "SELECT s.idnumber,s.firstname,s.lastname,s.year , e.Timein1 , e.Timeout1,e.Timein2 , e.Timeout2,e.Timein3 , e.Timeout3 FROM students s left join eventfine e ON s.id = e.student_id and e.event_id = '$eventid'";

                   // $sql = "SELECT s.idnumber,s.firstname,s.lastname,s.year , e.Timein1 , e.Timeout1,e.Timein2 , e.Timeout2,e.Timein3 , e.Timeout3, es.year FROM students s left join eventfine e ON s.id = e.student_id left JOIN eventstatus es on s.year = es.year where e.event_id = '$eventid' and s.year not in (select year from eventstatus where event_id = '$eventid' )";



                    //try this
                    //SELECT s.idnumber,s.firstname,s.lastname,s.year , e.Timein1 , e.Timeout1,e.Timein2 , e.Timeout2,e.Timein3 , e.Timeout3, es.yearlevel FROM students s inner join eventfine e ON s.id = e.student_id and e.event_id = 1 right JOIN eventstatus es on s.year = es.yearlevel









                  // $sql = "SELECT s.idnumber,s.firstname,s.lastname,s.year , e.Timein1 , e.Timeout1,e.Timein2 , e.Timeout2,e.Timein3 , e.Timeout3, es.yearlevel FROM students s left join eventfine e ON s.id = e.student_id and e.event_id = '$eventid' left JOIN eventstatus es on s.year = es.yearlevel ";



                   // $sql = "SELECT s.idnumber,s.firstname,s.lastname,s.year , es.yearlevel FROM students s left join eventstatus es on s.year = es.yearlevel where event_id = '$eventid'";
                    //$query = $db->query($sql);










                    $foundcontent = false;

                     // $sql = "SELECT s.idnumber,s.firstname,s.lastname,s.year , s.section,s.major, ef.Timein1, ef.Timeout1, ef.Timein2, ef.Timeout2 ,ef.Timein3, ef.Timeout3 FROM students s inner join eventstatus es on s.year = es.yearlevel left join eventfine ef on s.id = ef.student_id and ef.event_id = es.event_id where es.event_id =  '$eventid' ";


                    $fg = false;
                    $sql = "SELECT s.idnumber,s.firstname,s.lastname,s.year , s.section,s.major, ef.Timein1, ef.Timeout1, ef.Timein2, ef.Timeout2 ,ef.Timein3, ef.Timeout3 FROM students s inner join eventstatus es on s.year = es.yearlevel left join eventfine ef on s.id = ef.student_id and ef.event_id = es.event_id where es.event_id =  '$eventid' and s.major = '$major' ";

                    


                    
                     $query = $db->query($sql);
                    while($row = $query->fetch_assoc())
                    {   
                    	$fg = true;
                    	?>
                    	<tr>
                          <td><?php echo $countz++;?></td>
                          <td><?php echo $row['idnumber'];?></td>
                          <td><?php echo $row['firstname'];?></td>
                          <td><?php echo $row['lastname'];?></td>
                          <td><?php echo $row['year'];?></td>
                          <td><?php echo $row['section'];?></td>
                          <td><?php echo $row['major'];?></td>
                          <td><?php 
                            // if(is_null($row['Timein1'])){
                            //     echo '--';
                            // }
                            // else {
                          echo $row['Timein1'];
                           // }

                          ?></td>


                          <td><?php 
                            // if(is_null($row['Timein1'])){
                            //     echo '--';
                            // }
                            // else {
                          echo $row['Timeout1'];
                           // }

                          ?></td>



                          <td><?php 
                            // if(is_null($row['Timein1'])){
                            //     echo '--';
                            // }
                            // else {
                          echo $row['Timein2'];
                           // }

                          ?></td>



                          <td><?php  
                          // if(is_null($row['Timeout1'])){
                          //       echo '--';
                          //   }
                          //   else {
                          echo $row['Timeout2'];
                           // }
                            ?></td>

                          <td><?php 
                          echo $row['Timein3'];
                           // }
                            ?></td>



                          <td><?php 
                          echo $row['Timeout3'];
                           // }
                            ?></td>


                            
                 <?php    } ?>




<?php

if(!$fg)
{


                    $sql = "SELECT s.idnumber,s.firstname,s.lastname,s.year , s.section,s.major, ef.Timein1, ef.Timeout1, ef.Timein2, ef.Timeout2 ,ef.Timein3, ef.Timeout3 FROM students s inner join eventstatus es on s.year = es.yearlevel left join eventfine ef on s.id = ef.student_id and ef.event_id = es.event_id where es.event_id =  '$eventid'";
                     $query = $db->query($sql);
                    while($row = $query->fetch_assoc())
                    {   
                     ?>
                        <tr>
                          <td><?php echo $countz++;?></td>
                          <td><?php echo $row['idnumber'];?></td>
                          <td><?php echo $row['firstname'];?></td>
                          <td><?php echo $row['lastname'];?></td>
                          <td><?php echo $row['year'];?></td>
                          <td><?php echo $row['section'];?></td>
                          <td><?php echo $row['major'];?></td>
                          <td><?php 
                            // if(is_null($row['Timein1'])){
                            //     echo '--';
                            // }
                            // else {
                          echo $row['Timein1'];
                           // }

                          ?></td>


                          <td><?php 
                            // if(is_null($row['Timein1'])){
                            //     echo '--';
                            // }
                            // else {
                          echo $row['Timeout1'];
                           // }

                          ?></td>



                          <td><?php 
                            // if(is_null($row['Timein1'])){
                            //     echo '--';
                            // }
                            // else {
                          echo $row['Timein2'];
                           // }

                          ?></td>



                          <td><?php  
                          // if(is_null($row['Timeout1'])){
                          //       echo '--';
                          //   }
                          //   else {
                          echo $row['Timeout2'];
                           // }
                            ?></td>

                          <td><?php 
                          echo $row['Timein3'];
                           // }
                            ?></td>



                          <td><?php 
                          echo $row['Timeout3'];
                           // }
                            ?></td>

                          <?php 
                            // $totalfines = 0;
                            // for($i = 0; $i < $pon; $i++)
                            // {
                            //  // if($i == $is){
                            //  echo'<td>'.$dash.'</td>';

                            //  $totalfines += $finesamount;
                            //  //  } 
                            //   // else{
                            //   //  echo'<td>'.$savearray[$i].'</td>';
                            //  //  }  
                            // }
                            ?>
                           
                        </tr>
                     <?php 

                     //  }
                      
                  $foundcontent = true;
                    }


               if(!$foundcontent){

                    	 $sql = " SELECT s.idnumber,s.firstname,s.lastname,s.year , s.section,s.major, e.Timein1 , e.Timeout1,e.Timein2 , e.Timeout2,e.Timein3 , e.Timeout3 FROM students s left join eventfine e ON s.id = e.student_id and e.event_id = '$eventid' ";
                     $query = $db->query($sql);
                    while($row = $query->fetch_assoc())
                    {
                   
                     
                     ?>
                        <tr>
                          <td><?php echo $countz++;?></td>
                          <td><?php echo $row['idnumber'];?></td>
                          <td><?php echo $row['firstname'];?></td>
                          <td><?php echo $row['lastname'];?></td>
                          <td><?php echo $row['year'];?></td>
                          <td><?php echo $row['section'];?></td>
                          <td><?php echo $row['major'];?></td>

                          <td><?php 
                            // if(is_null($row['Timein1'])){
                            //     echo '--';
                            // }
                            // else {
                          echo $row['Timein1'];
                           // }

                          ?></td>


                          <td><?php 
                            // if(is_null($row['Timein1'])){
                            //     echo '--';
                            // }
                            // else {
                          echo $row['Timeout1'];
                           // }

                          ?></td>



                          <td><?php 
                            // if(is_null($row['Timein1'])){
                            //     echo '--';
                            // }
                            // else {
                          echo $row['Timein2'];
                           // }

                          ?></td>



                          <td><?php  
                          // if(is_null($row['Timeout1'])){
                          //       echo '--';
                          //   }
                          //   else {
                          echo $row['Timeout2'];
                           // }
                            ?></td>

                          <td><?php 
                          echo $row['Timein3'];
                           // }
                            ?></td>



                          <td><?php 
                          echo $row['Timeout3'];
                           // }
                            ?></td>

                         
                           
                        </tr>





<?php
                   
}

}


} // if end #bg



 ?>
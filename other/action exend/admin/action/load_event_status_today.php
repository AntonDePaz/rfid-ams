<?php 
include '../includes/session.php';

$eventid = $_POST['eventid'];
$output = "";
 $output .= '<table class="table">';                        
                     
                     
                     $content = array('Time In morning','Time Out morning','Time In afternoon','Time Out afternoon','Time In evening','Time Out evening');
                    
                     $get_status = false;
                    $sql = "SELECT tap FROM fee_event where fe_id = '$eventid' ";
                    $query = $conn->query($sql);
                    $row = $query->fetch_assoc();
                    $pon = $row['tap'];
                      $countthis = 0; $get_status = 0;
                    // $eventid = $_GET['id'];
                     $set_status = 0;
                      $sql = "SELECT * FROM attendance_status ";
                     $query = $conn->query($sql);
                     while($row = $query->fetch_assoc())
                    {
                      $id = $row['as_id'];
                      $status = $row['status'];
                      $geteventid = $row['fee_event_id'];
                     if($countthis == $pon){break;}
                      if( $geteventid == $eventid && $status == 'activate')
                      {
                         $set_status = true;
                       
                        $output .= " <tr>
                              <td>".$content[$countthis]."</td>
                              <td><a  class='btn btn-danger btn-xs activate' data-id='".($countthis+1)."'><span id='deac'>deactivate</span></a></td>
                            </tr>";
                      }
                      else{
                           
                             $output .= "<tr>
                              <td>".$content[$countthis]."</td>
                              <td><a  class='btn btn-success btn-xs deactivate' data-id='".($countthis+1)."'><span id='ac'>activate</span></a></td>
                            </tr>  ";
                      }
                       $countthis++;

                    }
                   
                    if(!$set_status){
                      $get_status = 0;
                    }
                    else{
                      $get_status = 1;
                    }

                     
                    

                   $output .='</table>
                    <input type="hidden" class="get_status" value="'.$get_status.'">
                  </div>';


echo $output;










 ?>
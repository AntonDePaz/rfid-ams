<?php  if(session_status() == PHP_SESSION_NONE)
                   {session_start();}
if(isset($_SESSION['event_id'])){
                   ?>
<div class="modal fade" id="actived">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 500px; align-content: center;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Activate Attendance</b></h4>
            </div>
            <div class="modal-body">
                
            <?php 
                   
                  
                    // $eventid = $_GET['id'];
                     $eventid = $_SESSION['event_id'];
                    // $eid = $eventid;
                    //  if(empty($eid)){
                    //   $eid =  $_SESSION['event_id'];
                    //  }
                    //  else{
                    //   $eventid = $eid;
                    //  }
                   echo '<input type="hidden" class="eventid "value='.$eventid.' >';
                     ?>


                <div class="row" >
                  <div class="col-md-2" ></div>
                  <div class="col-md-8" id="attendance_status_table" >
                    <table class="table">                        
                     
                     <?php 
                    // include 'model/dashboard.php';

                   
                    $content = array('Time In morning','Time Out morning','Time In afternoon','Time Out afternoon','Time In evening','Time Out evening');
                    
                     $get_status = false;

                     $data = $dashboard->tap_fee_event($eventid);

                    // $sql = "SELECT tap FROM fee_event where fe_id = '$eventid' ";
                    // $query = $conn->conn->query($sql);
                    // $row = $query->fetch_assoc();
                  
                    //$pon = $row['tap'];
                    $pon = $data['tap'];
                      $countthis = 0; $get_status = 0;
                    // $eventid = $_GET['id'];
                     $set_status = 0;
                     $data = $dashboard->tap_attendance_status();
                     if(!empty($data)){
                     foreach($data as $row){

                    //   $sql = "SELECT * FROM attendance_status ";
                    //  $query = $conn->conn->query($sql);
                    //  while($row = $query->fetch_assoc())
                    // {
                      $id = $row['as_id'];
                      $status = $row['status'];
                      $geteventid = $row['fee_event_id'];
                     if($countthis == $pon){break;}
                      if( $geteventid == $eventid && $status == 'activate')
                      {
                         $set_status = true;
                       
                        echo" <tr>
                              <td>".$content[$countthis]."</td>
                              <td><a  class='btn btn-danger btn-xs activate' data-id='".($countthis+1)."'><span id='deac'>deactivate</span></a></td>
                            </tr>";
                      }
                      else{
                           
                             echo "<tr>
                              <td>".$content[$countthis]."</td>
                              <td><a  class='btn btn-success btn-xs deactivate' data-id='".($countthis+1)."'><span id='ac'>activate</span></a></td>
                            </tr>  ";
                      }
                       $countthis++;

                    }
                  }
                   
                    if(!$set_status){
                      $get_status = 0;
                    }
                    else{
                      $get_status = 1;
                    }

                      ?>
                    

                    </table>
                    <input type="hidden" class="get_status" value="<?php echo $get_status; ?>">
                  </div>
                   <div class="col-md-2" ></div>
                </div>
                <div class="col-md-2" ></div>
                <div class="col-md-9"><h6 class="errormsg"></h6></div>
                
                     
           
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-xs  pull-left" data-dismiss="modal"><i  class="fa fa-close text-danger" ></i> Close</button>
              <button type="button" class="btn btn-info btn-xs start">Start now</button>
             
            </div>
        </div>
    </div>
</div>

<?php }?>
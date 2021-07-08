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
                  // $eventid = $_SESSION['event_id'];
                   // $eventid = $_GET['id'];
                    // $eventid = $_SESSION['eventid1'];
                     

                   //  $eid = 
                     // if(empty($eid)){
                     //  $eid =  $_SESSION['event_id'];
                     // }
                     // else{
                     //  $eventid = $eid;
                     // }
                  //  echo '<input type="text" class="eventid "value='.$eventid.' >';
                     ?>
                     <input type="hidden" class="eventid">

                <div class="row" >
                  <div class="col-md-2" ></div>
                  <div class="col-md-8" id="attendance_status_table" >
                    
                  </div>
                   <div class="col-md-2" ></div>
                </div>
                     
            <h6 class="errormsg"></h6>
            <div class="modal-footer">
             <!--  <button type="button" class="btn btn-default btn-sm pull-left" ><i class="fa fa-close" ></i> Close</button> -->
              <button type="button" class="btn btn-primary btn-sm start">Start now</button>
             
            </div>
        </div>
    </div>
</div>



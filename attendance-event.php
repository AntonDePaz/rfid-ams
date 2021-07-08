<?php
  include 'includes/session.php';
  include 'model/event.php';
  include 'model/attendance.php';
  include 'model/category.php';
 ?>
<?php include 'includes/header.php'; ?>
<style type="text/css">

  #rfid-status-on{
    display : none;
  }
  .txtrfid{
    width: 200px;
    border: 1px solid #33bbff;
     border-radius: 5px 0 0 5px;
    border-right: none;
    padding: 5px;
    height: 30px;
    outline: none;
    color: #9bdfaf;
  }
  .txtrfid:focus{
    color: #000;
    box-shadow: 0 0 5px #33bbff;
  }
  .okay{
    width: 40px;
    height: 30px;
    border:1px solid #33bbff;
    background: #0099e6;
    text-align: center;
    color: #fff;
    border-radius: 0 5px 5px 0;
    cursor: pointer;
    font-size: 20px;
  }
  .icon{
    position: absolute;
    align-items: center;
    margin-left: -10px;
  }
  .search{
    width: 200px;
    border: 1px solid #33bbff;
     border-radius: 5px 0 0 5px;
    padding: 5px;
    height: 25px;
    color: #000;
    margin-right: 35px;
  }
  .eg1{
   font-size: 10px;
    color: red;
     font-style: italic;
     position: absolute;
      margin-top: 2px;
  }
  
  .blink_status{
    animation:blinker 1.2s infinite;
}
@keyframes blinkingText{
    0%{     color: cyan;    }
    49%{    color: #000; }
    60%{    color: transparent; }
    99%{    color:transparent;  }
    100%{   color: #000;    }
}
.blinking_status {
    animation: blinker 1.5s cubic-bezier(.5, 0, 1, 1) infinite alternate;  
}

@keyframes blinker {  
  from { opacity: 1; }
  to { opacity: 0; }
}
</style>
<body>
<div>

  <?php
         $eventid = $_SESSION['event_id'];
        $row = $event->show_event($eventid);
        $description = $row['Description'];
       
        $lastacivate = 0;
        $lasttime = "";
        $row = $attendance->attendance_status_active($eventid);
          $lastacivate = $row['as_id'];
          $lasttime = $row['time'];
          $content = array('Time In morning','Time Out morning','Time In afternoon','Time Out afternoon','Time In evening','Time Out evening');
          $lasttime2 = intval($lastacivate);

  ?>



  <!-- Content Wrapper. Contains page content -->
  <div >
    <!-- Content Header (Page header) -->
    <section class="content-header" style="top: 0;">
      <div class="row">
        <!-- <div class="row" style="margin: 0 10px;"><h6 class="pull-right"><?php// echo "".date('D, F d, Y'); ?></h6>
        </div> -->
      <div class="row" style=" margin: 0 10px;">
        <h3 class="pull-left">
         <?php  echo $description; ?>
        </h2>
        <div class="row pull-right" style=" margin-right: 10px;">
          <p class="pull-right"><?php echo "".date('D, F d, Y'); ?></p>
        </div>
        <br>
         <div class="row pull-right" style=" margin-right: -150px;">
         <!-- <p class="pull-right" style="font-size: 25px; " id="time"></p> -->
         <p class="date_time" style="font-size: 25px; margin-right:30px; " id="time"><strong id="sec"></strong></p>
       </div>
      </div>

   


       
      <div class="row" style=" margin:0 10px;">
           <h4 class="tap_status pull-left text-info"> <?php echo $content[($lasttime2-1)] ?></h4>
          <h5 class="pull-right">
        RFID Based Students Attendance
         </h5><br>

        </div>
        <div class="row" style="margin:0 10px;">

            
   


          <input type="hidden" class="txteventid" value=" <?php echo $eventid;  ?> ">
            <h6 class="pull-left blinking_status" id="rfid_msg"> Tap Now Your ID for Check attendance.</h6>
         <a  style="margin-left: 20px;" class="btn btn-danger btn-xs pull-right winclose"><i class="fa fa-reply"></i> Back</a>
          <a  href="attendance-event.php" class="btn btn-info btn-xs pull-right"><i class="fa fa-refresh"></i> Refresh</a>
          <input type="text" id="search" class="pull-right search" placeholder="search..">
          </div>


    </div>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <div class="col-md-2 pull-left" >
              
              <a  id="rfid-status-off"><i  style="color:skyblue; font-size:25px; cursor:pointer; " class="fa fa-toggle-off roff"></i> &nbsp; <span class="text-info" style="font-style:italic; font-size:12px; position:absolute; margin-top:5px; "> <span style="position: absolute;"><i class="fa fa-circle text-danger"></i>&nbsp; </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RFID Reader<i class="fa fa-circle-green"></i> </span></a>
              
              <a  id="rfid-status-on"><i style="color:skyblue; font-size:25px; cursor:pointer;" class="fa fa-toggle-on " ></i> &nbsp; <span class="text-info" style="font-style:italic;  font-size:12px; position:absolute; margin-top:5px;"><span style="position: absolute;" class="blink_status"><i class="fa fa-circle text-success"></i>&nbsp; </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RFID Reader</span></a>
           
            </div>

                        <div class="col-md-2 pull-right" >
                           <select class = "form-control year" id="cyear" name = "year" style="border-radius: 10px;">
                                  <option value="all">All Year</option>
                                  <?php

                                        $sec = $category->year();
                                        foreach($sec as $row){
                                       echo "<option value=".$row['c_year'].">".strtoupper($row['c_year'])." Year</option>";
                                        } ?>
                                </select>
                        </div>
                        <div class="col-md-2 pull-right">
                           <select class = "form-control course" id="ccourse" name = "section"  style="border-radius: 10px">
                                  <option value="all">All Course</option>
                                  <option value="attended">All Attended</option>
                                  <option value="nattended">All Not Attended</option>
                                  <?php
                                      // $sql = "SELECT c_course FROM category where c_course <> '' order by c_course asc" ;
                                     //  $query = $conn->query($sql);
                                      // while($row = $query->fetch_assoc()){
                                        $cors = $category->course();
                                        foreach($cors as $row){
                                       echo "<option>".strtoupper($row['c_course'])."</option>";
                                        } ?>
                                </select>
                        </div>





            </div>
            <div class="box-body" style="overflow-y:auto; height:600px;">
              <table id="exampleattend" class="table table-bordered table-striped">
                <thead>
                  <th>#</th>
                  
                  <th>ID Number</th>
                  <th>First Name</th>
                  <th>Middle Name</th>
                  <th>Last Name</th>
                  <th>Year</th>
                  <th>Section</th>
                  <th>Course</th>
                  <th>Major </th>
                  <th>Status </th>
                  <th width="10%"><p style="font-size: 10px;">Modify Attendance</p><a style="font-size: 15px; cursor: pointer;" class="btn btn-info btn-xs pull-right attendance"> <b> <small style="font-size:10px;" > Attendance</small> <i class='fa fa-calendar-check-o' style="color: green;"></i></b></a>
                    <input class="btn btn-success btn-sm pull-left" type="checkbox" id="checkall">
                  </th>
                </thead>
                <tbody class="datarow" >
                

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <footer>
    <div class="pull-right hidden-xs">
      <b style="font-size:12px;" >RFID | Based Attendance Management System</b>
      <p style="font-size: 12px; margin-top: -2px; ">&copy; <script>  document.write(new Date().getFullYear()); </script> Develop by <a>Antonio De Paz Jr</a></p>
    </div>
    <p style="font-size: 13px; font-style: italic; font-weight: 200;"><span>SY:<span style="color: blue;"> <?php if(isset($_SESSION['sy_id'])) { echo $_SESSION['sy_range']; }else{ echo "___-___"; }?></span> 
    Semester:<span style="color: blue;"> <?php if(isset($_SESSION['sy_id'])) { echo $_SESSION['sem_id']; }else{ echo "_";} ?></span></span></p>
</footer>


  <?php // include 'includes/footer.php'; ?>
  <?php   include 'includes/students_attendance_modal.php'; ?>
   <?php  // include 'includes/students_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<?php include 'includes/loading_modal.php'; ?>
</body>
</html>
<script src="assets/attendance.js"></script>

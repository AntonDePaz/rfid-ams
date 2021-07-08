<?php 
  
  #include 'model/connection.php';
  include 'model/dashboard.php';
  include 'model/event.php';
//  session_start();

include 'includes/session.php';
  
// if(!isset($_SESSION['admin_id']))
//  {
//   header('location: index.php');
//  } else {  $db = new Database();  }
 ?>
<?php include 'includes/header.php'; ?>
<style type="text/css">
  tbody {
    font-size: 12px;
  }
</style>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <?php //  $eventid = $_GET['id']; 
          $eventid = $_SESSION['event_id'];
         $date = date("Y-m-d");
         $row = $dashboard->tap_fee_event($eventid);

      //  $sql = "SELECT * FROM fee_event where fe_id = '$eventid'";
      //   $query = $conn->conn->query($sql);
      //   $row = $query->fetch_assoc();
        $number_of_attend = $row['tap'];
        $description = $row['Description'];
        $dateni = date('Y-m-d', strtotime($row['date']));
       
       // echo "".$description;

  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h4>
        Attendance Time Record
      </h4>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li ><a href="events.php"> Events</a></li>
        <li class="active">Students List</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <input type="hidden" class="get_event_id" value=" <?php echo $eventid; ?>  ">
              <p class="text-info pull-left" style=" font-family:cursive;  font-weight: 300; font-size: 20px;">
                <?php echo ucwords($description);?></p>
                <?php 
                   if($date > $dateni){
                    echo " <h6 class='text-danger'> (this event is expired)</h6>";
                  }
                 ?>
                
              <!-- <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a> -->
              <a style=" margin-left: 10px;" href="events.php" class="btn btn-default btn-xs pull-right"><i class="fa fa-reply"></i> Back</a>
              <a style=" margin-left: 10px;" href="eventsliststudent.php" class="btn btn-default btn-xs pull-right"><i class="fa fa-refresh"></i> Refresh</a>
             <!--  <a href="#attend"  data-toggle="modal" class="btn btn-default btn-sm pull-right"><i class="fa fa-plus"></i> tap rfid</a> -->
              <a href="#actived" data-toggle="modal" class="btn btn-info btn-xs pull-right"><i class="fa fa-calendar-plus-o"></i> Start Attendance</a>
            </div>
            <div class="box-body" style="overflow-y:auto;">
              <table id="student_event_time_table" class="table table-bordered table-striped">
                <thead>
                  <th>#</th>
                  <th><a class="rse" ><i class='fa fa-user-times'  style=" color: red; font-size: 15px; font-weight: 400;"></a></button></th>
                  <th>ID Number</th>
                  <th>Full Name</th>
                  <th>Course</th>
                  <th>Year/Section/Major</th>
                  <?php 
                        $getpares = false;
                       for($t = 0; $t < $number_of_attend; $t++){
                        if($t % 2 == 0){
                          $getpares = true;
                          echo "<th>TimeIn <span style='font-size: 10px;'></span></th>";
                        }else {
                           $getpares = false;
                          echo "<th>TimeOut</th>";  
                         }
                       }
                   ?>
                 </th>
                </thead>
                <tbody>
                  <?php
                  $var = 'sem'.$_SESSION["sem_id"];
                    $count = 1;
                    $rows = $event->students_list_in_event($eventid);
                   // $sql = "SELECT * from students".$_SESSION['sy_id']." s inner join attendance_tap".$_SESSION['sy_id']." at on s.student_id = at.at_student_id and at.at_fee_event_id = '$eventid' and s.sem".$_SESSION["sem_id"]." = 1 order by at.at_status, s.year,s.firstname";
                   //  $query = $db->conn->query($sql);
                   // while($row = $query->fetch_assoc())
                   if(!empty($rows)){
                   foreach($rows as $row)
                    {   
                    //  $fg = true;
                        if($row['at_status'] != 1 ){
                      ?>
                     <tr>
                          <td><?php echo $count++;?></td>
                          <td><input title="remove" type="checkbox" id="chk_getid" data-id=" <?php echo $row['student_id'];  ?> "></td>
                          <td><?php echo $row['id_number'];?></td>
                          <td><?php echo ucwords($row['firstname']).' '.ucwords($row['middlename']).' '.ucwords($row['lastname']); ?></td>
                          <td><?php echo ucwords($row['course']);?></td>
                          <td><?php echo $row['year'].' - '.$row['section'].'  '.ucwords($row['major']);?></td>
                          <?php 
                         // echo " valuethis:".$valuethis;
                            $i = 0;
                            for($i = 1; $i <= ($number_of_attend / 2) ;$i++ )
                            {
                             ?>
                          <td><?php if(empty($row['timein'.$i.''])){ echo "<p style='font-size: 12px;'> --:--:-- --</p>";}else{ echo $row['timein'.$i.''];}?></td> 
                          <td><?php if(empty($row['timeout'.$i.''])){ echo "<p style='font-size: 12px;'> --:--:-- --</p>";}else { echo $row['timeout'.$i.'']; }?></td>
                        <?php } ?>
                        <?php if($getpares == true) { $x = $i++; ?>
                        <td><?php if(empty($row['timein'.$x.''])){ echo "<p style='font-size: 12px;'> --:--:-- --</p>";}else{ echo $row['timein'.$x.''];}?></td>
                        <?php } ?> 
                          </tr>

                       <?php
                        }
                        else{
                          ?>

                        <tr style="background-color: #ffcccc; ">
                          <td><?php echo $count++;?></td>
                          <td> <i class="fa fa-close"></i> </td>
                          <td><?php echo $row['id_number'];?></td>
                          <td><?php echo ucwords($row['firstname']).' '.ucwords($row['middlename']).' '.ucwords($row['lastname']); ?></td>
                          <td><?php echo ucwords($row['course']);?></td>
                          <td><?php echo $row['year'].' - '.$row['section'].'  '.ucwords($row['major']);?></td>
                          <?php 
                            $i = 0;
                            for($i = 1; $i <= ($number_of_attend / 2) ;$i++ ){
                              $f = true;
                             ?> <td></td><td></td>
                        <?php } ?>
                        <?php if($getpares == true) { $x = $i++; 
                          ?>
                          <td></td>
                        <?php  } ?>
                          </tr>
                          <?php
                        }
                        }
                       } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php   include 'includes/active_event.php'; ?>
   <?php // include 'includes/students_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script src="assets/time_records.js"></script>
<script>
  
</script>
</body>
</html>

<div class = "modal fade" id = "removestudent" tabindex = "-1" role = "dialog" aria-labelledby = "myModallabel">
        <div class = "modal-dialog" role = "document">
          <div class = "modal-content ">
            <div class = "modal-body">
              <form class="form-horizontal" method="POST" action="">
               <input type="hidden" class="id" name="id">
              <center><label class = "text-danger">Are you sure you want to remove this student(s) for this event?</label></center>
              <br />
              <center><button type="button" class="btn btn-danger btn-xs btndelete" name="delete"><span class = "glyphicon glyphicon-trash"></span> Yes </button> <button type = "button" class = "btn btn-xs btn-warning" data-dismiss = "modal" aria-label = "No"><span class = "glyphicon glyphicon-remove"></span> No</button></center>
            </form>
            </div>
          </div>
        </div>
      </div>
